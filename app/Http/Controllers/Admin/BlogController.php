<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //
    public function index(){
        $blogs=Blog::get();
        return view('admin.blog.index',compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function uploadImage(Request $request)
    {
        // Validate the image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Max size 2MB
        ]);

        // Define the storage path
        $directory = 'blog_images';

        // Create the directory if it doesn't exist
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        // Store the image and get the path
        $path = $request->file('image')->store($directory, 'public');

        // Return the URL to the image
        return response()->json([
            'url' => Storage::url($path), // Generate the URL for the stored image
            'alt' => $request->input('alt') ?? 'Uploaded Image', // Optional alt text
        ]);
    }

    public function save(Request $request)
    {
        $rules = [
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:blogs,slug', // Ensure slug is unique
            'images'      => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
            'status'      => 'required|string|max:255',
            'description' => 'required|string', // Removed max length for description
        ];

        // Validate the request
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ], 422);
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Handle the image upload
            if ($request->hasFile('images')) {
                // Define the directory path (you can also use Storage for this)
                $directory = public_path('images/Blog'); 

                // Create directory if it doesn't exist
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Generate a unique filename and move the image
                $image = $request->file('images');
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($directory, $filename); // Move file to directory
            }

            // Create array for inserting data
            $insert_arr = [
                'title'       => $request->title,
                'slug'        => $request->slug,
                'status'      => $request->status,
                'image'       => $filename, // Save the filename
                'description' => $request->description,
                'created_at'  => now(),
            ];

            // Insert into the database
            $insert = Blog::create($insert_arr); // Use create for mass assignment

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Blog Added Successfully"
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // Something went wrong, return the error
            return response()->json([
                'success' => false,
                'message' => "Something went wrong: " . $e->getMessage()
            ], 500);
        }
    }

    public function edit($slug){
        $blog=Blog::where(['slug'=>$slug])->first();
        return view('admin.blog.edit',compact('blog'));
    }

    public function update(Request $request)
    {
        $rules = [
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:blogs,slug,' . $request->update_id, // Ensure slug is unique except for the current blog
            'status'      => 'required|string|max:255',
            'description' => 'required|string', // Removed max length for description
        ];
    
        // Validate the request
        $validation = Validator::make($request->all(), $rules);
    
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ], 422);
        }
    
        // Begin transaction
        DB::beginTransaction();
    
        try {
            // Find the existing blog entry
            $blog = Blog::findOrFail($request->update_id);
    
            // Initialize filename variable
            $filename = $blog->image; // Keep the existing image by default
    
            // Handle the image upload
            if ($request->hasFile('images')) {
                // Define the directory path (you can also use Storage for this)
                $directory = public_path('images/Blog'); 
    
                // Create directory if it doesn't exist
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
    
                // Generate a unique filename and move the image
                $image = $request->file('images');
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($directory, $filename); // Move file to directory
            }
    
            // Create array for updating data
            $update_arr = [
                'title'       => $request->title,
                'slug'        => $request->slug,
                'status'      => $request->status,
                'image'       => $filename, // Save the filename (new or existing)
                'description' => $request->description,
                'updated_at'  => now(), // Update the timestamp
            ];
    
            // Update the database
            $blog->update($update_arr);
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => "Blog updated successfully."
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // Something went wrong, return the error
            return response()->json([
                'success' => false,
                'message' => "Something went wrong: " . $e->getMessage()
            ], 500);
        }
    }
    public function deleteBlog(Request $request){
        Blog::where(['id'=>$request->id])->delete();
        // HotelImage::where(['hotel_id'=>$request->id])->delete();
        return response()->json(['message' => 'Blog deleted successfully']);
    }
}
