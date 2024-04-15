<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PromoterController;
use \App\Http\Controllers\SkillController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('promoter')->group(function(){
    Route::get('/{id}', [PromoterController::class, 'show'])->name('promoter.show');
    Route::post('', [PromoterController::class, 'store'])->name('promoter.store');
    Route::put('/{id}', [PromoterController::class, 'update'])->name('promoter.update');
    Route::delete('/{id}', [PromoterController::class, 'destroy'])->name('promoter.destroy');
    Route::put('/skill-add/{id}', [PromoterController::class, 'skillAdd'])->name('promoter.skill.add');
});

