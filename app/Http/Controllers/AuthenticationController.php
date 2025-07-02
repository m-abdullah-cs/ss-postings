<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthenticationController extends Controller
{
    public function loginData(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('admin-dashboard')->with('msg', 'Login successful');
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function registerationForm(){
        return view('authentication.registeration');
    }

    public function registerData(Request $request){
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);
        //  dd($request);
        $created = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
       
        if($created){
            // dd("hi");
           return redirect()->to('/')->with('msg', 'User registered successfully');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('msg', 'Logout successful');
    }

    public function adminDashboard(){
        $providers = User::where('role', 'provider')->get();
        $clients = User::where('role', 'client')->get();

         $jobs = Job::all();
        return view('admin.admin-dashboard', compact('providers', 'clients', 'jobs'));
    }
}
