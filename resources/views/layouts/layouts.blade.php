<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('meta_description', config('app.name'))">
    <meta name="author" content="@yield('meta_author', config('app.name'))">

    @yield('meta')

    @stack('before-styles')
    <link rel="stylesheet" href="{{ asset('/admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}">

    
    @stack('after-styles')
    @if (trim($__env->yieldContent('page-styles')))
        @yield('page-styles')
    @endif

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/theme2.css') }}">
</head>

<body class="font-montserrat">

    <!-- Page Loader -->
    {{-- <div class="page-loader-wrapper">
        <div class="loader">
        </div>
    </div> --}}





    <div id="main_content">

        @include('layouts.headertop')
        {{-- @include('portal.layout.rightbar') --}}

        @include('layouts.sidebar')

        <div class="page">
            @include('layouts.page_header')

            @yield('breadcrumb')

            @if (session()->has('flash'))
                <div class="container-fluid">
                    <div class="alert alert-success"> {{ session('flash') }}</div>
                </div>
            @elseif(session()->has('err'))
                <div class="container-fluid">
                    <div class="alert alert-danger" role="alert"> {{ session('err') }}</div>
                </div>

            @elseif(session()->has('wrn'))
                <div class="container-fluid">
                    <div class="alert alert-warning" role="alert"> {{ session('err') }}</div>
                </div>

            @endif

            @yield('content')

            @include('layouts.footer')
        </div>
    </div>


    @yield('popup')



    <!-- Scripts -->
    @stack('before-scripts')


    

    <script src="{{ asset('/admin/assets/bundles/lib.vendor.bundle.js') }}"></script>



    
    @stack('after-scripts')
    <script src="/admin/assets/js/core.js"></script>


    @if (trim($__env->yieldContent('page-script')))
        @yield('page-script')
    @endif

</body>

</html>
