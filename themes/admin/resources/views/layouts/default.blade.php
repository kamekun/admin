<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    @ThemeHead(before)
    @ThemeHead(after)
    @stack('styles')
</head>

<body class="{{ theme_class() }}" :class="themeDark && 'theme-dark'" x-data="{ themeDark: false }">
    @ThemeBody(before)
    <div class="page">
        <!-- Sidebar -->
        @include('theme::share.sidebar')
        @include('theme::share.header')
        <div class="page-wrapper">
            @yield('content')
        </div>
    </div>
    @ThemeBody(after)
    @stack('scripts')
</body>

</html>
