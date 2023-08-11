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

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <title>{{ $title ?? 'Novagraphix' }}</title>
</head>

<body class="antialiased bg-gray-50 font-urbanist"
      x-data="{ darkMode: false }"
      x-init="if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
          localStorage.setItem('darkMode', JSON.stringify(true));
      }
      darkMode = JSON.parse(localStorage.getItem('darkMode'));
      $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
      x-cloak
      x-bind:class="{ 'dark': darkMode === true }">
    {{ $slot }}
</body>

</html>
