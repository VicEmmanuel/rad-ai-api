@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
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
            <h1 class="text-center mb-3">UPDATE BLOG</h1>
            <form action="{{ route('blog.update', $post->slug) }}" class="form-control" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Give your post a title" @error('title') is-invalid @enderror value="{{ $post->title }}">
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_type" class="form-label">Category</label>
                    <select name="category_type" id="category_type" class="form-select">
                        <option value="{{ $post->category_type }}">{{ $post->category_type }}</option>
                        <option value="Festival">Festival</option>
                        <option value="Music">Music</option>
                        <option value="Dance">Dance</option>
                        <option value="Food">Food</option>
                        <option value="Articles">Articles</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image">Image</label>
                    @if ($post->file_path)
                        <div class="mb-3">
                            <img id="current-image" src="{{ url('images/' . $post->file_path) }}" alt="Current Image" style="max-width: 200px; max-height: 200px;">
                        </div>
                    @endif
                    <input type="file" class="form-control" id="image" name="image" @error('image') is-invalid @enderror onchange="previewImage(event)">
                    @error('image')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Details</label>
                    <textarea name="description" id="summernote">{{ $post->description }}</textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <button class="btn btn-outline-primary w-100"><i class="bi bi-check-square-fill"></i> Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('current-image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
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
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endsection
