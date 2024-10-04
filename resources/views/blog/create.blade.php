


@extends('layouts.app')

@section('content')
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>



    @if($errors->any())
        <div class="w-4/5 m-auto">
            <ul>
                @foreach($errors->all() as $error)
                    <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: '{{ Session::get('success') }}',
                    icon: 'success',
                    showCancelButton: true, // Add this line to show the "View" button
                    confirmButtonText: 'OK',
                    // cancelButtonText: 'View attendees' // Set the text for the "View" button
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the home page
                        window.location.href = '/admin/dashboard'; // Replace with your home page route
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // Redirect to the "View" page
                        window.location.href = '/admin/dashboard'; // Replace with the view page route
                    }
                });
            });
        </script>


    @endif



    <div class="col-md-10 mx-auto py-5">
        <div class="shadow p-3">


            <h1 class="text-center mb-3">CREATE NEW BLOG</h1>
            <form action="{{ route('blog.store') }}" class="form-control" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Give your post a title"
                           @error('title') is-invalid @enderror value="{{ old('title') }}">

                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                <div class="mb-3">
                    <label for="category_type" class="form-label">Category</label>
                    <select name="category_type" id="category_type" class="form-select">
                        <option >Select Category</option>
{{--                        <option value="All">All</option>--}}
                        <option value="Festival">Festival</option>
                        <option value="Music">Music</option>
                        <option value="Dance">Dance</option>
{{--                        <option value="News">News</option>--}}
                        <option value="Food">Food</option>
                        <option value="Articles">Articles</option>
{{--                        <option value="Gallery">Gallery</option>--}}
{{--                        @foreach ($categories as $category)--}}
{{--                            <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                        @endforeach--}}
                    </select>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author Name</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Author's name"
                           @error('author') is-invalid @enderror value="{{ old('author') }}">

                    @error('author')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                <div class="mb-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="formFileLg" type="file"  name="image" id="image" @error('image') is-invalid @enderror>

                    @error('image')
                    <small class="text-danger">{{ $message}}</small>
                    @enderror

                </div>

                {{-- <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" name="slug" id="slug" placeholder="" @error('slug') is-invalid @enderror value="{{ old('slug')}}">

                @error('slug')
                <small class="text-danger">{{ $message}}</small>
                @enderror

            </div> --}}

                <div class="mb-3">
                    <label for="details" class="form-label">Details</label>

                    <textarea name="description" id="summernote" {{ old('details') }} ></textarea>
{{--                    <textarea class="form-control" id="details" rows="5" name="details" value="{{ old('details') }}"></textarea>--}}

                    @error('details')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>



                <div class=" mb-3">
                    <button class="btn btn-outline-primary w-100"><i class="bi bi-check-square-fill"></i> Create</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Initialize Quill editor -->
    <script>

        const quill = new Quill('#editor', {
            modules: {
                syntax: true,
                toolbar: '#toolbar-container',
            },
            placeholder: 'Compose an epic...',
            name:"description",
            theme: 'snow',
        });
    </script>

    <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                // ['insert', ['link', 'picture', 'video']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>


@endsection
