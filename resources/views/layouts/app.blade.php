<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body>
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header style="background-color: white; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                <div style="max-width: 80rem; margin-left: auto; margin-right: auto; padding-top: 1.5rem; padding-bottom: 1.5rem; padding-left: 1rem; padding-right: 1rem;">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main style="min-height: 100vh; background-color: #f3f4f6;">
            {{ $slot }}
        </main>
    </body>
</html>
