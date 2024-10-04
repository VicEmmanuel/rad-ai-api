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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <div class="col-md-10 mx-auto py-5">
        <div class="shadow p-3">
            <h1 class="text-center mb-3">CREATE NEW BLOG</h1>
            <form id="blogForm" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Give your post a title">
                </div>

                <div class="mb-3">
                    <label for="category_type" class="form-label">Category</label>
                    <select name="category_type" id="category_type" class="form-select">
                        <option>Select Category</option>
                        <option value="Festival">Festival</option>
                        <option value="Music">Music</option>
                        <option value="Dance">Dance</option>
                        <option value="Food">Food</option>
                        <option value="Articles">Articles</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author Name</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Author's name">
                </div>

                <div class="mb-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="formFileLg" name="image">
                </div>

                <div class="mb-3">
                    <label for="details" class="form-label">Details</label>
                    <textarea name="description" id="summernote"></textarea>
                </div>

                <div class=" mb-3">
                    <button type="button" class="btn btn-outline-primary w-100" id="submitBlog">Create</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Initialize Summernote editor -->
    <script>
        $('#summernote').summernote({
            placeholder: 'Write your blog details...',
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

    <!-- AJAX Form Submission -->
    <script>
        $('#submitBlog').on('click', function() {
            let formData = new FormData($('#blogForm')[0]);
            formData.append('description', $('#summernote').val());

            $.ajax({
                url: "{{ url('/api/blog') }}",  // The API endpoint
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // If needed for auth
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '/admin/dashboard'; // Redirect after success
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: xhr.responseJSON.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
@endsection
