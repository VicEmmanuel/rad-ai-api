<link rel="stylesheet" href="{{asset('assets/css/footer.css')}}" />
<script src="https://kit.fontawesome.com/dbbbb8902c.js" crossorigin="anonymous"></script>

<footer class="custom-footer-styling mt-5">
    <div class="container-fluid row p-md-5  px-4">

        <div class="col-lg-4 col-md-8 my-3 custom-footer-item0">
            <a href=""
               class="d-flex align-items-center mb-2 mb-lg-3 link-body-emphasis text-decoration-none">
                <img src="{{ asset('assets/images/enuani.jpg') }}" width="100px" alt="" class="img-fluid rounded-2 " >
            </a>
            <p class="text-light text-justify">
                Welcome to Enuani Cultural Forum! Our mission is to promote the rich cultural heritage of the Igbo tribe and the black race worldwide. We are committed to preserving the indigenous Igbo Language, with a particular focus on the Enuani dialect.
                Join us in celebrating the beauty and diversity of the Igbo culture..
            </p>
        </div>

        <div class="col-lg-2 col-md-4 my-5 mb-2 mb-lg-5 custom-footer-item1">
            <h5>Link</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="{{ route('home') }}"
                                             class="nav-link p-0 text-light hover-underline-animation">Home</a></li>

{{--                <li class="nav-item mb-2"><a href="{{ route('about') }}"--}}
{{--                                             class="nav-link p-0 text-light hover-underline-animation">About Us</a></li>--}}
                <li class="nav-item mb-2"><a href="{{ route('about') }}"
                                             class="nav-link p-0 text-light hover-underline-animation">About Us</a></li>
{{--                <li class="nav-item mb-2"><a href=""--}}
{{--                                             class="nav-link p-0 text-light hover-underline-animation">Management</a></li>--}}

                <li class="nav-item mb-2"><a href="{{route('gallery')}}"
                                             class="nav-link p-0 text-light hover-underline-animation">Gallery</a></li>
                <li class="nav-item mb-2"><a href="{{ route('contact')}}"
                                             class="nav-link p-0 text-light hover-underline-animation">Contact Us</a></li>
            </ul>
        </div>

        <div class="col-lg-4 col-md-8 my-5 mb-2 mb-lg-5 custom-footer-item2">
            <h5>Find Us</h5>
            <p><i class="fa-solid fa-location-dot"></i> Okpanam Road, Asaba </p>
            <p class="text-white">
                <i class="fa-sharp fa-solid fa-envelope"></i>
                <a href="mailto:info@enuaniculturalforum.com" class="text-white text-decoration-none">info@enuaniculturalforum.com</a>,
                <a href="mailto:admin@enuaniculturalforum.com" class="text-white text-decoration-none">admin@enuaniculturalforum.com</a>,
                <a href="mailto:contact@enuaniculturalforum.com" class="text-white text-decoration-none">contact@enuaniculturalforum.com</a>
            </p>


            <p><i class="fa-solid fa-phone text-light"></i> 0904 167 6758</p>
        </div>


        <div class="col-lg-2 col-md-4 my-3 mb-2 mb-lg-5 custom-footer-item3">
            <h5>Social Contact</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="https://web.facebook.com/Enuaniculturalforum" target="_blank" class="nav-link p-0 text-light"><i
                            class="fa-brands fa-facebook"></i> Facebook</a></li>
{{--                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light"><i--}}
{{--                            class="fa-brands fa-twitter"></i> Twitter</a></li>--}}
                <li class="nav-item mb-2"><a href="https://www.bing.com/ck/a?!&&p=6dec2ffd7b6ef954JmltdHM9MTcxNjQyMjQwMCZpZ3VpZD0yYTYwMzdlNi0yNWYxLTYwZTItMzYyOS0yM2FmMjQ5NjYxYzgmaW5zaWQ9NTI0NQ&ptn=3&ver=2&hsh=3&fclid=2a6037e6-25f1-60e2-3629-23af249661c8&psq=enuaniculturalforum&u=a1aHR0cHM6Ly93d3cuaW5zdGFncmFtLmNvbS9lbnVhbmljdWx0dXJhbGZvcnVtLw&ntb=1" target="_blank" class="nav-link p-0 text-light"><i
                            class="fa-brands fa-instagram"></i> Instagram</a></li>
                <li class="nav-item mb-2"><a href="https://www.youtube.com/@enuaniculturalforum" target="_blank" class="nav-link p-0 text-light"><i
                            class="fa-brands fa-youtube"></i> Youtube</a></li>

            </ul>
        </div>
    </div>

    <div class="container-fluid row ps-4">
        <div class="col d-flex justify-content-center custom-footer-item4">
            <p>Copyright © Enuani Cultural Forum 2024. All Right Reserved.</p>
        </div>
    </div>

</footer>
