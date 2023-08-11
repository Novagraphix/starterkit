@props(['link', 'title', 'count' => 0])

<a href="{{ str_contains($link, '/') ? url($link) : route($link) }}"
   @click="navigationMenuClose()"
   class="dark:ring-gray-950 block rounded px-3.5 py-3 text-sm text-black ring-secondary-100 hover:bg-secondary-50 hover:ring-2 dark:text-white dark:hover:bg-gray-900">
    <div class="mb-1 flex items-center gap-2 font-medium 2xl:text-lg">
        <span>{{ $title }}</span>
        @if ($count > 0)
            <div class="grid h-5 w-5 place-content-center rounded-full bg-secondary-600 text-[10px] text-white">
                {{ $count }}</div>
        @endif
    </div>
    <span class="block text-xs font-light leading-5 opacity-50">{{ $slot }}</span>
</a>
