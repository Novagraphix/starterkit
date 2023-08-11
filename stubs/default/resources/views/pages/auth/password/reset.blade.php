<?php

use Illuminate\Support\Facades\Password;
use function Livewire\Volt\{state, rules};

state(['email' => null, 'emailSentMessage' => false]);
rules(['email' => 'required|email']);

$sendResetPasswordLink = function () {
    $this->validate();

    $response = Password::broker()->sendResetLink(['email' => $this->email]);

    if ($response == Password::RESET_LINK_SENT) {
        $this->emailSentMessage = trans($response);

        return;
    }

    $this->addError('email', trans($response));
};

?>

<x-layouts.app>

    <div class="flex flex-col items-stretch justify-center w-screen h-screen sm:items-center">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <x-ui.logo />
        </div>

        @volt('auth.password.reset')
            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="px-10 py-0 border-gray-200/60 sm:rounded-lg sm:border sm:bg-white sm:py-8 sm:shadow-sm">
                    <div class="mb-4 text-xs leading-1">
                        Haben Sie Ihr Passwort vergessen? Kein Problem. Teilen Sie uns einfach Ihre E-Mail-Adresse mit und
                        wir senden Ihnen per E-Mail einen Link zum Zurücksetzen des Passworts, mit dem Sie ein neues
                        auswählen können.
                    </div>
                    @if ($emailSentMessage)
                        <div class="p-4 rounded-md bg-green-50">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-400"
                                         fill="currentColor"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                              clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <div class="ml-3">
                                    <p class="text-sm font-medium leading-5 text-green-800">
                                        {{ $emailSentMessage }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <form wire:submit="sendResetPasswordLink"
                              class="space-y-6">
                            <x-ui.text-input label="E-Mail"
                                             type="email"
                                             id="email"
                                             class="w-full"
                                             name="email"
                                             wire:model="email" />
                            <div class="flex justify-end gap-2">
                                <x-ui.button type="primary"
                                             submit="true">Link senden</x-ui.button>
                                <x-ui.button type="secondary"
                                             tag="a"
                                             href="/auth/login">Abbrechen</x-ui.button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        @endvolt

    </div>

</x-layouts.app>
