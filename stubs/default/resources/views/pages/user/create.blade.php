<x-layouts.app>
    <x-slot name="header">
        {{ __('Benutzer erstellen') }}
    </x-slot>

    <x-ui.content>
        <div>
            <livewire:auth.user-create />
        </div>
    </x-ui.content>
</x-layouts.app>
