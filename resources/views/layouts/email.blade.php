<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('meta.name') }}</title>
    <meta name="author" content="{{ config('meta.author') }}" />
    <meta name="description" content="{{ config('meta.description') }}" />
    <meta name="keywords" content="{{ config('meta.keywords') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    @stack('styles')
  </head>
  <body>
    <main>{{ $slot }}</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    @stack('scripts')
  </body>
</html>
