@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('assets/css/footer.css')}}" />

    <div class="container-fluid">
        <div class="row">
            {{-- @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message')}}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1">
                <div class="p-3 mt-5 shadow">

                    <h1 class="text-center">REGISTER</h1>
                    <form action="{{ route('register')}}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Enter Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" value="{{ old('name')}}">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Enter Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email')}}">
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Enter Password</label>
                            <div class="password-field">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password')}}">
                                <span>
                                <i id="show_password" class="bi bi-eye-fill fs-5"></i>
                            </span>
                            </div>
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <div class="confirm-password-field">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="confirm_password" value="{{ old('password')}}">
                                <span>
                                <i id="toggler_password" class="bi bi-eye-fill fs-5"></i>
                            </span>
                            </div>
                            @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-outline-primary btn-lg w-100">Register</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
