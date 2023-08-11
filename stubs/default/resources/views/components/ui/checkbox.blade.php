@props([
    'label' => null,
    'name' => null,
    'id' => null,
])

<div class="flex h-5 items-center">
    <input type="checkbox"
           {{ $attributes->whereStartsWith('wire:model') }}
           id="{{ $id ?? '' }}"
           name="{{ $name ?? '' }}"
           class="peer hidden">
    <label for="{{ $id ?? '' }}"
           class="flex select-none items-center space-x-2 text-sm font-medium text-neutral-600 peer-checked:text-gray-800 peer-checked:[&_.custom-checkbox]:border-gray-800 peer-checked:[&_.custom-checkbox]:bg-gray-800 [&_svg]:scale-0 peer-checked:[&_svg]:scale-100">
        <span
              class="custom-checkbox flex h-5 w-5 items-center justify-center rounded border border-gray-300 text-neutral-900">
            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="3"
                 stroke="currentColor"
                 class="h-3 w-3 text-white duration-300 ease-out">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </span>
        <span>{{ $label ?? '' }}</span>
    </label>
</div>
