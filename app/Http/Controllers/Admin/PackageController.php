<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageType;
use App\Models\PackageImage;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    //
    public function index()
    {

        $packages=Package::orderBy('created_at', 'desc')->get();
        return view('admin.package.index',compact('packages'));
    }
    public function Package()
    {
        $packageType=PackageType::where(['status'=>'1'])->get();
        return view('admin.package.create',compact('packageType'));
    }

    public function packageType()
    {
        $packageType=PackageType::where(['status'=>'1'])->get();
        return view('admin.packagetype.index',compact('packageType'));
    }

    public function packageTypecreate()
    {
        
        return view('admin.packagetype.create');
    }

    public function packageTypeSave(Request $request)
    {

        $rules = [
            'package_name'       => 'required|string|max:255',
        ];
    
        // Custom error messages
        $customMessages = [
            'package_name.required' => 'Package name is required',
           
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
                $slug = Str::slug($request->package_name);

                // Check for uniqueness of the slug
                $originalSlug = $slug;
                $counter = 1;
                while (PackageType::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter; // Append a number to the slug
                    $counter++;
                }
        
                // Create array for inserting data
                $insert_arr = [
                    'package_name' => $request->package_name,
                    'slug'         => $slug,
                    'status'       => $request->status,
                    'created_at'   => now(),
                ];
        
                // Insert into the database
                $insert = PackageType::insert($insert_arr); // Assuming 'package_types' is the correct table
        
                DB::commit();
        
                return response()->json([
                    'success' => true,
                    'message' => "Package Added Successfully"
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

    public function packageTypeEdit($id)
    {
        $data=PackageType::where(['slug'=>$id,'status'=>'1'])->first();
        return view('admin.packagetype.edit',compact('data'));
    }

    public function packageTypeUpdate(Request $request){
        $rules = [
            'package_name'       => 'required|string|max:255',
        ];
    
        // Custom error messages
        $customMessages = [
            'package_name.required' => 'Package name is required',
           
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
                $slug = Str::slug($request->package_name);

                // Check for uniqueness of the slug
                $originalSlug = $slug;
                $counter = 1;
                while (PackageType::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter; // Append a number to the slug
                    $counter++;
                }
        
                // Create array for inserting data
                $insert_arr = [
                    'package_name' => $request->package_name,
                    // 'slug'         => $slug,
                    'status'       => $request->status,
                    'updated_at'   => now(),
                ];
        
                // Insert into the database
                $insert = PackageType::where(['slug'=>$request->update_id])->update($insert_arr); // Assuming 'package_types' is the correct table
        
                DB::commit();
        
                return response()->json([
                    'success' => true,
                    'message' => "Package Updated Successfully"
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

    public function packageDelete(Request $request)
    {
        // dd($request->all());
        PackageType::where(['id'=>$request->id])->delete();
        return response()->json(['message' => 'Package Type deleted successfully']);
    }

    public function packageSave(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Accept images only
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date',
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
            'days' => 'required|integer',
            'nights' => 'required|integer',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'package_type' => 'required|integer',
        ]);
        
        // Custom error messages
        $customMessages = [
            'name.required' => 'Package name is required',
            'title' => 'Title is required',
            'images.*.image' => 'Each file must be an image',
            'images.*.mimes' => 'Images must be of type: jpeg, png, jpg, gif, webp',
            'images.*.max' => 'Each image must not exceed 2MB',
            'arrival_date.required' => 'Arrival date is required',
            'departure_date.required' => 'Departure date is required',
            'amount.required' => 'Amount is required',
            'price.required' => 'Price is required',
            'days.required' => 'Number of days is required',
            'nights.required' => 'Number of nights is required',
            'location.required' => 'Location is required',
            'package_type.required' => 'Package type is required',
        ];
        
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
                while (Package::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter; // Append a number to the slug
                    $counter++;
                }
                if ($request->hasFile('images')) { // Check if images are uploaded
                    $imagePaths = []; // Array to hold paths of uploaded images
                    $directory = public_path('images/packages'); // Define the directory path
                
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
                    $directory1 = public_path('images/packages'); // Define the directory path
                    
                    if (!file_exists($directory1)) {
                        mkdir($directory1, 0755, true); // Create directory if not exists
                    }
    
                    // Generate a unique filename and move the image
                    $image1 = $request->file('banner_image');
                    $filename1 = time() . '_' . uniqid() . '.' . $image1->getClientOriginalExtension();
                    $image1->move($directory1, $filename1); // Move file to directory
                }
                $tourData = [
                    'place' => $request->place,
                    'inclusions' => $request->inclusions,
                    'exclusions' => $request->exclusions,
                    'event_date' => $request->event_date,
                ];
                $tourDescription = [
                    'tourtitle' => $request->tourtitle,
                    'tour_description' => $request->tour_description,
                ];
        
                // Encode tour data as JSON
                 $tourAbout = json_encode($tourData);
                 $tourDescriptionJson = json_encode($tourDescription);
                // $aboutTour = json_encode($request->about_tour);
                // $tourDescription = json_encode($request->about_tour);
                // Create array for inserting data
                // $insert_arr = [
                //     'title'=>$request->title,
                //     'name'    => $request->name,
                //     'slug'            => $slug,
                //     'description'     =>$request->description,
                //     'arrival_date'    => $request->arrival_date,
                //     'departure_date'  => $request->departure_date,
                //     'amount'          => $request->amount,
                //     'price'=>$request->price,
                //     'days'            => $request->days,
                //     'nights'          => $request->nights,
                //     'location'        => $request->location,
                //     'about_tour'       =>$tourAbout,
                //     'tour_description' => $tourDescriptionJson,
                //     'package_type'    => $request->package_type,
                //     'created_at'      => now(),
                // ];
                $package = new Package();    
                $package->title = $request->title;
                $package->name = $request->name;
                $package->slug = $slug;
                $package->description = $request->description;
                $package->arrival_date = $request->arrival_date;
                $package->departure_date = $request->departure_date;
                $package->amount = $request->amount;
                $package->price = $request->price;
                $package->days = $request->days;
                $package->nights = $request->nights;
                $package->location = $request->location;    
                $package->about_tour = $tourAbout; 
                $package->in_home = $request->home_package; 
                $package->tour_description = $tourDescriptionJson; 
                $package->package_type = $request->package_type;
                $package->banner_image = $filename1; 
                $package->created_at = now();      
                $package->save();
        
                // Insert into the database
                // $package = Package::create($insert_arr); // Assuming 'package_types' is the correct table
                foreach ($imagePaths as $path) {
                    // Example: save image path to a separate images table
                    PackageImage::insert(['package_id' => $package->id, 'images' => $path]);
                }
                DB::commit();
        
                return response()->json([
                    'success' => true,
                    'message' => "Package Added Successfully"
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

    public function PackageEdit($id)
    {
        $packageType=PackageType::where(['status'=>'1'])->get();
        $package=Package::where(['slug'=>$id])->first();
        return view('admin.package.edit',compact('package','packageType'));
    }

    public function packageUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date',
            'amount' => 'required|numeric',
            'days' => 'required|integer',
            'nights' => 'required|integer',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'package_type' => 'required|integer',
        ]);

        // Custom error messages
        $customMessages = [
            'name.required' => 'Package name is required',
            'arrival_date.required' => 'Arrival date is required',
            'departure_date.required' => 'Departure date is required',
            'amount.required' => 'Amount is required',
            'days.required' => 'Number of days is required',
            'nights.required' => 'Number of nights is required',
            'location.required' => 'Location is required',
            'package_type.required' => 'Package type is required',
        ];

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            // Retrieve existing package by ID
            $package = Package::findOrFail($request->package_id);

            // Generate slug and ensure uniqueness
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $counter = 1;
            while (Package::where('slug', $slug)->where('id', '!=', $package->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $existingImages = PackageImage::where('package_id', $package->id)->pluck('images')->toArray();
            $imagePaths = $existingImages;
            $directory = public_path('images/packages');

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
                $directory1 = public_path('images/packages'); 
    
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
                $filename1 = $package->banner_image; // Retain the old banner image
            }

            // Prepare tour details
            $tourData = [
                'place' => $request->place,
                'inclusions' => $request->inclusions,
                'exclusions' => $request->exclusions,
                'event_date' => $request->event_date,
            ];
            $tourDescription = [
                'tourtitle' => $request->tourtitle,
                'tour_description' => $request->tour_description,
            ];

            // Encode tour data as JSON
            $tourAbout = json_encode($tourData);
            $tourDescriptionJson = json_encode($tourDescription);

            // Update package details
            $package->title = $request->title;
            $package->name = $request->name;
            $package->slug = $slug;
            $package->description = $request->description;
            $package->arrival_date = $request->arrival_date;
            $package->departure_date = $request->departure_date;
            $package->amount = $request->amount;
            $package->price = $request->price;
            $package->days = $request->days;
            $package->nights = $request->nights;
            $package->location = $request->location;
            $package->about_tour = $tourAbout;
            $package->in_home = $request->home_package; 
            $package->tour_description = $tourDescriptionJson;
            $package->package_type = $request->package_type;
            $package->banner_image = $filename1;
            $package->updated_at = now(); // Set updated_at timestamp
            $package->save(); // Save the changes to the existing package

            // Update package images
            PackageImage::where('package_id', $package->id)->delete(); // Delete old images
            foreach ($imagePaths as $path) {
                $packageImg = new PackageImage();
                $packageImg->package_id = $package->id;
                $packageImg->images = $path;
                $packageImg->save(); // Save each image
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Package Updated Successfully"
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
            // dd($id);
            $image = PackageImage::findOrFail($id);

            // Delete the image file from the server
            $imagePath = public_path('public/images/packages/' . $image->images);
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
    public function deletePackage(Request $request){
        Package::where(['id'=>$request->id])->delete();
        PackageImage::where(['package_id'=>$request->id])->delete();
        return response()->json(['message' => 'Package deleted successfully']);

    }
}
