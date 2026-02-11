<?php

namespace CrmPackage\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use CrmPackage\Models\Lead;

class CallController extends Controller
{
    public function store(Request $request, $leadId)
    {
        $lead = Lead::findOrFail($leadId);
        $validated  = $request->validate([
            'duration' => 'required|integer|min:1',
            'result' => 'required|in:no_answer,callback_later,success',
            'manager_id' => 'required|exists:managers,id',
        ]);

        if (!$lead->manager_id) {
            $lead->manager_id = $validated['manager_id'];
        }

        $call = $lead->calls()->create([
            'duration' => $validated['duration'],
            'result' => $validated['result'],
            'created_at' => now(),
        ]);

        $lead->save();

        return response()->json([
            'message' => 'Call added successfully',
            'data' => $call
        ], 201);
    }
}
