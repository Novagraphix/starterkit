@props(['label' => 'Label', 'label_class' => ''])

<label class="relative inline-flex items-center cursor-pointer">
    <input type="checkbox"
           value=""
           {{ $attributes->merge(['class' => 'peer sr-only']) }}>
    <div
         class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300">
    </div>
    <span class="{{ $label_class }} ml-3 text-sm text-gray-900 dark:text-gray-100">{{ $label }}</span>
</label>
