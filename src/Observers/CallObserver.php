<?php

namespace CrmPackage\Observers;

use CrmPackage\Models\Call;
use Illuminate\Support\Facades\DB;
use CrmPackage\Enums\LeadStatus;
use CrmPackage\Enums\CallResult;

class CallObserver
{
    public function created(Call $call)
    {
        $lead = $call->lead()->first();

        if ($lead->calls()->count() == 1 && $lead->status == LeadStatus::NEW) {
            $lead->status = LeadStatus::IN_PROGRESS;
        }

        if ($call->result == CallResult::SUCCESS) {
            $lead->status = LeadStatus::WON;
        }

        $lastThree = $lead->calls()->latest()->take(3)->pluck('result');

        if ($lastThree->count() == 3 && $lastThree->every(fn ($result) => $result == CallResult::NO_ANSWER) && $lead->status != LeadStatus::WON) {
            $lead->status = LeadStatus::LOST;
        }

        $lead->save();
    }
}