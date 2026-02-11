<?php

namespace CrmPackage\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use CrmPackage\Models\Lead;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'status' => ['nullable', 'in:new,in_progress,won,lost'],
            'manager_id' => ['nullable', 'exists:managers,id'],
        ]);

        $lead = Lead::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'status' => $validated['status'] ?? 'new',
            'manager_id' => $validated['manager_id'] ?? null,
        ]);

        return response()->json([
            'message' => 'Lead created successfully',
            'data' => $lead
        ], 201);
    }
}