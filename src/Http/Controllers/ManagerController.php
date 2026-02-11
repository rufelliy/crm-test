<?php

namespace CrmPackage\Http\Controllers;

use Illuminate\Routing\Controller;
use CrmPackage\Models\Manager;

class ManagerController extends Controller
{
    public function index($managerId)
    {
        $manager = Manager::findOrFail($managerId);
        $leads = $manager->leads()
            ->withCount('calls')
            ->withSum('calls', 'duration')
            ->get()
            ->map(function ($lead) {
                return [
                    'id' => $lead->id,
                    'name' => $lead->name,
                    'status' => $lead->status,
                    'calls_count' => $lead->calls_count ?? 0,
                    'total_call_duration' => $lead->calls_sum_duration ?? 0,
                ];
            });

        return response()->json([
            'data' => $leads
        ]);
    }
}