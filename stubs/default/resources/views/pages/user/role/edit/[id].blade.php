<?php

use function Livewire\Volt\{computed, state};
use function Laravel\Folio\{middleware};

middleware(['role:Administrator']);
state(['id'])->url();

?>

<x-layouts.app>
    <x-slot name="header">
        {{ __('Rolle bearbeiten') }}
    </x-slot>

    <x-ui.content>
        @volt('role')
            <div>
                <livewire:auth.role-edit :role="$id" />
            </div>
        @endvolt
    </x-ui.content>
</x-layouts.app>
