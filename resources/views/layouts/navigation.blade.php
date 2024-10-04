@php
    $currentUrl = request()->path();
@endphp

<style>
    .navbar-nav-wrapper {
        display: flex;
        white-space: nowrap;
        padding: 0 1rem;
    }

    .navbar-nav {
        display: flex;
        flex-direction: row;
        width: 100%;
        justify-content: space-around;
    }

    .navbar-nav .nav-item {
        display: flex;
        align-items: center;
        position: relative;
        padding: 0 1rem;
    }

    .navbar-nav .nav-item:not(:last-child)::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 1px;
        height: 24px;
        background-color: #ccc;
    }

    @media (max-width: 767.98px) {
        .navbar {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar-brand {
            order: -1;
            text-align: center;
            width: 100%;
            padding: 1rem 0 0;
            margin: auto;
        }

        .navbar-brand img {
            margin: auto;
            /*margin-bottom: 0.5rem; !* Adjust margin to reduce gap *!*/
        }

        .navbar-text {
            text-align: center;
            margin: 0;
        }

        .navbar-nav-wrapper {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            padding: 0;
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        .navbar-nav-wrapper::-webkit-scrollbar {
            display: none;  /* WebKit */
        }

        .navbar-nav {
            justify-content: flex-start;
            flex-wrap: nowrap;
            margin-top: 0;
        }

        .navbar-nav .nav-item {
            padding: 0 1rem;
            margin: 0;
        }

        .navbar-nav .nav-item:not(:last-child)::after {
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 16px;  /* Reduced height for mobile */
            background-color: #ccc;
        }
    }
</style>
<nav class="navbar navbar-expand-lg sticky-top navbar-light mb-0 pb-0">
    <div class="container">
        <!-- First Row: Logo Centered -->
        <div class="row m-auto">
            <div class="col text-center ">
                <a class="navbar-brand" href="/">
                    <img src="{{asset('assets/images/enuani-logo-2.jpg')}}" alt="" width="100" />
{{--                    <img src="{{asset('assets/images/enuani.jpg')}}" alt="" width="100" />--}}
                    <span class="d-block" style="font-size: 10px">Preserving the Igbo Heritage</span>

{{--                    <div class="navbar-text d-md-none" style="font-size: 10px">Preserving the Igbo Heritage</div>--}}
                </a>
            </div>

{{--            <span class="d-block">Helo</span>--}}
        </div>
        <!-- Second Row: Menu Items Centered -->
        <div class="row w-100">
            <div class="col">

                <div class="navbar-nav-wrapper">

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="{{ Request::routeIs('home') ? 'active' : '' }} nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="{{ Request::routeIs('about') ? 'active' : '' }} nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="{{ Request::routeIs('showByCategory') ? 'active' : '' }} nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Category
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ $currentUrl === 'category/food' ? 'active' : '' }}" href="/category/food">Food</a></li>
                                <li><a class="dropdown-item {{ $currentUrl === 'category/music' ? 'active' : '' }}" href="/category/music">Music</a></li>
                                <li><a class="dropdown-item {{ $currentUrl === 'category/festival' ? 'active' : '' }}" href="/category/festival">Festival</a></li>
                                <li><a class="dropdown-item {{ $currentUrl === 'category/dance' ? 'active' : '' }}" href="/category/dance">Dance</a></li>
                                <li><a class="dropdown-item {{ $currentUrl === 'category/articles' ? 'active' : '' }}" href="/category/articles">Articles</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="{{ Request::routeIs('gallery') ? 'active' : '' }} nav-link" href="{{route('gallery')}}">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="{{ Request::routeIs('news') ? 'active' : '' }} nav-link" href="{{route('news')}}">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#membership">Membership</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-secondary px-4 mx-4" href="{{ route('contact')}}">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>


{{--<nav class="navbar navbar-expand-lg sticky-top navbar-light">--}}
{{--    <div class="container">--}}
{{--        <!-- First Row: Logo Centered -->--}}
{{--        <div class="row w-100">--}}
{{--            <div class="col text-center">--}}
{{--                <a class="navbar-brand" href="/">--}}
{{--                    <img src="{{asset('assets/images/enuani.jpg')}}" alt="" width="100" />--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Second Row: Menu Items Centered -->--}}
{{--        <div class="row w-100">--}}
{{--            <div class="col">--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                    Menu--}}
{{--                    <i class="fas fa-bars ms-1"></i>--}}
{{--                </button>--}}
{{--                <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">--}}
{{--                    <ul class="navbar-nav">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="{{ Request::routeIs('home') ? 'active' : '' }} nav-link" aria-current="page" href="{{ route('home') }}">Home</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="{{ Request::routeIs('about') ? 'active' : '' }} nav-link" href="{{ route('about') }}">About</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a class="{{ Request::routeIs('showByCategory') ? 'active' : '' }} nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                Category--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                <li><a class="dropdown-item {{ $currentUrl === 'category/food' ? 'active' : '' }}" href="/category/food">Food</a></li>--}}
{{--                                <li><a class="dropdown-item {{ $currentUrl === 'category/music' ? 'active' : '' }}" href="/category/music">Music</a></li>--}}
{{--                                <li><a class="dropdown-item {{ $currentUrl === 'category/festival' ? 'active' : '' }}" href="/category/festival">Festival</a></li>--}}
{{--                                <li><a class="dropdown-item {{ $currentUrl === 'category/dance' ? 'active' : '' }}" href="/category/dance">Dance</a></li>--}}
{{--                                <li><a class="dropdown-item {{ $currentUrl === 'category/articles' ? 'active' : '' }}" href="/category/articles">Articles</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="{{ Request::routeIs('gallery') ? 'active' : '' }} nav-link" href="{{route('gallery')}}">Gallery</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="{{ Request::routeIs('news') ? 'active' : '' }} nav-link" href="{{route('news')}}">News</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="#membership">Membership</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="btn btn-outline-secondary px-4 mx-4" href="{{ route('contact')}}">Contact Us</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}

