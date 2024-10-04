<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Admin-EnuaniCulturalForum</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- favicons --}}
    <link rel="shortcut icon" href=""{{asset('assets/images/enuani.jpg')}}" type="image/x-icon">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/footer.css')}}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- bootstrap icon cdn --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    {{--  NEW IMPORTS  --}}
    <link rel="stylesheet" href="{{asset('assets/css/lightbox.min.css')}}" />
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-family: 'poppins', sans-serif;
        }

        body{
            overflow-x: hidden;
        }
        .custom-navbar {
            background-color: #6665B5
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .sidebar-sticky{
            position: sticky;
            top: 110px;
        }
        #sidebarMenu{
            position: sticky;
            top: 110px;
            z-index: 5;
        }
        .active{
            color: red;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>

    @include('layouts.navigation')

    <!-- Page Content -->
    <main>
        <div>
            @yield('content')
        </div>

    </main>




<!-- footer -->

<div>
    @include('layouts.footer')
</div>
<script src="{{ asset('js/script.js') }}"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script> --}}
<script src="{{ asset('js/bootstrap.min.js') }}"></script>


{{-- aos js --}}
<script src="{{ asset('assets/css/aos/aos.js') }}"></script>
<script>
    AOS.init();
</script>
{{-- end of my javascript --}}
<script src="{{ asset('/assets/js/hero.js') }}"></script>
<script src="{{ asset('/assets/js/slide.js') }}"></script>
<script src="{{ asset('/assets/lightbox2/dist/js/lightbox-plus-jquery.js') }}"></script>
<script src="{{ asset('/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/typed.js/typed.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
<script src="{{asset('/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/assets/js/script.js')}}"></script>
<script src="{{asset('/assets/js/swiper-bundle.min.js')}}"></script>


<script src="{{asset('vendor/glightbox/js/glightbox.min.js')}}"></script>


<script src="{{ asset('/js/script.js') }}"></script>
<script src="{{ asset('lightbox2/dist/js/lightbox-plus-jquery.js') }}"></script>


<script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('vendor/typed.js/typed.min.js') }}"></script>
<script src="{{ asset('vendor/waypoints/noframework.waypoints.js') }}"></script>
<script src="{{asset('assets/js/lightbox-plus-jquery.min.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('/js/main.js') }}"></script>
</body>

</html>
