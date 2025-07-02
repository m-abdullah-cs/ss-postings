<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function clientDashboard(){
        $user = User::where('role', Auth::user()->role)->first();
        $profile = $user->profile;
        return view('client.client-dashboard', compact('profile', 'user'));
    }
}
