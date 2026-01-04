<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', [App\Http\Controllers\SneakerController::class, 'index'])->name('home');
Route::get('/sneakers', [App\Http\Controllers\SneakerController::class, 'index'])->name('sneakers.index');
Route::get('/sneakers/{sneaker}', [App\Http\Controllers\SneakerController::class, 'show'])->name('sneakers.show');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
