<?php

namespace App\Http\Controllers;

use App\Models\DermatologyCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CaseController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'patient') {
            $cases = DermatologyCase::where('user_id', $user->id)->latest()->get();
            return view('cases.index', compact('cases'));
        } 
        
        // Doctor view: Separate pending and diagnosed
        $pendingCases = DermatologyCase::with('user')->where('status', 'pending')->latest()->get();
        $diagnosedCases = DermatologyCase::with('user')->where('status', 'diagnosed')->latest()->get();

        return view('cases.index', compact('pendingCases', 'diagnosedCases'));
    }

    public function create()
    {
        return view('cases.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
            'description' => 'required|string|min:10',
        ]);

        $imagePath = $request->file('image')->store('cases', 'public');

        DermatologyCase::create([
            'user_id' => auth()->id(),
            'image_path' => $imagePath,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Case submitted successfully!');
    }

    public function show(DermatologyCase $case)
    {
        if (auth()->user()->role === 'patient' && $case->user_id !== auth()->id()) {
            abort(403);
        }

        return view('cases.show', compact('case'));
    }

    public function updateDiagnosis(Request $request, DermatologyCase $case)
    {
        if (auth()->user()->role !== 'doctor') {
            abort(403);
        }

        $request->validate([
            'diagnosis' => 'required|string|min:5',
            'treatment' => 'required|string|min:5',
        ]);

        $case->update([
            'doctor_id' => auth()->id(),
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'status' => 'diagnosed',
        ]);

        return redirect()->route('cases.show', $case)->with('success', 'Diagnosis updated successfully!');
    }
}
