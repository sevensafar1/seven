<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Hotel;
use App\Models\HotelImage;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class HotelController extends Controller
{
    //
    public function index()
    {
        $hoteldata=Hotel::get();
        return view('admin.hotels.index',compact('hoteldata'));
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function hotelSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp', // Accept images only
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'address' => 'required',
            'state' => 'required',
            'city'=> 'required',
            'phone' => 'required|regex:/^\+?[0-9]{1,3}?[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,9}$/',
            'mrp' => 'required|numeric',
            'price' => 'required|numeric',
            'amenities.*' => 'required',
            'distance' => 'required',
            'meals_plan' => 'required',
            'hotel_tags' => 'required',
            'description' => 'required|string',
            'rating'    => 'required|string',
        ]);
        
        // Custom error messages
        // $customMessages = [
        //     'name.required' => 'Package name is required',
        //     'images.*.image' => 'Each file must be an image',
        //     'images.*.mimes' => 'Images must be of type: jpeg, png, jpg, gif, webp',
        //     'images.*.max' => 'Each image must not exceed 2MB',
        //     'arrival_date.required' => 'Arrival date is required',
        //     'departure_date.required' => 'Departure date is required',
        //     'amount.required' => 'Amount is required',
        //     'days.required' => 'Number of days is required',
        //     'nights.required' => 'Number of nights is required',
        //     'location.required' => 'Location is required',
        //     'package_type.required' => 'Package type is required',
        // ];
        
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
                while (Hotel::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter; // Append a number to the slug
                    $counter++;
                }
                if ($request->hasFile('images')) { // Check if images are uploaded
                    $imagePaths = []; // Array to hold paths of uploaded images
                    $directory = public_path('images/hotels'); // Define the directory path
                
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
               
                $filename1= null; // Initialize filename as null in case no image is uploaded
            
            if ($request->hasFile('banner_image')) {
                $directory1 = public_path('images/hotels'); // Define the directory path
                
                if (!file_exists($directory1)) {
                    mkdir($directory1, 0755, true); // Create directory if not exists
                }

                // Generate a unique filename and move the image
                $image1 = $request->file('banner_image');
                $filename1 = time() . '_' . uniqid() . '.' . $image1->getClientOriginalExtension();
                $image1->move($directory1, $filename1); // Move file to directory
            }
                // Encode tour data as JSON
                $amenities = json_encode($request->amenities);
                // $aboutTour = json_encode($request->about_tour);
                // $tourDescription = json_encode($request->about_tour);
                // Create array for inserting data
                // $insert_arr = [
                //     'name'    => $request->name,
                //     'slug'            => $slug,
                //     'about'     =>$request->description,
                //     'address'    => $request->address,
                //     'phone'  => $request->phone,
                //     'mrp'          => $request->mrp,
                //     'price'            => $request->price,
                //     'duration'            => $request->duration,
                //     'amenities'          => $amenities,
                //     'city'        => $request->city,
                //     'state'       =>$request->state,
                //     'suggested_hotel' => $request->suggested,
                //     'rating'    => $request->rating,
                //     'created_at'      => now(),
                // ];
                $hotel = new Hotel();
                $hotel->name = $request->name;    
                $hotel->slug = $slug;
                $hotel->about = $request->description;
                $hotel->address = $request->address;
                $hotel->phone = $request->phone;
                $hotel->mrp = $request->mrp;
                $hotel->price = $request->price;
                $hotel->duration = $request->duration;
                $hotel->amenities = $amenities;
                $hotel->city = $request->city;
                $hotel->state = $request->state;
                $hotel->meals_plan = $request->meals_plan;
                $hotel->distance = $request->distance;
                $hotel->hotel_tags = $request->hotel_tags;
                $hotel->suggested_hotel =$request->suggested;    
                $hotel->rating = $request->rating;
                $hotel->banner_image = $filename1; 
                $hotel->created_at =  now();   
                $hotel->save();
                // Insert into the database
                // $hotel = Hotel::create($insert_arr); // Assuming 'package_types' is the correct table
                foreach ($imagePaths as $path) {
                    // Example: save image path to a separate images table
                    HotelImage::insert(['hotel_id' => $hotel->id, 'images' => $path]);
                }
                DB::commit();
        
                return response()->json([
                    'success' => true,
                    'message' => "Hotel Added Successfully"
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

    public function edit($id){
        $hotel=Hotel::where(['id'=>$id])->first();
        return view('admin.hotels.edit',compact('hotel'));
    }
    public function deleteImage($id)
    {
        DB::beginTransaction();

        try {
            $image = HotelImage::findOrFail($id);

            // Delete the image file from the server
            $imagePath = public_path('images/hotels/' . $image->images);
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

    public function hotelUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp', // Accept images but not required
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'phone' => 'required|regex:/^\+?[0-9]{1,3}?[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,9}$/',
            'mrp' => 'required|numeric',
            'price' => 'required|numeric',
            'amenities.*' => 'required',
            'distance' => 'required',
            'meals_plan' => 'required',
            'hotel_tags' => 'required',
            'description' => 'required|string',
            'rating' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            $hotel = Hotel::findOrFail($request->hotel_id);

            $slug = Str::slug($request->name);

            // Ensure slug uniqueness
            $originalSlug = $slug;
            $counter = 1;
            while (Hotel::where('slug', $slug)->where('id', '!=', $hotel->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Get the existing images from the database
            $existingImages = HotelImage::where('hotel_id', $hotel->id)->pluck('images')->toArray();

            $imagePaths = $existingImages; // Start with existing images
            $directory = public_path('images/hotels');

            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Handle new image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move($directory, $filename);
                    $imagePaths[] = $filename; // Add new image to the array
                }
            }


            if ($request->hasFile('banner_image')) {
                // Define the directory path (you can also use Storage for this)
                $directory1 = public_path('images/hotels'); 
    
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
                $filename1 = $hotel->banner_image; // Retain the old banner image
            }

            // Update hotel details
            $hotel->name = $request->name;
            $hotel->slug = $slug;
            $hotel->about = $request->description;
            $hotel->address = $request->address;
            $hotel->phone = $request->phone;
            $hotel->mrp = $request->mrp;
            $hotel->price = $request->price;
            $hotel->duration = $request->duration;
            $hotel->amenities = json_encode($request->amenities);
            $hotel->city = $request->city;
            $hotel->state = $request->state;
            $hotel->meals_plan = $request->meals_plan;
            $hotel->distance = $request->distance;
            $hotel->hotel_tags = $request->hotel_tags;
            $hotel->suggested_hotel = $request->suggested;
            $hotel->rating = $request->rating;
            $hotel->banner_image = $filename1;
            $hotel->save();

            // Update images only if new ones were uploaded
            if ($request->hasFile('images')) {
                HotelImage::where('hotel_id', $hotel->id)->delete(); // Delete old images only if new ones are uploaded
                foreach ($imagePaths as $path) {
                    $hotelImg= new HotelImage();
                    $hotelImg->hotel_id = $hotel->id;
                    $hotelImg->images = $path;
                    $hotelImg->save();
                    // HotelImage::create([
                    //     'hotel_id' => $hotel->id,
                    //     'images' => $path,
                    // ]);
                }
                
            }
            

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Hotel Updated Successfully"
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => "Something went wrong: " . $e->getMessage()
            ], 500);
        }
    }
    public function deleteHotel(Request $request){
        Hotel::where(['id'=>$request->id])->delete();
        HotelImage::where(['hotel_id'=>$request->id])->delete();
        return response()->json(['message' => 'Package deleted successfully']);
    }

    public function updatePopularStatus(Request $request)
    {
        try {
            // Find the hotel by its ID
            $hotel = Hotel::findOrFail($request->id);
    
            // Update the package_sts field (popular status)
            $hotel->popular = $request->package_sts;
            $hotel->save();
    
            // Respond with a success message
            return response()->json(['success' => true, 'message' => 'Popular status updated successfully.']);
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Error in updating popular status: ' . $e->getMessage());
    
            // In case of error, respond with an error message
            return response()->json(['success' => false, 'message' => 'Failed to update popular status. Please try again.', 'error' => $e->getMessage()]);
        }
    }

    public function getStates()
    {
        // Fetch the states from the database
        $states = DB::table('states')->get();
        // Check if states are found
        if ($states->isNotEmpty()) {
            return response()->json(['states' => $states], 200); // Return the states in a JSON response with HTTP 200
        }

        // Handle the case when no states are found
        return response()->json(['error' => 'No states found'], 404);
    }
    public function getCities($stateId)
    {
        // Fetch the cities from the 'cities' table where the 'state_id' matches the provided stateId
        $cities = DB::table('cities')
                    ->where('state_id', $stateId)
                    ->get();
        // Check if cities are found
        if ($cities->isNotEmpty()) {
            return response()->json(['cities' => $cities], 200); // Return the cities in a JSON response with HTTP 200
        }

        // Handle the case when no cities are found
        return response()->json(['error' => 'No cities found for this state.'], 404);
    }
}
