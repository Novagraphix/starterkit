@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'disabled' => false,
])

@php $wireModel = $attributes->get('wire:model'); @endphp

<div>
    @if ($label)
        <label for="{{ $id ?? '' }}"
               class="block text-sm font-medium leading-5 text-gray-700">
            {{ __($label) }}
        </label>
    @endif

    <div class="mt-1 rounded-md shadow-sm">
        <input {{ $disabled ? 'disabled' : '' }}
               {!! $attributes->whereStartsWith(['wire:model', 'class'])->merge([
                   'class' =>
                       'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm disabled:bg-slate-50 disabled:text-gray-300 placeholder:text-gray-300 dark:bg-gray-900 dark:border-gray-600 dark:placeholder:text-gray-600 dark:disabled:text-gray-600 dark:text-white',
               ]) !!}
               id="{{ $id ?? '' }}"
               name="{{ $name ?? '' }}"
               type="{{ $type ?? '' }}"
               required
               autofocus />
    </div>

    @error($wireModel)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
