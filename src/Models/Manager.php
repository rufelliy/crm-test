<?php

namespace CrmPackage\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}