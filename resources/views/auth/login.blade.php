@extends('layouts.app')

@section('content')
    <meta charset="UTF-8">
    <!-- Load SweetAlert2 before your JavaScript code -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1">
                <div class="p-3 mt-5 shadow">
                    <h1 class="text-center">LOGIN</h1>
                    <form action="{{ route('login') }}" method="post" id="loginForm">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Enter Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Enter Password</label>
                            <div class="password-field">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}">
                                <span>
                                    <i id="show_password" class="bi bi-eye-fill fs-5"></i>
                                </span>
                            </div>
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-outline-primary btn-lg w-100">Login</button>

                        <p>or</p>
                        <a href="{{ route('register') }}" class="btn btn-primary text-light">Sign up</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            let form = this;
            let formData = new FormData(form);

            fetch('{{ route('login') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    // No need to set 'Accept: application/json', let the server handle it
                },
                body: formData
            }).then(response => response.json())
                .then(data => {
                    if (data['status'] === 'true') {
                        // SweetAlert for success
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            text: 'You have logged in successfully!',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = "{{ url('/') }}"; // Redirect after success
                        });
                    } else {
                        // SweetAlert for error
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: data.message || 'Invalid login details',
                        });
                    }
                })
                .catch(error => {
                    // SweetAlert for error in case of fetch failure
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong! again.',
                    });
                });
        });
    </script>
@endsection
