<x-layouts.app>
    @volt('dashboard')
        <div>
            <x-ui.top-nav>
                <x-slot name="title">
                    <span class="font-black">laravel</span>starterkit
                </x-slot>
            </x-ui.top-nav>
        </div>
    @endvolt
</x-layouts.app>
