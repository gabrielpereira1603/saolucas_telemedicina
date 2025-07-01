<?php

use App\Http\Middleware\Home\ValidateReferralMiddleware;
use App\Livewire\Pages\Checkout\CheckoutPro\CreateCheckoutClient\Index as IndexCreateCheckoutClient;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Templates\ValentinesDays\Index as IndexValentinesDaysTemplate;
use App\Livewire\Pages\Templates\Default\Index as IndexDefaultTemplate;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('home/{referral?}', IndexDefaultTemplate::class)
    ->name('home')
    ->middleware(ValidateReferralMiddleware::class);

Route::get('/subscribe/{plan}/{referral?}', IndexCreateCheckoutClient::class)
    ->name('subscribe.index');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
require __DIR__.'/web/admin/admin.php';
require __DIR__.'/web/clients/clients.php';
require __DIR__.'/web/sub_acquirers/sub_acquirers.php';
require __DIR__.'/web/white_labels/white_labels.php';

