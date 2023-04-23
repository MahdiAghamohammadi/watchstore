<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    @include('admin.layouts.head-tag')
    @livewireStyles
    <title>@yield('title', 'قالب مدیریتی')</title>
</head>
<body class="small-navigation">
{{--Naviagtion--}}
@include('admin.layouts.navigation')
{{--Header--}}
@include('admin.layouts.header', [$title = $title ?? ""])
{{--Content--}}
@yield('content')
@include('admin.layouts.scripts')
@livewireScripts
</body>
</html>
