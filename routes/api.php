<?php

use Illuminate\Support\Facades\Route;
use CrmPackage\Http\Controllers\LeadController;
use CrmPackage\Http\Controllers\CallController;
use CrmPackage\Http\Controllers\ManagerController;

Route::prefix('api')->group(function () {
    Route::post('/leads', [LeadController::class, 'store']);
    Route::post('/leads/{lead}/calls', [CallController::class, 'store']);
    Route::get('/managers/{manager}/leads', [ManagerController::class, 'leads']);

});