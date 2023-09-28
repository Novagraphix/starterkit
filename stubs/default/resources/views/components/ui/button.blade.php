@props([
    'title' => '',
    'type' => 'primary',
    'size' => 'md',
    'tag' => 'button',
    'href' => '/',
    'icon' => '',
    'submit' => false,
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'px-2 py-1 text-[0.65rem] leading-none font-medium rounded-md',
        'sm' => 'px-2.5 py-1.5 text-xs leading-none font-medium rounded-md',
        'md' => 'px-4 py-2 rounded-md font-semibold text-xs leading-none',
        'lg' => 'px-5 h-10  text-xs leading-none font-semibold rounded-md',
        'xl' => 'px-6 py-3.5 text-base leading-none font-medium rounded-md',
        '2xl' => 'px-7 py-4 text-base leading-none font-medium rounded-md',
    };

    $sizeClassesIcon = match ($size) {
        'xs' => 'w-2 md:w-3 h-2 md:h-3',
        'sm' => 'w-2 md:w-3 h-2 md:h-3',
        'md' => 'w-2 md:w-3 h-2 md:h-3',
        'lg' => 'w-2 md:w-3 h-2 md:h-3',
        'xl' => 'w-3 md:w-4 h-3 md:h-4',
        '2xl' => 'w-3 md:w-4 h-3 md:h-4',
    };

    $typeClasses = match ($type) {
        'primary' => 'bg-gray-800 border border-transparent text-white tracking-widest hover:bg-gray-800/80 focus:bg-gray-800/50 active:bg-gray-900 focus:ring-2 focus:ring-secondary-500 dark:bg-gray-200 dark:text-gray-900',
        'secondary' => 'bg-gray-200 rounded-md border text-gray-900 hover:text-gray-700 border-gray-200/70 hover:bg-gray-50 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-gray-200/60 focus:shadow-outline',
        'success' => 'bg-green-600 text-white hover:bg-green-600/90 focus:ring-2 focus:ring-offset-2 focus:bg-green-700/90 focus:ring-green-700',
        'info' => 'bg-blue-600 text-white hover:bg-blue-600/90 focus:ring-2 focus:ring-offset-2 focus:bg-blue-700/90 focus:ring-blue-700',
        'warning' => 'bg-amber-500 text-white hover:bg-amber-500/90 focus:ring-2 focus:ring-offset-2 focus:bg-amber-600/90 focus:ring-amber-600',
        'danger' => 'bg-red-600 text-white hover:bg-red-600/80 focus:ring-2 focus:ring-offset-2 focus:bg-red-700/90 focus:ring-red-700',
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
        default:
            $tagAttr = 'button type="button"';
            $tagClose = 'button';
            break;
    }
@endphp

<{!! $tagAttr !!} {!! $attributes !!}
                         class="{{ $sizeClasses }} {{ $typeClasses }} inline-flex cursor-pointer items-center justify-center uppercase transition-colors duration-500 focus:outline-none">
    @if ($icon == '' && $title == '')
        @svg('fas-backspace', $sizeClassesIcon)
    @elseif ($icon != '')
        @svg($icon, $sizeClassesIcon)
    @endif
    @if ($icon == '' && $title == '')
        <span>Zurück</span>
    @elseif ($title != '')
        <span @class(['ml-1' => $icon != ''])>{{ $title }}</span>
    @endif
    {{ $slot }}
    </{{ $tagClose }}>
