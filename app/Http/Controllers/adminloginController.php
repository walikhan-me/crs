<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\adminlogin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class adminloginController extends Controller
{
    public function login(){
        return view('Admin/login');
       
    }

    public function admin_Login(Request $request){
       
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $user = adminlogin::where(function ($query) use ($credentials) {
            $query->where('admin_username', $credentials['username'])
                  ->orWhere('admin_email', $credentials['username']);
        })->first();
        

        if ($user && Hash::check($credentials['password'], $user->admin_password)) {
          
            $request->session()->regenerate();
            return redirect('Admin/registration');

        }
        return back()->with('error', 'Invalid username or password');
    }
    

    public function registration(){
        return view('Admin/registration');
    }

    public function admin_registration(Request $request)
    {
        $rules = [
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|string|email|max:255|unique:adminlogins',
            'admin_username' => 'required|string|max:255|unique:adminlogins',
            'admin_mobile' => 'required|string|max:255|unique:adminlogins',
            'admin_password' => 'required|string|min:6',
        ];
        $messages = [
            'admin_email.unique' => 'The email has already been taken.',
            'admin_username.unique' => 'The username has already been taken.',
            'admin_mobile.unique' => 'The mobile number has already been taken.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $hashedPassword = Hash::make($request->admin_password);
        $admin = new adminlogin();
        $admin->admin_name = $request->admin_name;
        $admin->admin_email = $request->admin_email;
        $admin->admin_username = $request->admin_username;
        $admin->admin_mobile = $request->admin_mobile;
        $admin->admin_password = $hashedPassword; // Store the hashed password
        $admin->save();
        return view('Admin.login')->with('success', 'Admin registered successfully.');
    }
}
