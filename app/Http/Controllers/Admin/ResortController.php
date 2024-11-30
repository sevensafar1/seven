<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Resort;
use App\Models\ResortImage;

class ResortController extends Controller
{
    //
    public function index()
    {
        $resortdata=Resort::get();
        return view('admin.resort.index',compact('resortdata'));
    }

    public function create()
    {
        return view('admin.resort.create');
    }
    public function resortSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Accept images only
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'address' => 'required',
            'state' => 'required',
            'city'=> 'required',
            'phone' => 'required|regex:/^\+?[0-9]{1,3}?[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,9}$/',
            'mrp' => 'required|numeric',
            'price' => 'required|numeric',
            'meals_plan' => 'required',
            'amenities.*' => 'required',
            'description' => 'required|string',
            'location'=>'required',
            'rating' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422); // Return validation errors
        }

        DB::beginTransaction();

        try {
            $slug = Str::slug($request->name);

            // Check for uniqueness of the slug
            $originalSlug = $slug;
            $counter = 1;
            while (Resort::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter; // Append a number to the slug
                $counter++;
            }

            $imagePaths = []; // Initialize image paths array before the condition
            
            if ($request->hasFile('images')) { // Check if images are uploaded
                $directory = public_path('images/resorts'); // Define the directory path
                
                // Create the directory if it does not exist
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Loop through each uploaded image
                foreach ($request->file('images') as $image) {
                    // Generate a unique filename and move the image
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move($directory, $filename);

                    // Store the path relative to the public directory
                    $imagePaths[] = $filename; // Store the relative path
                }
            }
            if ($request->hasFile('banner_image')) {
                $directory1 = public_path('images/resorts'); // Define the directory path
                
                if (!file_exists($directory1)) {
                    mkdir($directory1, 0755, true); // Create directory if not exists
                }

                // Generate a unique filename and move the image
                $image1 = $request->file('banner_image');
                $filename1 = time() . '_' . uniqid() . '.' . $image1->getClientOriginalExtension();
                $image1->move($directory1, $filename1); // Move file to directory
            }

            // Encode amenities data as JSON
            $amenities = json_encode($request->amenities);

            // Create array for inserting data
            // $insert_arr = [
            //     'name' => $request->name,
            //     'slug' => $slug,
            //     'about' => $request->description,
            //     'address' => $request->address,
            //     'phone' => $request->phone,
            //     'mrp' => $request->mrp,
            //     'price' => $request->price,
            //     'facilty' => $amenities,
            //     'city' => $request->city,
            //     'state' => $request->state,
            //     'duration'=>$request->duration,
            //     'suggested_hotel' => $request->suggested,
            //     'rating' => $request->rating,
            //     'created_at' => now(),
            // ];
            $resort = new Resort();
                $resort->name = $request->name;    
                $resort->slug = $slug;
                $resort->about = $request->description;
                $resort->address = $request->address;
                $resort->phone = $request->phone;
                $resort->mrp = $request->mrp;
                $resort->price = $request->price;
                $resort->duration = $request->duration;
                $resort->facilty = $amenities;
                $resort->city = $request->city;
                $resort->state = $request->state;
                $resort->meals_plan = $request->meals_plan;
                $resort->distance = $request->distance;
                $resort->suggested =$request->suggested; 
                $resort->banner_image = $filename1;    
                $resort->rating = $request->rating;  
                $resort->created_at =  now();    
                $resort->save();

            // Insert into the database
            // $resort = Resort::create($insert_arr);

            // Save image paths to a separate table if images were uploaded
            foreach ($imagePaths as $path) {
                ResortImage::insert(['resort_id' => $resort->id, 'images' => $path]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Resort Added Successfully"
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

    public function edit($id)
    {
        $resort=Resort::where(['id'=>$id])->first();
        return view('admin.resort.edit',compact('resort'));
    }

    public function resortUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Accept images only
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'address' => 'required',
            'state' => 'required',
            'city'=> 'required',
            'phone' => 'required|regex:/^\+?[0-9]{1,3}?[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,9}$/',
            'mrp' => 'required|numeric',
            'price' => 'required|numeric',
            'meals_plan' => 'required',
            'distance' => 'required',
            'amenities.*' => 'required',
            'description' => 'required|string',
            'rating' => 'required|string',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
    
        DB::beginTransaction();
    
        try {
            // Retrieve existing resort by ID
            $resort = Resort::findOrFail($request->resort_id);
    
            // Generate and check uniqueness of the slug
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $counter = 1;
            while (Resort::where('slug', $slug)->where('id', '!=', $request->resort_id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
    
            $existingImages = ResortImage::where('resort_id', $resort->id)->pluck('images')->toArray();
            $imagePaths = $existingImages;
            $directory = public_path('images/resorts');
    
            // Create directory if it doesn't exist
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
    
            // Handle new image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move($directory, $filename);
                    $imagePaths[] = $filename;
                }
            }
            if ($request->hasFile('banner_image')) {
                // Define the directory path (you can also use Storage for this)
                $directory1 = public_path('images/resorts'); 
    
                // Create directory if it doesn't exist
                if (!file_exists($directory1)) {
                    mkdir($directory1, 0755, true);
                }
    
                // Generate a unique filename and move the image
                $image1 = $request->file('banner_image');
                $filename1 = time() . '_' . uniqid() . '.' . $image1->getClientOriginalExtension();
                $image1->move($directory1, $filename1); // Move file to directory
            }
            else {
                $filename1 = $resort->banner_image; // Retain the old banner image
            }
    
            // Update resort fields
            $resort->name = $request->name;
            $resort->slug = $slug;
            $resort->about = $request->description;
            $resort->address = $request->address;
            $resort->phone = $request->phone;
            $resort->mrp = $request->mrp;
            $resort->price = $request->price;
            $resort->duration = $request->duration;
            $resort->facilty = json_encode($request->amenities);
            $resort->city = $request->city;
            $resort->state = $request->state;
            $resort->meals_plan = $request->meals_plan;
            $resort->distance = $request->distance;
            $resort->suggested = $request->suggested;
            $resort->rating = $request->rating;
            $resort->banner_image = $filename1;
            $resort->updated_at = now();
            $resort->save();
    
            // Update Resort Images
            ResortImage::where('resort_id', $resort->id)->delete();
            foreach ($imagePaths as $path) {

                $resortImg =new ResortImage();
                    $resortImg->resort_id =$resort->id;
                    $resortImg->images =$path;
                    $resortImg->save();
                    
            }
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => "Resort Updated Successfully"
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => "Something went wrong: " . $e->getMessage()
            ], 500);
        }
    }
    public function deleteImage($id)
    {
        DB::beginTransaction();

        try {
            $image = ResortImage::findOrFail($id);

            // Delete the image file from the server
            $imagePath = public_path('images/resorts/' . $image->images);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the file
            }

            // Delete the record from the database
            $image->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function deleteResort(Request $request){
        Resort::where(['id'=>$request->id])->delete();
        ResortImage::where(['resort_id'=>$request->id])->delete();
        return response()->json(['message' => 'resort deleted successfully']);
    }
}
