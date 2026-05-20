<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DermatologyCase;
use Illuminate\Http\Request;

class CaseController extends Controller
{
    public function index(Request $request)
    {
        $validStatuses = ['submitted', 'needs_info', 'in_review', 'diagnosed', 'closed'];
        $status = in_array($request->query('status'), $validStatuses, true)
            ? $request->query('status')
            : null;

        $query = DermatologyCase::with(['user', 'doctor', 'images'])->latest();

        if ($status) {
            $query->where('status', $status);
        }

        $cases = $query->get();

        $counts = ['all' => DermatologyCase::count()];
        foreach ($validStatuses as $s) {
            $counts[$s] = DermatologyCase::where('status', $s)->count();
        }

        return view('admin.cases.index', compact('cases', 'status', 'counts'));
    }

    public function show(DermatologyCase $case)
    {
        $case->load(['user', 'doctor', 'images']);

        return view('admin.cases.show', compact('case'));
    }
}
