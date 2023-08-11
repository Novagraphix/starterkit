@props(['icon' => null])

<a
   {{ $attributes->merge(['class' => 'flex gap-2 w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out dark:text-gray-100 dark:hover:bg-gray-600']) }}>
    @if ($icon)
        @svg($icon, 'w-3 md:w-4 h-3 md:h-4')
    @endif
    {{ $slot }}
</a>
