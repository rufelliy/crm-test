<?php

namespace CrmPackage\Observers;

use CrmPackage\Models\Call;
use Illuminate\Support\Facades\DB;

class CallObserver
{
    public function created(Call $call)
    {
        $lead = $call->lead()->first();

        if ($lead->calls()->count() === 1 && $lead->status === 'new') {
            $lead->status = 'in_progress';
        }

        if ($call->result === 'success') {
            $lead->status = 'won';
        }

        $lastThree = $lead->calls()->latest()->take(3)->pluck('result');

        if ($lastThree->count() === 3 &&
            $lastThree->every(fn ($result) => $result === 'no_answer')) {
            $lead->status = 'lost';
        }

        $lead->save();
    }
}