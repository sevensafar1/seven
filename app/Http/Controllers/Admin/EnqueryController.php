<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EnqueryController extends Controller
{
    //
    public function index()
    {
        $enquiry=Contact::where('form_type','enquiry')->get();

        return view('admin.contact.index',compact('enquiry'));
    }
    public function edit($id)
    {
        // dd($id);
        $enq=Contact::where(['form_type'=>'enquiry','id'=>$id])->first();
        return view('admin.contact.enquiryedit',compact('enq'));
    }
    public function enquiryUpdate(Request $request)
    {
        $rules = [
            'status'       => 'required|string|max:255',
        ];
    
        // Custom error messages
        $customMessages = [
            'status.required' => 'Status  is required',
           
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

                
        
                // Create array for inserting data
                $insert_arr = [
                    'status' => $request->status,
                    
                ];
        
                // Insert into the database
                $insert = Contact::where(['id'=>$request->update_id])->update($insert_arr); // Assuming 'package_types' is the correct table
        
                DB::commit();
        
                return response()->json([
                    'success' => true,
                    'message' => "Status Updated Successfully"
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

    public function contact(){

        $contact=Contact::where('form_type','contact')->get();
        return view('admin.contact.contact',compact('contact'));
    }

    public function contactedit($id){
        $enq=Contact::where(['form_type'=>'contact','id'=>$id])->first();
        return view('admin.contact.contactedit',compact('enq'));

    }
}
