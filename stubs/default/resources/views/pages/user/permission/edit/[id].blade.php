<?php

use function Livewire\Volt\{computed, state};
use function Laravel\Folio\{middleware};

middleware(['role:Administrator']);
state(['id'])->url();

?>

<x-layouts.app>
    <x-slot name="header">
        {{ __('Berechtigung bearbeiten') }}
    </x-slot>

    <x-ui.content>
        @volt('permission')
            <div>
                <livewire:auth.permission-edit :permission="$id" />
            </div>
        @endvolt
    </x-ui.content>
</x-layouts.app>
