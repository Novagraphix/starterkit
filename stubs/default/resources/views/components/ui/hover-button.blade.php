@props([
    'title' => 'empty',
    'type' => 'primary',
    'size' => 'md',
    'tag' => 'button',
    'href' => '/',
    'icon' => '',
    'overlay_icon' => 'fas-fingerprint',
    'submit' => false,
    'params' => null,
    'direction' => 'right',
])

@php
    $directionClasses = match ($direction) {
        'left' => [
            'text' => 'group-hover:translate-x-full group-hover:blur-lg',
            'overlay' => '-translate-x-full group-hover:translate-x-0 blur-lg group-hover:blur-none opacity-0 group-hover:opacity-100',
        ],
        'right' => [
            'text' => 'group-hover:-translate-x-full group-hover:blur-lg',
            'overlay' => 'translate-x-full group-hover:translate-x-0 blur-lg group-hover:blur-none opacity-0 group-hover:opacity-100',
        ],
        'top' => [
            'text' => 'group-hover:-translate-y-full group-hover:blur-lg',
            'overlay' => 'translate-y-full group-hover:translate-y-0 blur-lg group-hover:blur-none opacity-0 group-hover:opacity-100',
        ],
        'bottom' => [
            'text' => 'group-hover:translate-y-full group-hover:blur-lg',
            'overlay' => '-translate-y-full group-hover:translate-y-0 blur-lg group-hover:blur-none opacity-0 group-hover:opacity-100',
        ],
        'fancy' => [
            'text' => 'group-hover:translate-x-full group-hover:blur-lg group-hover:-rotate-90',
            'overlay' => '-translate-x-full rotate-90 blur-lg group-hover:translate-x-0 group-hover:rotate-0 group-hover:blur-none opacity-0 group-hover:opacity-100',
        ],
    };

    $sizeClasses = match ($size) {
        'xs' => [
            'body' => 'px-4 py-1 text-[0.65rem] leading-none font-medium rounded-md',
            'icon' => 'w-3 h-3',
            'overlay-icon' => 'w-3 h-3',
        ],
        'sm' => [
            'body' => 'px-4 py-1.5 text-xs leading-none font-medium rounded-md',
            'icon' => 'w-3 h-3',
            'overlay-icon' => 'w-4 h-4',
        ],
        'md' => [
            'body' => 'px-5 py-2 rounded-md font-semibold text-xs leading-none',
            'icon' => 'w-3 h-3',
            'overlay-icon' => 'w-5 h-5',
        ],
        'lg' => [
            'body' => 'px-5 h-10  text-sm leading-none font-semibold rounded-md',
            'icon' => 'w-4 h-4',
            'overlay-icon' => 'w-5 h-5',
        ],
        'xl' => [
            'body' => 'px-6 py-3.5 text-base leading-none font-medium rounded-md',
            'icon' => 'w-4 h-4',
            'overlay-icon' => 'w-6 h-6',
        ],
        '2xl' => [
            'body' => 'px-7 py-4 text-base leading-none font-medium rounded-md',
            'icon' => 'w-4 h-4',
            'overlay-icon' => 'w-6 h-6',
        ],
    };

    $typeClasses = match ($type) {
        'primary' => [
            'body' => 'bg-gray-800 dark:bg-gray-200',
            'overlay' => 'bg-secondary-400 text-white active:bg-secondary-700',
            'text' => 'text-white tracking-widest uppercase dark:text-gray-800',
        ],
        'secondary' => [
            'body' => 'bg-gray-200 dark:bg-gray-700',
            'overlay' => 'bg-gray-800 text-white active:bg-gray-500 dark:bg-gray-500 dark:active:bg-gray-700',
            'text' => 'text-gray-900 tracking-widest uppercase dark:text-gray-200',
        ],
        'success' => [
            'body' => 'bg-green-500 dark:bg-green-700',
            'overlay' => 'bg-green-800 text-white active:bg-green-500',
            'text' => 'text-white tracking-widest uppercase',
        ],
        'info' => [
            'body' => 'bg-blue-500 dark:bg-blue-700',
            'overlay' => 'bg-blue-800 text-white active:bg-blue-500',
            'text' => 'text-white tracking-widest uppercase',
        ],
        'warning' => [
            'body' => 'bg-amber-500 dark:bg-amber-700',
            'overlay' => 'bg-amber-800 text-white active:bg-amber-500',
            'text' => 'text-white tracking-widest uppercase',
        ],
        'danger' => [
            'body' => 'bg-red-500 dark:bg-red-700',
            'overlay' => 'bg-red-800 text-white active:bg-red-500',
            'text' => 'text-white tracking-widest uppercase',
        ],
    };

    switch ($tag ?? 'button') {
        case 'button':
            $tagAttr = $submit ? 'button type="submit"' : 'button type="button"';
            $tagClose = 'button';
            break;
        case 'a':
            $link = $href ?? '';
            $tagAttr = 'a  href="' . $link . '"';
            $tagClose = 'a';
            break;
        case 'route':
            $tagAttr = 'a  href="' . route($href, $params) . '"';
            $tagClose = 'a';
            break;
        default:
            $tagAttr = 'button type="button"';
            $tagClose = 'button';
            break;
    }
@endphp

<{!! $tagAttr !!} {!! $attributes !!}
                         @class([
                             "{$typeClasses['body']} {$sizeClasses['body']} group relative inline-flex cursor-pointer items-center justify-center overflow-hidden transition duration-300 ease-out",
                             '!px-0' => $title == 'empty',
                         ])>
    <span
          class="ease {{ $typeClasses['overlay'] }} {{ $directionClasses['overlay'] }} absolute inset-0 z-10 flex h-full w-full items-center justify-center duration-300 active:scale-105">
        @svg($overlay_icon, $sizeClasses['overlay-icon'])
    </span>
    <span
          class="ease {{ $typeClasses['text'] }} {{ $directionClasses['text'] }} absolute z-0 flex h-full w-full transform items-center justify-center transition-all duration-300">
        @if ($icon != '')
            @svg($icon, $sizeClasses['icon'])
        @endif
        <span @class(['ml-1' => $icon != '', 'hidden' => $title == 'empty'])>{{ $title }}</span>
    </span>
    <span @class([
        "{$typeClasses['text']} invisible relative",
        '!-px-12 !tracking-tighter !lowercase' => $title == 'empty',
    ])>
        {{ $title }}
    </span>
    </{{ $tagClose }}>
