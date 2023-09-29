<div class="px-8 py-2 bg-white dark:bg-gray-800 md:flex md:items-center md:justify-between">
    <div class="flex-1 min-w-0">
        <div class="text-lg font-bold leading-7 text-gray-700 dark:text-white sm:truncate sm:text-xl sm:tracking-tight">
            <div class="flex items-center">
                {{ $header }}
            </div>

        </div>
    </div>
    @if (isset($buttons))
        <div class="mt-2 md:mt-0">
            {{ $buttons }}
        </div>
    @endif
</div>
