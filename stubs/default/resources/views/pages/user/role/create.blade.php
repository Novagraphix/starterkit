<x-layouts.app>
    <x-slot name="header">
        {{ __('Rolle erstellen') }}
    </x-slot>

    <x-ui.content>
        <div>
            <livewire:auth.role-create />
        </div>
    </x-ui.content>
</x-layouts.app>
