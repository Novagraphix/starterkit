<?php

namespace App\Domains\Auth\Http\Controllers;

use Exception;
use App\Domains\Auth\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function registerProvider($provider = 'google')
    {
        $info = Socialite::driver('google')->user();
        $user = User::where('provider_id', $info->id)->first();

        if (!$user) {
            DB::beginTransaction();

            try {
                $user = User::updateOrCreate(['email' => $info->email], [
                    'name' => $info->name,
                    'email' => $info->email,
                    'last_login_at' => now(),
                    'last_login_ip' => request()->getClientIp(),
                    'provider' => $provider,
                    'provider_id' => $info->id,
                    'email_verified_at' => now(),
                ]);
            } catch (Exception $e) {
                DB::rollBack();

                throw new Exception(__('There was a problem connecting to :provider', ['provider' => $provider]));
            }

            DB::commit();
        }

        $user->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->getClientIp(),
        ]);

        auth()->login($user);

        event(new Login(auth()->guard('web'), $user, false));
        toastr()->success('Erfolgreich mittels Google eingeloggt!', 'Geschafft!');

        return redirect()->intended('/');
    }
}
