<?php

namespace App\Http\Controllers;

use App\Models\CaseImage;
use App\Models\DermatologyCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CaseController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'patient') {
            $cases = DermatologyCase::with('images')
                ->where('user_id', $user->id)
                ->latest()
                ->get();

            $activeCases = $cases->filter(fn($c) => $c->isActive());
            $pastCases   = $cases->filter(fn($c) => ! $c->isActive());

            return view('cases.index', compact('cases', 'activeCases', 'pastCases'));
        }

        // Doctor: tabbed queue
        $allCases = DermatologyCase::with(['user', 'images'])->latest()->get();

        $pendingCases   = $allCases->filter(fn($c) => in_array($c->status, ['submitted', 'in_review']));
        $needsInfoCases = $allCases->filter(fn($c) => $c->status === 'needs_info');
        $diagnosedCases = $allCases->filter(fn($c) => $c->status === 'diagnosed');
        $closedCases    = $allCases->filter(fn($c) => $c->status === 'closed');

        return view('cases.index', compact(
            'allCases', 'pendingCases', 'needsInfoCases', 'diagnosedCases', 'closedCases'
        ));
    }

    public function create()
    {
        return view('cases.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'child_name'       => 'required|string|max:120',
            'child_age'        => 'required|integer|min:0|max:18',
            'child_age_unit'   => 'required|in:years,months',
            'sex'              => 'required|in:M,F',
            'title'            => 'required|string|max:255',
            'body_location'    => 'nullable|string|max:255',
            'duration'         => 'nullable|string|max:100',
            'symptoms'         => 'nullable|array',
            'symptoms.*'       => 'string|max:100',
            'severity'         => 'nullable|integer|min:1|max:5',
            'additional_notes' => 'nullable|string|max:2000',
            'medications'      => 'nullable|string|max:1000',
            'allergies'        => 'nullable|string|max:1000',
            'prior_conditions' => 'nullable|string|max:1000',
            'family_history'   => 'nullable|string|max:1000',
            'images'           => 'nullable|array|max:6',
            'images.*'         => 'image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $case = DermatologyCase::create([
            'user_id'          => auth()->id(),
            'child_name'       => $request->child_name,
            'child_age'        => $request->child_age,
            'child_age_unit'   => $request->child_age_unit,
            'sex'              => $request->sex,
            'title'            => $request->title,
            'description'      => $request->additional_notes ?? '',
            'image_path'       => '',
            'body_location'    => $request->body_location,
            'duration'         => $request->duration,
            'symptoms'         => $request->symptoms ?? [],
            'severity'         => $request->severity,
            'additional_notes' => $request->additional_notes,
            'medications'      => $request->medications,
            'allergies'        => $request->allergies,
            'prior_conditions' => $request->prior_conditions,
            'family_history'   => $request->family_history,
            'status'           => 'submitted',
        ]);

        if ($request->hasFile('images')) {
            $firstPath = null;
            foreach ($request->file('images') as $idx => $file) {
                $path = $file->store('cases', 'public');
                CaseImage::create(['case_id' => $case->id, 'path' => $path, 'order' => $idx]);
                if ($idx === 0) {
                    $firstPath = $path;
                }
            }
            if ($firstPath) {
                $case->update(['image_path' => $firstPath]);
            }
        }

        return redirect()->route('cases.index')->with('success', 'Your consultation has been submitted. A dermatologist will review it shortly.');
    }

    public function show(DermatologyCase $case)
    {
        if (auth()->user()->role === 'patient' && $case->user_id !== auth()->id()) {
            abort(403);
        }

        $case->load(['images', 'user', 'doctor']);

        return view('cases.show', compact('case'));
    }

    public function review(DermatologyCase $case)
    {
        if (auth()->user()->role !== 'doctor') {
            abort(403);
        }

        $case->load(['images', 'user']);

        // Sidebar list: all open cases
        $reviewCases = DermatologyCase::with(['images', 'user'])
            ->whereIn('status', ['submitted', 'in_review', 'needs_info'])
            ->latest()
            ->get();

        if ($case->status === 'submitted') {
            $case->update(['status' => 'in_review', 'doctor_id' => auth()->id()]);
            $case->refresh();
        }

        return view('cases.review', compact('case', 'reviewCases'));
    }

    public function diagnose(Request $request, DermatologyCase $case)
    {
        if (auth()->user()->role !== 'doctor') {
            abort(403);
        }

        $request->validate([
            'icd_code'            => 'nullable|string|max:20',
            'diagnosis_condition' => 'required|string|max:255',
            'severity_doctor'     => 'nullable|integer|min:1|max:5',
            'diagnosis_summary'   => 'required|string|min:10',
            'treatment_steps'     => 'nullable|array',
            'treatment_steps.*'   => 'nullable|string|max:500',
            'follow_up'           => 'nullable|string|max:100',
            'close_case'          => 'nullable|boolean',
        ]);

        $treatmentSteps = array_values(array_filter($request->treatment_steps ?? []));

        $case->update([
            'doctor_id'           => auth()->id(),
            'icd_code'            => $request->icd_code,
            'diagnosis_condition' => $request->diagnosis_condition,
            'diagnosis'           => $request->diagnosis_condition,
            'severity_doctor'     => $request->severity_doctor,
            'diagnosis_summary'   => $request->diagnosis_summary,
            'treatment_steps'     => $treatmentSteps,
            'treatment'           => implode("\n", $treatmentSteps),
            'follow_up'           => $request->follow_up,
            'status'              => $request->boolean('close_case') ? 'closed' : 'diagnosed',
        ]);

        return redirect()->route('cases.show', $case)->with('success', 'Diagnosis saved and sent to patient.');
    }

    public function requestInfo(Request $request, DermatologyCase $case)
    {
        if (auth()->user()->role !== 'doctor') {
            abort(403);
        }

        $request->validate(['info_request' => 'required|string|min:5|max:2000']);

        $case->update([
            'status'       => 'needs_info',
            'info_request' => $request->info_request,
            'doctor_id'    => auth()->id(),
        ]);

        return redirect()->route('cases.review', $case)->with('success', 'Information request sent to patient.');
    }

    public function replyInfo(Request $request, DermatologyCase $case)
    {
        if (auth()->user()->role !== 'patient') {
            abort(403);
        }
        if ($case->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate(['info_reply' => 'required|string|min:2|max:2000']);

        $case->update([
            'info_reply' => $request->info_reply,
            'status'     => 'in_review',
        ]);

        if ($request->hasFile('reply_images')) {
            $existing = $case->images()->count();
            foreach ($request->file('reply_images') as $idx => $file) {
                $path = $file->store('cases', 'public');
                CaseImage::create(['case_id' => $case->id, 'path' => $path, 'order' => $existing + $idx]);
            }
        }

        return redirect()->route('cases.show', $case)->with('success', 'Your reply has been sent to the doctor.');
    }
}
