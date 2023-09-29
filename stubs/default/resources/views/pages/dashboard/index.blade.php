<x-layouts.app>
    <x-slot name="header">
        @lang('welcome', ['name' => Auth::user()->name])
    </x-slot>

    @volt('dashboard')
        <x-ui.content>
            Dashboard
        </x-ui.content>
    @endvolt
</x-layouts.app>
