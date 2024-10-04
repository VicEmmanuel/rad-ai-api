<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    use HttpResponses;


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


        $newImageName = uniqid() . $request->image->extension();
//        $newImageName = uniqid() .'-' .$request->title . '.' . $request->image->extension();

        $request->image->move(public_path('blog-image'), $newImageName);

        $description = $request->input('description');
        $user  = Auth::user();

        $post =   Blog::create([
            'title' => $request->input('title'),
            'description' => $description,
            'image' => $newImageName,
            'user_id' => $user->id
        ]);

        // Add the full URL for the image path
        $post->image = url('blog-image/' . $newImageName);

        return $this->success([
            'post' => $post,

        ], 'Post Created Successfully',);

    }


    public function fetchAllBlogs(Request $request)
    {

        $page = $request->input('page', 1);
        $pageSize = $request->input('pageSize', 10);

        // Define the base URL for your public images
        $imageBaseUrl = asset('blogs'); // Adjust based on your public image path

        // Paginate the transactions
        $blog = Blog::orderBy('created_at', 'DESC')
            ->paginate($pageSize, ['*'], 'page', $page);

        // Transform the history items to include the full image URL
        $blogItems = $blog->map(function ($item) use ($imageBaseUrl) {
            $item->image = $imageBaseUrl . '/' . $item->image; // Construct the full image URL
            return $item;
        });

        // Check if there are more records
        $hasNextRecord = $blog->currentPage() < $blog->lastPage();

        return $this->success([
            'hasNextRecord' => $hasNextRecord,
            'totalCount' => $blog->total(),
            'blog' => $blogItems,
        ], 'Blog retrieved successfully', 200);
    }


}
