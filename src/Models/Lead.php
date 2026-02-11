<?php

namespace CrmPackage\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'phone',
        'manager_id'
    ];
    protected $guarded = ['status'];

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function calls()
    {
        return $this->hasMany(Call::class);
    }
}