<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EnquiryController extends Controller
{
    //
    public function enquirySave(Request $request){

        $rules = [
            'name'       => 'required|string|max:255',
            'phone'       => 'required',
            'email'       => 'required',
            'city'       => 'required',
            // 'package'       => 'required',
            'arrival'       => 'required',
            'departure'       => 'required',
            'noofadults'    =>'required',
            'noofchildrens'    =>'required',
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
            $arrival_date = \Carbon\Carbon::createFromFormat('m/d/Y', $request->input('arrival'))->format('Y-m-d');
            $departure_date = \Carbon\Carbon::createFromFormat('m/d/Y', $request->input('departure'))->format('Y-m-d');
        
                // Create array for inserting data
                $insert_arr = [
                    'name' => $request->name,
                    'destination'         => $request->city,
                    'email'       => $request->email,
                    'phone' => $request->phone,
                    'arrival_date'         =>  $arrival_date,
                    'departure_date'       =>  $departure_date,
                    'package_id'       => $request->package,
                    'no_of_adult'         => $request->noofadults,
                    'no_of_child'       => $request->noofchildrens ,
                    'city'       => $request->city,
                    'form_type'       => 'enquiry',
                    'enquiry_type'     =>$request->enquiry,
                    'status'       => '0',
                    'created_at'   => now(),
                ];
        
                // Insert into the database
                $insert = Contact::insert($insert_arr); // Assuming 'package_types' is the correct table
        
                DB::commit();
        
                return response()->json([
                    'success' => true,
                    'message' => "Enquiry Submitted Successfully"
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

    public function ContactSave(Request $request){
        $rules = [
            'name'       => 'required|string|max:255',
            'phone'       => 'required',
            'email'       => 'required',
            'comment'       => 'required',
            
        ];
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
                    'name' => $request->name,
                    'comment'         => $request->comment,
                    'email'       => $request->email,
                    'phone' => $request->phone,
                    'form_type'       => 'contact',
                    'status'       => '0',
                    'created_at'   => now(),
                ];
        
                // Insert into the database
                $insert = Contact::insert($insert_arr); // Assuming 'package_types' is the correct table
        
                DB::commit();
        
                return response()->json([
                    'success' => true,
                    'message' => "Contact Submitted Successfully"
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
}
