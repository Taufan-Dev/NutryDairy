<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- ================== END BASE CSS STYLE ================== -->

    @stack('css')
</head>
@php
    $bodyClass = !empty($appBoxedLayout) ? 'boxed-layout ' : '';
    $bodyClass .= !empty($paceTop) ? 'pace-top ' : $bodyClass;
    $bodyClass .= !empty($bodyClass) ? $bodyClass . ' ' : $bodyClass;
    $appSidebarHide = !empty($appSidebarHide) ? $appSidebarHide : '';
    $appHeaderHide = !empty($appHeaderHide) ? $appHeaderHide : '';
    $appSidebarTwo = !empty($appSidebarTwo) ? $appSidebarTwo : '';
    $appSidebarSearch = !empty($appSidebarSearch) ? $appSidebarSearch : '';
    $appTopMenu = !empty($appTopMenu) ? $appTopMenu : '';

    $appClass = !empty($appTopMenu) ? 'app-with-top-menu ' : '';
    $appClass .= !empty($appHeaderHide) ? 'app-without-header ' : ' app-header-fixed ';
    $appClass .= !empty($appSidebarEnd) ? 'app-with-end-sidebar ' : '';
    $appClass .= !empty($appSidebarWide) ? 'app-with-wide-sidebar ' : '';
    $appClass .= !empty($appSidebarHide) ? 'app-without-sidebar ' : '';
    $appClass .= !empty($appSidebarMinified) ? 'app-sidebar-minified ' : '';
    $appClass .= !empty($appSidebarTwo) ? 'app-with-two-sidebar app-sidebar-end-toggled ' : '';
    $appClass .= !empty($appSidebarHover) ? 'app-with-hover-sidebar ' : '';
    $appClass .= !empty($appContentFullHeight) ? 'app-content-full-height ' : '';

    $appContentClass = !empty($appContentClass) ? $appContentClass : '';
@endphp

<body class="{{ $bodyClass }}">
    @include('admin.layout.component.page-loader')

    <div id="app" class="app app-sidebar-fixed {{ $appClass }}">

        @includeWhen(!$appHeaderHide, 'admin.layout.header')

        @includeWhen($appTopMenu, 'admin.layout.top-menu')

        @includeWhen(!$appSidebarHide, 'admin.layout.sidebar')

        @includeWhen($appSidebarTwo, 'admin.layout.sidebar-right')

        <div id="content" class="app-content {{ $appContentClass }}">
            @yield('content')
        </div>
        
        @include('admin.layout.footer')

        @include('admin.layout.component.scroll-top-btn')

    </div>

    @yield('outside-content')

    @include('admin.layout.page-js')
</body>

</html>
