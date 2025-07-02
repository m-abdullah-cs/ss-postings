<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function providerController(){
        // $unseen = Message::whereNull('status')->get();
         $user = Auth::user();

        $profile = $user->profile;
  

           return view('provider.provider-dashboard', compact('profile' , 'user'));
 
    }


    
}
