<?php

use App\Domains\Auth\Models\User;
use function Livewire\Volt\{computed, state};

state(['id'])->url();

?>

<x-layouts.app>
    <x-slot name="header">
        {{ __('Benutzer bearbeiten') }}
    </x-slot>

    <x-ui.content>
        @volt('user')
            <div>
                <livewire:auth.user-edit :user="$id" />
            </div>
        @endvolt
    </x-ui.content>
</x-layouts.app>
