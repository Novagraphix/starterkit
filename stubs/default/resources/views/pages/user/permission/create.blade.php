<?php

use function Laravel\Folio\{middleware};

middleware(['role:Administrator']);

?>

<x-layouts.app>
    <x-slot name="header">
        {{ __('Berechtigung erstellen') }}
    </x-slot>

    <x-ui.content>
        <div>
            <livewire:auth.permission-create />
        </div>
    </x-ui.content>
</x-layouts.app>
