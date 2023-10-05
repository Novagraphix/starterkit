<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect"
          href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=urbanist:300,400,500,600,700,900"
          rel="stylesheet" />

    @stack('before-styles')
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @stack('after-styles')

    <title>{{ $title ?? 'Novagraphix' }}</title>
</head>

<body class="antialiased font-urbanist"
      x-data="{ darkMode: false }"
      x-init="if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
          localStorage.setItem('darkMode', JSON.stringify(true));
      }
      darkMode = JSON.parse(localStorage.getItem('darkMode'));
      $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
      x-cloak
      x-bind:class="{ 'dark': darkMode === true }">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        @if (!Auth::guest())
            <div>
                <x-ui.top-nav>
                    <x-slot name="title">
                        <span class="font-black">laravel</span>starterkit
                    </x-slot>
                </x-ui.top-nav>
            </div>
        @endif

        <!-- Page Heading -->
        @if (isset($header))
            <x-includes.header :header="$header"
                               :buttons="$buttons ?? null" />
        @endif

        <div>
            {{ $slot }}
        </div>

        <div>
            <x-includes.footer />
        </div>

        @impersonating($guard = null)
            <a href="{{ route('impersonate.leave') }}">
                <div
                     class="fixed bottom-0 left-0 w-full text-xs font-bold text-center uppercase border-t-2 border-t-amber-600 bg-amber-500">
                    Impersonation beenden
                </div>
            </a>
        @endImpersonating
    </div>
</body>

</html>
