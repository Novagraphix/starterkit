@props(['name', 'text', 'subtext' => ''])

<div {{ $attributes->merge(['class' => 'flex items-start']) }}>
    <div class="flex items-center h-5">
        <input {{ $attributes->merge(['checked']) }}
               name="{{ $name }}"
               type="checkbox"
               class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
    </div>
    <div class="ml-3 text-sm">
        <label for="comments"
               class="font-medium text-gray-700 dark:text-gray-100">{{ $text }}</label>
        <p class="text-gray-500">{{ $subtext }}</p>
    </div>
</div>
