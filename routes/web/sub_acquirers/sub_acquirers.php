<?php

use App\Http\Middleware\Auth\EnsureUserInCorrectDomain;
use App\Livewire\Pages\Dashboard;

Route::prefix('sub_acquirers')
    ->middleware(['auth', 'verified', EnsureUserInCorrectDomain::class])
    ->group(function () {
        Route::get('dashboard', Dashboard::class)->name('sub_acquirers.dashboard');
    });
