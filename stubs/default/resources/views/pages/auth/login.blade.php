<?php

use App\Domains\Auth\Models\User;
use Illuminate\Auth\Events\Login;
use function Laravel\Folio\{middleware};
use function Livewire\Volt\{state, rules};

middleware(['guest']);
state(['email' => '', 'password' => '', 'remember' => false]);
rules(['email' => 'required|email', 'password' => 'required']);

$authenticate = function () {
    $this->validate();

    if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
        $this->addError('email', trans('auth.failed'));

        return;
    }

    $user = User::where('email', $this->email)->first();
    $user->update([
        'last_login_at' => now(),
        'last_login_ip' => request()->getClientIp(),
    ]);

    event(new Login(auth()->guard('web'), $user, $this->remember));

    return redirect()->intended('/');
};

?>

<x-layouts.app>

    <x-ui.auth-card>

        <x-slot name="logo">
            <x-ui.logo />
        </x-slot>

        @volt('auth.login')
            <form wire:submit="authenticate"
                  class="space-y-6">

                <x-ui.text-input label="Email address"
                                 type="email"
                                 class="w-full"
                                 id="email"
                                 name="email"
                                 wire:model="email" />

                <x-ui.text-input label="Password"
                                 type="password"
                                 class="w-full"
                                 id="password"
                                 name="password"
                                 wire:model="password" />

                <div class="flex items-center justify-between mt-6 text-sm leading-5">
                    <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none"
                       href="/auth/password/reset">
                        {{ __('Forgot your password?') }}
                    </a>

                    <div class="flex gap-2">
                        <x-ui.button type="primary"
                                     submit="true"
                                     icon="fas-door-open"
                                     title="{{ __('Login') }}" />
                        @if (config('starterkit.socialite') == true)
                            <x-ui.button type="primary"
                                         tag="route"
                                         href="social.login"
                                         icon="fab-google"
                                         title="{{ __('Google') }}" />
                        @endif
                    </div>
                </div>

            </form>
        @endvolt

    </x-ui.auth-card>

</x-layouts.app>
