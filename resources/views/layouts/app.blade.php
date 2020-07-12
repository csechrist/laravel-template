<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("template_parts.head")

<body class="@if($use_recaptcha ?? false) show-recaptcha @endif">

    @yield('content')

    @include("template_parts.scripts")
</body>

</html>
