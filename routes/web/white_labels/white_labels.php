<?php

use App\Http\Middleware\Auth\EnsureUserInCorrectDomain;
use App\Livewire\Pages\Dashboard;

Route::prefix('white_labels')
    ->middleware(['auth', 'verified', EnsureUserInCorrectDomain::class])
    ->group(function () {
        Route::get('dashboard', Dashboard::class)->name('white_labels.dashboard');
    });

