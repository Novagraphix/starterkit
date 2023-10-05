<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\LogoutController;
use App\Domains\Auth\Http\Controllers\SocialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('home', '/')->name('home');

Route::impersonate();

Route::middleware('guest')->group(function () {
    /* Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']); */

    Route::get('/auth/redirect', function () {
        return Socialite::driver('google')->redirect();
    })->name('social.login');

    Route::get('/auth/callback', [SocialController::class, 'registerProvider']);
});

Route::middleware('auth')->group(function () {
    /* Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify'); */
    Route::post('logout', LogoutController::class)
        ->name('logout');
});
