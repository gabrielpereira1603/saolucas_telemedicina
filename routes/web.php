<?php

use App\Livewire\Pages\Checkout\CheckoutPro\CreateCheckoutClient\Index as IndexCreateCheckoutClient;
use App\Livewire\Pages\Checkout\CheckoutPro\Response\Index as CheckoutResponse;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Templates\ValentinesDays\Index as IndexValentinesDaysTemplate;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

;

Route::get('/', IndexValentinesDaysTemplate::class)->name('home');

Route::get('/subscribe/{plan}/{referral?}', IndexCreateCheckoutClient::class)
    ->name('subscribe.index');


Route::get('/checkout/status/{sale}', CheckoutResponse::class)
    ->name('checkout.status');


Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

