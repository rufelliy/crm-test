<?php

namespace CrmPackage\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'lead_id',
        'manager_id',
        'duration',
        'result',
        'created_at'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
