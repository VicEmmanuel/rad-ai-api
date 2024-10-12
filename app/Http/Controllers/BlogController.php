<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    use HttpResponses;


//    public function store(Request $request)
//
//    {
//
//        $validator = Validator::make($request->all(), [
//            'title' => 'required',
//            'description' => 'required',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Adjust rules as needed
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'status' => 'error',
//                'message' => $validator->errors()->first()
//            ], 422);
//        }
//
//        $imageFile = $request->file('image');
//
//
//        $newImageName = uniqid() . '.' . $imageFile->extension();
////        $newImageName = uniqid() .'-' .$request->title . '.' . $request->image->extension();
//
////        $request->image->move(public_path('blogs'), $newImageName);
//        $imageFile->move(public_path('blogs'), $newImageName);
//
//        $description = $request->input('description');
//        $user  = Auth::user();
//
//        $post =   Blog::create([
//            'title' => $request->input('title'),
//            'description' => $description,
//            'image' => $newImageName,
//            'user_id' => $user->id
//        ]);
//
//        // Add the full URL for the image path
//        $post->image = url('blogs/' . $newImageName);
//
//        return $this->success([
//            'post' => $post,
//
//        ], 'Post Created Successfully',);
//
//    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Adjust rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $imageFile = $request->file('image');

        try {
            // Upload the image to Cloudinary
            $cloudinaryUpload =  cloudinary()->upload($imageFile->getRealPath(), [
                'folder' => 'blogs'
            ]);

            // Get the Cloudinary URL
            $cloudinaryUrl = $cloudinaryUpload->getSecurePath();

            // Get the description and authenticated user
            $description = $request->input('description');
            $user = Auth::user();

            // Create a new blog post with the Cloudinary image URL
            $post = Blog::create([
                'title' => $request->input('title'),
                'description' => $description,
                'image' => $cloudinaryUrl, // Save Cloudinary URL
                'user_id' => $user->id
            ]);

            return $this->success([
                'post' => $post,
            ], 'Post Created Successfully');

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Image upload failed: ' . $e->getMessage()
            ], 500);
        }
    }
//    public function fetchAllBlogs(Request $request)
//    {
//
//        $page = $request->input('page', 1);
//        $pageSize = $request->input('pageSize', 10);
//
//        // Define the base URL for your public images
//        $imageBaseUrl = asset('blogs'); // Adjust based on your public image path
//
//        // Paginate the transactions
//        $blog = Blog::orderBy('created_at', 'DESC')
//            ->paginate($pageSize, ['*'], 'page', $page);
//
//        // Transform the history items to include the full image URL
//        $blogItems = $blog->map(function ($item) use ($imageBaseUrl) {
//            $item->image = $imageBaseUrl . '/' . $item->image; // Construct the full image URL
//            return $item;
//        });
//
//        // Check if there are more records
//        $hasNextRecord = $blog->currentPage() < $blog->lastPage();
//
//        return $this->success([
//            'hasNextRecord' => $hasNextRecord,
//            'totalCount' => $blog->total(),
//            'blog' => $blogItems,
//        ], 'Blog retrieved successfully', 200);
//    }

    public function fetchAllBlogs(Request $request)
    {
        $page = $request->input('page', 1);
        $pageSize = $request->input('pageSize', 10);

        // Paginate the blog posts
        $blog = Blog::orderBy('created_at', 'DESC')
            ->paginate($pageSize, ['*'], 'page', $page);

        // No need to modify the image URL since it's stored as a Cloudinary URL
        $blogItems = $blog->map(function ($item) {
            return $item; // The image field already contains the Cloudinary URL
        });

        // Check if there are more records
        $hasNextRecord = $blog->currentPage() < $blog->lastPage();

        return $this->success([
            'hasNextRecord' => $hasNextRecord,
            'totalCount' => $blog->total(),
            'blog' => $blogItems,
        ], 'Blog retrieved successfully', 200);
    }

    public function index()
    {
        return view('blog.create',);
    }


}
