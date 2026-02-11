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

        if ($lead->calls()->count() == 1 && $lead->status == LeadStatus::NEW->value) {
            $lead->status = LeadStatus::IN_PROGRESS->value;
        }

        if ($call->result == CallResult::SUCCESS->value) {
            $lead->status = LeadStatus::WON->value;
        }

        $lastThree = $lead->calls()->latest()->take(3)->pluck('result');

        if ($lastThree->count() == 3 && $lastThree->every(fn ($result) => $result == CallResult::NO_ANSWER->value) && $lead->status != LeadStatus::WON->value) {
            $lead->status = LeadStatus::LOST->value;
        }

        $lead->save();
    }
}