<?php

use function Laravel\Folio\{middleware};
use function Livewire\Volt\{state, rules};

middleware(['redirect-to-dashboard']);

?>

<x-layouts.app>

    @volt('home')
        <div class="relative flex flex-col items-center justify-center min-h-screen pt-6 dark:bg-gray-900 sm:pt-0">

            <div class="absolute top-0 left-0 flex items-center justify-end w-full h-12 gap-2 px-6 bg-gray-600 shadow">
                <x-ui.button type="primary"
                             tag="a"
                             href="/auth/register"
                             title="Register" />
                <x-ui.button type="primary"
                             tag="a"
                             href="/auth/login"
                             title="Login" />
            </div>

            <div>
                <img class="w-64 aspect-auto"
                     src="/images/novagraphix_logo.svg"
                     alt="">
            </div>

            <div class="mt-6 text-3xl font-bold tracking-wider uppercase text-nova-gray">Laravel Starterkit</div>

        </div>
    @endvolt

</x-layouts.app>
