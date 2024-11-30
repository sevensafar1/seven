<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class GalleryController extends Controller
{
    //
    public function create(){
        return view('admin.gallery.create');
    }

    public function gallerySave(Request $request)
    {
        $rules = [
            'title'    => 'required|string|max:255',
            'slug'     => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'alt'      => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Update validation for multiple images
        ];
    
        // Custom error messages
        $customMessages = [
            'title.required'    => 'Title is required',
            'slug.required'     => 'Slug is required',
            'location.required' => 'Location is required',
            'alt.required'      => 'Alt is required',
        ];
    
        // Validate the request
        $validation = Validator::make($request->all(), $rules, $customMessages);
    
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ], 422);
        }
    
        // Begin transaction
        DB::beginTransaction();
    
        try {
            $filenames = []; // Initialize an array to store filenames
            if ($request->hasFile('images')) {
                $directory = public_path('images/gallery');

                // Create directory if it doesn't exist
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Loop through uploaded files
                foreach ($request->file('images') as $image) {
                    // Generate a unique filename and move the image
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move($directory, $filename); // Move file to directory
                    $filenames[] = $filename; // Add new filename to the array
                }
            }
    
            // Create array for inserting data
            // $insert_arr = [
            //     'title'       => $request->title,
            //     'location'    => $request->location,
            //     'image'       => json_encode($filenames), // Store filenames as JSON
            //     'alt'         => $request->alt,
            //     'slug'        => $request->slug,
            //     'created_at'  => now(),
            // ];
    
            // Insert into the database
            $gallery =new Gallery();
            $gallery->title=$request->title;
            $gallery->location=$request->location;
            $gallery->image=json_encode($filenames);
            $gallery->alt=$request->alt;
            $gallery->slug=$request->slug;
            $gallery->created_at=now();
            $gallery->save();
            // Gallery::insert($insert_arr);
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => "Gallery Added Successfully"
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
    public function index(){
        $gallery=Gallery::get();

        return view('admin.gallery.index',compact('gallery'));
    }

    public function edit($slug)
    {
        $gall=Gallery::where(['slug'=>$slug])->first();
        return view('admin.gallery.edit',compact('gall'));
    }
    public function galleryUpdate(Request $request)
    {
        $rules = [
            'title'    => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'alt'      => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Update validation for multiple images
        ];

        // Custom error messages
        $customMessages = [
            'title.required'    => 'Title is required',
            'location.required' => 'Location is required',
            'alt.required'      => 'Alt is required',
        ];

        // Validate the request
        $validation = Validator::make($request->all(), $rules, $customMessages);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ], 422);
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Find the existing gallery item
            $gallr = Gallery::findOrFail($request->update_id);
            $filenames = json_decode($gallr->image, true); // Decode existing images

            // Handle the image upload
            if ($request->hasFile('images')) {
                $directory = public_path('images/gallery');

                // Create directory if it doesn't exist
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Loop through uploaded files
                foreach ($request->file('images') as $image) {
                    // Generate a unique filename and move the image
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move($directory, $filename); // Move file to directory
                    $filenames[] = $filename; // Add new filename to the array
                }
            }

            // Update gallery details
            $gallr->title = $request->title;
            $gallr->location = $request->location;
            $gallr->image = json_encode($filenames); // Store filenames as JSON
            $gallr->alt = $request->alt;
            $gallr->updated_at = now(); // Use updated_at instead of created_at
            $gallr->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Gallery Updated Successfully"
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
    public function deleteGall(Request $request){
        Gallery::where(['id'=>$request->id])->delete();
        // HotelImage::where(['hotel_id'=>$request->id])->delete();
        return response()->json(['message' => 'Gallery deleted successfully']);
    }

    public function bannerIndex(){
        $banner=DB::table('banners')->get();
        return view('admin.banner.index',compact('banner'));
    }

    public function bannerCreate()
    {
        return view('admin.banner.create');
    }

    public function bannerSave(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'slug'  => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for single image
        ];
    
        // Custom error messages
        $customMessages = [
            'title.required' => 'Title is required',
            'slug.required'  => 'Slug is required',
            'description.required' => 'Title is required',
        ];
    
        // Validate the request
        $validation = Validator::make($request->all(), $rules, $customMessages);
    
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validation->errors(),
            ], 422);
        }
    
        // Begin transaction
        DB::beginTransaction();
    
        try {
            $filename = null; // Initialize filename for single image
            if ($request->hasFile('image')) { // Check for single image
                $directory = public_path('images/banner');
    
                // Create directory if it doesn't exist
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
    
                // Process the uploaded file
                $image = $request->file('image');
                // Generate a unique filename and move the image
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($directory, $filename); // Move file to directory
            }
    
            // Create a new banner entry using DB::table
            DB::table('banners')->insert([
                'title'      => $request->title,
                'image'      => $filename,
                'slug'       => $request->slug,
                'description'=> $request->description,
                'created_at' => now(),
            ]);
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => "Banner Added Successfully", // Changed message for clarity
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // Something went wrong, return the error
            return response()->json([
                'success' => false,
                'message' => "Something went wrong: " . $e->getMessage(),
            ], 500);
        }
    }

    public function bannerEdit($id){
        $banner=DB::table('banners')->where(['slug'=>$id])->first();
        return view('admin.banner.edit',compact('banner'));
    }

    public function bannerUpdate(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for single image
        ];
    
        // Custom error messages
        $customMessages = [
            'title.required' => 'Title is required',
            'slug.required'  => 'Slug is required',
            'description.required' => 'Description is required',
        ];
    
        // Validate the request
        $validation = Validator::make($request->all(), $rules, $customMessages);
    
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validation->errors(),
            ], 422);
        }
    
        // Begin transaction
        DB::beginTransaction();
    
        try {
            // Find the banner by ID (assuming you're passing 'update_id' in the request)
            $banner = DB::table('banners')->where('id', $request->update_id)->first();
    
            if (!$banner) {
                return response()->json([
                    'success' => false,
                    'message' => 'Banner not found',
                ], 404);
            }
    
            $filename = $banner->image; // Keep the old image by default
            if ($request->hasFile('image')) { // Check for a new image upload
                $directory = public_path('images/banner');
    
                // Create directory if it doesn't exist
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
    
                // Process the uploaded file
                $image = $request->file('image');
                // Generate a unique filename and move the image
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($directory, $filename); // Move the file to the directory
    
                // Optionally delete the old image
                if ($banner->image && file_exists($directory . '/' . $banner->image)) {
                    unlink($directory . '/' . $banner->image);
                }
            }
    
            // Update the banner record using DB::table
            DB::table('banners')->where('id', $request->update_id)->update([
                'title'      => $request->title,
                'image'      => $filename,
                'description'=> $request->description,
                'updated_at' => now(),
            ]);
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => "Banner Updated Successfully",
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // Something went wrong, return the error
            return response()->json([
                'success' => false,
                'message' => "Something went wrong: " . $e->getMessage(),
            ], 500);
        }
    }

    public function deletebanner(Request $request){
        DB::table('banners')->where(['id'=>$request->id])->delete();
        // HotelImage::where(['hotel_id'=>$request->id])->delete();
        return response()->json(['message' => 'Banner deleted successfully']);

    }
    public function cityList()
    {

        // $states=DB::table('states')->get();
        $lists=DB::table('cities')->orderBy('id', 'desc')->get();
        return view('admin.city.city_list',compact('lists'));
    }

    public function citySave(Request $request)
    {
        $rules = [
            'state'       => 'required|string|max:255',
            'city'       => 'required|string|max:255',
        ];
    
        // Custom error messages
        
    
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
               
        
                // Create array for inserting data
                $insert_arr = [
                    'city' => $request->city,
                    'state_id'         => $request->state,
                ];
        
                // Insert into the database
                $insert=DB::table('cities')->insert($insert_arr);
                // $insert = PackageType::insert($insert_arr); // Assuming 'package_types' is the correct table
        
                DB::commit();
        
                return response()->json([
                    'success' => true,
                    'message' => "City Added Successfully"
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

    public function deleteCity(Request $request){
        DB::table('cities')->where(['id'=>$request->id])->delete();
        // HotelImage::where(['hotel_id'=>$request->id])->delete();
        return response()->json(['message' => 'City deleted successfully']);

    }

    public function cityCreate(){
        $states=DB::table('states')->get();
        return view('admin.city.add_city',compact('states'));
    }
   
    
     
}
