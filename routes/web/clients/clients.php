<?php

use App\Http\Middleware\Auth\EnsureUserInCorrectDomain;
use App\Livewire\Pages\Client\Dashboard\Index as DashboardClient;

Route::prefix('clients')
    ->middleware(['auth', 'verified', EnsureUserInCorrectDomain::class])
    ->group(function () {
        Route::get('dashboard', DashboardClient::class)->name('clients.dashboard');
    });
