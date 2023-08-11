@props(['menu', 'icon', 'title', 'subline'])

<div class="flex h-auto w-auto justify-center overflow-hidden rounded-md bg-gray-50 shadow-xl dark:bg-gray-800">

    <div x-show="navigationMenu == '{{ $menu }}'"
         class="flex w-full max-w-2xl items-stretch justify-center gap-x-3 p-6">
        <div
             class="flex h-full w-48 flex-col justify-end rounded bg-gradient-to-br from-secondary-500 to-secondary-900 pb-10 2xl:w-72">
            <div class="relative space-y-1 px-7 text-white">
                <span class="text-secondary-400">@svg($icon, 'w-10 h-10 2xl:w-16 2xl:h-16')</span>
                <span class="block text-2xl font-bold">{{ $title }}</span>
                <span class="block text-xs opacity-40">{{ $subline }}</span>
            </div>
        </div>
        <div class="w-72 2xl:w-80">

            <x-dynamic-component component="navigation.open.{{ $menu }}" />

        </div>
    </div>

</div>
