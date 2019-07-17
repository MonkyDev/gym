<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.partials.htmlheader')
<body>
    <div id="app">

        @include('layouts.partials.sidebar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
@include('layouts.partials.scripts')
</body>
</html>
