<x-layouts.app>
    <x-slot name="header">
        @lang('welcome', ['name' => Auth::user()->name])
    </x-slot>

    @volt('dashboard')
        <x-ui.content>

            <x-ui.hover-button icon="fas-plus"
                               size="xs" />

            <x-ui.hover-button title="{{ __('baasdfasdfasdfasdck') }}"
                               icon="fas-plus"
                               size="sm"
                               type="secondary" />

            <x-ui.hover-button title="{{ __('logout') }}"
                               icon="fas-arrow-right-from-bracket"
                               type="success" />

            <x-ui.hover-button title="{{ __('login') }}"
                               size="lg"
                               type="info"
                               direction="left" />

            <x-ui.hover-button title="{{ __('back') }}"
                               icon="fas-plus"
                               size="xl"
                               type="warning"
                               direction="fancy" />

            <x-ui.hover-button icon="fas-trash"
                               size="2xl"
                               type="danger" />

        </x-ui.content>
    @endvolt
</x-layouts.app>
