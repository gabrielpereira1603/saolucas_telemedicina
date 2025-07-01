<?php

use App\Http\Middleware\Auth\EnsureUserInCorrectDomain;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\WhiteLabel\Dashboard\Index as HomeWhiteLabel;;

Route::prefix('white_labels')
    ->middleware(['auth', 'verified', EnsureUserInCorrectDomain::class])
    ->group(function () {
        Route::get('dashboard', HomeWhiteLabel::class)->name('white_labels.dashboard');
    });

