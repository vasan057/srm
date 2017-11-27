<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kandel Consultancy') }}</title>
     <!-- Bootstrap -->
    <link href="{{asset('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('public/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('public/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
        <!-- Animate.css -->
    <link href="{{asset('public/vendors/animate.css/animate.min.css')}}" rel="stylesheet">
        <!-- Custom Theme Style -->
    <link href="{{asset('public/css/custom.css?d='.time())}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/vendors/pnotify/dist/pnotify.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendors/pnotify/dist/pnotify.custom.min.css')}}">
    @stack('style')
    <!-- Styles -->
</head>
<body  class="nav-md">
    <div id="app">
    @php 
    $photo = Auth::user()->photo;
    if($photo){
        $avatar = Storage::url('app/'.$photo->full_path);
    }else{
        $avatar = asset('public/images/logos/img.jpg');
    }

    @endphp
    @include('layouts.nav')
    @include('layouts.sidebar')
        @yield('content')
    </div><!-- this closed for nav blade -->
</div>
    <!-- Scripts -->
     <script src="{{asset('public/vendors/jquery/dist/jquery.js')}}" ></script>
    <script src="{{asset('public/vendors/bootstrap/dist/js/bootstrap.min.js')}}" ></script>
    <!-- Custom Theme Scripts -->
    <script src="{{asset('public/js/custom.js')}}"></script>
    <script src="{{asset('public/vendors/pnotify/dist/pnotify.js')}}"></script>
    <script>
        var csrf_token = {"X-CSRF-TOKEN":$("meta[name=csrf-token]").attr('content')};
    </script>
    @stack('script')
</body>
</html>
