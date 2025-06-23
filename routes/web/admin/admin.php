<?php

use App\Http\Middleware\Auth\EnsureUserInCorrectDomain;
use App\Livewire\Pages\Dashboard;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->middleware(['auth', 'verified', EnsureUserInCorrectDomain::class])
    ->group(function () {
        Route::get('dashboard', Dashboard::class)->name('admin.dashboard');
    });
