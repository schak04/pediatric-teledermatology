<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DermatologyCase;
use Illuminate\Http\Request;

class CaseController extends Controller
{
    public function index(Request $request)
    {
        $status = in_array($request->query('status'), ['pending', 'diagnosed'], true)
            ? $request->query('status')
            : null;

        $query = DermatologyCase::with(['user', 'doctor'])->latest();

        if ($status) {
            $query->where('status', $status);
        }

        $cases = $query->get();

        $counts = [
            'all' => DermatologyCase::count(),
            'pending' => DermatologyCase::where('status', 'pending')->count(),
            'diagnosed' => DermatologyCase::where('status', 'diagnosed')->count(),
        ];

        return view('admin.cases.index', compact('cases', 'status', 'counts'));
    }

    public function show(DermatologyCase $case)
    {
        $case->load(['user', 'doctor']);

        return view('admin.cases.show', compact('case'));
    }
}
