<!DOCTYPE html>
<html lang="en">
<head>
    @include('visitor.layouts.header_styles')
    @yield("css")
</head>
<body>
    @include('visitor.layouts.header')
    @yield('content')
    @include('visitor.layouts.footer')
    @include('visitor.layouts.footer_scripts')
    @yield("script")
</body>
</html>
