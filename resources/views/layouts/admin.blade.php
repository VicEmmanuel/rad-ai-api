<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Admin-EnuaniCulturalForum</title>

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



<header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow custom-navbar p-3">
    <a class="navbar-brand ms-4 d-flex align-items-center" href="{{ route('dashboard') }}">
        <img src="{{ asset('assets/images/enuani.jpg') }}" alt="" class="img-fluid" height="" width="70">
    </a>

    <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    {{-- <h5 class="text-center">
        Welcome
        {{ $user->name}}
    </h5>
    <p class="d-flex justify-content-center d-none d-md-flex"><small>
        {{ $user->email}}
    </small></p> --}}


</header>


{{-- sub-header --}}
<div style="background-image: url('{{ asset('image/subheader.png') }}'); height: 150px;">
    <div class="sub-header-overlay d-flex align-items-center" style="height: 150px">
        <div class=" ms-4">
            <p class="sub-header-heading">Admin</p>
            <p class="sub-header-text"><a href="{{ route('home') }}" class="sub-header-link">Home</a> &rarr; Admin
            </p>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 d-md-block text-bg-light sidebar collapse">
            <div class="pt-3 sidebar-sticky">
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"> &nbsp;
                    <img src="{{ asset('assets/images/enuani.jpg')}}" alt="" width="100px" >&nbsp;&nbsp;
                    <span class="fs-6">Enauni Cultural Forum</span>
                </a>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item">

{{--                        <a class="{{ Request::routeIs('dashboard') ? 'active' : ''}} nav-link" href="{{ route('dashboard')}}">--}}
{{--                            Dashboard--}}
                        </a><a class="{{ Request::routeIs('dashboard') ? 'active' : '' }} nav-link" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('create.blog')}}">
                            Create New Article
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="{{ Request::routeIs('gallery.create') ? 'active' : '' }} nav-link" href="{{ route('gallery.create') }}">
                           Upload Gallery
                        </a>
                    </li>

                    <li class="mb-3">
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button class="btn btn-primary" type="submit" style="text-decoration: none">Logout</button>
                        </form>
                    </li>

                </ul>
            </div>
        </nav>

        {{-- back to top --}}
{{--        <button type="button" class="btn btn-danger btn-floating btn-lg" id="back-to-top">--}}
{{--            <i class="fas fa-arrow-up"></i>--}}
{{--        </button>--}}

        <main class="col-md-9 ms-sm-auto px-md-0">
            @yield('posts')
        </main>
    </div>
</div>

<!-- footer -->

<div>
    @include('layouts.footer')
</div>
<script src="{{ asset('js/script.js') }}"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script> --}}
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
