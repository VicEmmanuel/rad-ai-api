<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RadAi') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/jpg" sizes="32x32" href="{{asset('assets/images/enuani.jpg')}}">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/css/lightbox.min.css')}}" />

        {{-- google font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

        {{-- font awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Swiper.js styles -->
{{--        <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css"/>--}}
        <!-- Custom styles -->
{{--        <link rel="stylesheet" href="./assets/css/main.css">--}}

        <!-- Scripts -->
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}

        <link rel="stylesheet" href="{{asset('assets/css/font-awesome.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}" />
        <!-- Vendor CSS Files -->
        <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        {{-- bootstrap & css & aos --}}
        <!-- Animate.css -->
{{--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">--}}
        <link rel="stylesheet" href="{{ asset('assets/css/aos/aos.css') }}">
        <link rel="stylesheet" href="{{asset('assets/css/footer.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/lightbox2/dist/css/lightbox.css') }}">
{{--        <link rel="icon" href="images/enuani.jpg" />--}}
{{--        <link rel="stylesheet" href="css/swiper-bundle.min.css" />--}}
        <title>Enuani Cultural Forum</title>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
{{--            @include('layouts.navigation')--}}

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div>
                    @yield('content')
                </div>

            </main>

            <div>
{{--                @include('layouts.footer')--}}
            </div>
        </div>

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

        {{--Fetch news api--}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function fetchNews() {
                    fetch('/fetch-news')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.status === 'success' && data.news) {
                                console.log(data.message);
                                updateNewsList(data.news);
                                setTimeout(fetchNews, 600000); // Set timeout to call fetchNews again after 10 minutes (600000 milliseconds)
                            } else {
                                throw new Error('Invalid data format');
                            }
                        })
                        .catch(error => console.error('Error fetching news:', error));
                }

                function updateNewsList(news) {
                    const newsList = document.getElementById('news-list');
                    newsList.innerHTML = ''; // Clear the current list

                    news.forEach(item => {
                        const listItem = document.createElement('li');

                        const link = document.createElement('a');
                        link.href = item.link;
                        link.textContent = item.title;
                        listItem.appendChild(link);

                        const description = document.createElement('p');
                        description.textContent = item.description;
                        listItem.appendChild(description);

                        if (item.image_url) {
                            const image = document.createElement('img');
                            image.src = item.image_url;
                            image.alt = item.title;
                            listItem.appendChild(image);
                        }

                        newsList.appendChild(listItem);
                    });
                }

                // Initial fetch call
                fetchNews();
            });
        </script>
    </body>
</html>
