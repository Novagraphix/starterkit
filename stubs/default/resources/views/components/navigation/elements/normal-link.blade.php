@props(['to', 'is_to' => null, 'title' => 'Link', 'icon' => null])

<a data-turbolinks-action="replace"
   href="/{{ $to }}"
   class="{{ Request::is($is_to) ? 'bg-gray-900 text-white' : 'text-gray-300' }} group ml-4 inline-flex h-10 w-max items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors hover:bg-gray-900/50 hover:text-white focus:bg-gray-700 focus:text-white focus:outline-none focus:ring-2 focus:ring-secondary-500 disabled:pointer-events-none disabled:opacity-50">
    <div class="flex">
        @if ($icon)
            <span class="mr-[6px] text-secondary-400">@svg($icon, 'w-4 h-4')</span>
        @endif
        <div class="hidden lg:block">{{ $title }}</div>
    </div>
</a>
