<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function registerForm(){
        return view('admin.register');
    }
    public function register(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users',
            // 'user_type' => 'required|in:1,2,3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);
    
        $user = User::create([
            'name' => $validated['name'],
            // 'user_type' => $validated['user_type'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
    
        auth()->login($user);
    
        return response()->json(['success' => 'User registered successfully!']);
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function loginForm(){
        return view('admin.login');
    }
    public function login(Request $request)
    {
        // dd($request->all()); // Debugging to see the submitted request

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // If successful, redirect to the dashboard
            return redirect()->route('dashboard');
        }

        // If failed, return back with error message
        return back()->withErrors(['message' => 'Invalid credentials or not an admin.']);
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user

        // Optional: You can add a success message to the session here if you want
        // $request->session()->flash('success', 'You have been logged out.');

        return redirect('/login'); // Redirect to the login page
    }
    public function userList()
    {
        $users=User::get();

        return view('admin.user.user_list',compact('users'));
    }

    public function changePassword($id){
        $user=User::where(['id'=>$id])->first();
        return view('admin.user.change_password',compact('user'));
    }

    public function passwordUpdate(Request $request)
    {
         // Custom validation rules
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required', // Customize validation rules if needed
            'id' => 'required|exists:users,id'
        ]);

        // If validation fails, return error messages
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        }

        // Find the user by ID
        $user = User::findOrFail($request->id);

        // Update email (optional, as email is readonly) and password
        $user->password = Hash::make($request->password); // Hash the password

        // Save the updated user
        $user->save();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully!',
        ]);
    }
     
}
