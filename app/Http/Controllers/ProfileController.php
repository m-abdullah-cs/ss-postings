<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function providerProfile(){
       $user = Auth::user();
       $unseen = Message::whereNull('status')->get();

        $profile = $user->profile;
        if ($profile != null) {
            $certificates = explode(',', $profile->skills);
            $profile->skills = $certificates;
        }

        return view('provider.profile', compact('user', 'profile', 'unseen'));
    }

    public function editProviderProfile($id)
    {
        $unseen = Message::whereNull('status')->get();
        $user = Auth::user();
        $profile = $user->profile;
        // dd($profile);

        return view('provider.edit-profile', compact('user', 'profile', 'unseen'));
    }


    public function editProviderProfileData(Request $request, $old_picture = null)
    {
        $imageName = $old_picture;
        $validated = $request->validate([
                'headline' => 'required|string',
                'description' => 'required|string',
                'skills' => 'required',
            ]);

        if ($validated) {
            if ($request->id && $request->file('profile-pic') != null) {
                // dd(":oldpicture");
                $path = 'public/assets/profiles/' . $old_picture;
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }

                $image = $request->file('profile-pic');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/assets/profiles', $imageName);
            }
            if ($request->id) {
                // dd("only  id");
                Profile::where('id', $request->id)->update([
                    'headline' => $request->headline,
                    'description' => $request->description,
                    'linkedin_profile' => $request->linkedin_profile,
                    'website_url' => $request->website_url,
                    'skills' => $request->skills,
                    'picture' => $imageName, // Save relative path
                ]);
                User::where('id', Auth::user()->id)->update([
                    'name' => $request->name,
                ]);
                return redirect()->route('provider.profile')->with('msg', 'Profile updated successfully');
            } else {
                // dd($request);
                // dd("else");
                $image = $request->file('profile-pic');
                
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // dd("this image ".$imageName);
                $image->storeAs('assets/profiles', $imageName);
// dd("this image is".$imageName);
                $created = Profile::create([
                    'headline' => $request->headline,
                    'description' => $request->description,
                    'linkedin_profile' => $request->linkedin_profile,
                    'website_url' => $request->website_url,
                    'skills' => $request->skills,
                    'picture' => $imageName, // Save relative path
                    'user_id' => $user = Auth::user()->id,              
                ]);

                if ($created) {
                    return redirect()->route('provider.profile')->with('msg', 'Profile updated successfully');
                }
            }


        }

    }





    public function adminProfile(){
        $user = Auth::user();
        $profile = $user->profile;
        if ($profile != null) {
            $certificates = explode(',', $profile->skills);
            $profile->skills = $certificates;
        }
        return view('admin.profile', compact('user', 'profile'));
    }


     public function editAdminProfile($id)
    {
        $user = Auth::user();
        // $user = auth()->user();
        $profile = $user->profile;

        return view('admin.edit-profile', compact('user', 'profile'));
    }



    public function editAdminProfileData(Request $request, $old_picture = null)
    {
        $imageName = $old_picture;
        $validated = $request->validate([
                'headline' => 'required|string',
                'description' => 'required|string',
                'skills' => 'required',
            ]);

        if ($validated) {
            if ($request->id && $request->file('profile-pic') != null) {

                $path = 'public/assets/profiles/' . $old_picture;
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }

                $image = $request->file('profile-pic');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/assets/profiles', $imageName);
            }
            if ($request->id) {

                Profile::where('id', $request->id)->update([
                    'headline' => $request->headline,
                    'description' => $request->description,
                    'linkedin_profile' => $request->linkedin_profile,
                    'website_url' => $request->website_url,
                    'skills' => $request->skills,
                    'picture' => $imageName, // Save relative path
                ]);
                User::where('id', Auth::user()->id)->update([
                    'name' => $request->name,
                ]);
                return redirect()->route('provider.profile')->with('msg', 'Profile updated successfully');
            } else {
                $image = $request->file('profile-pic');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/assets/profiles', $imageName);

                $created = Profile::create([
                    'headline' => $request->headline,
                    'description' => $request->description,
                    'linkedin_profile' => $request->linkedin_profile,
                    'website_url' => $request->website_url,
                    'skills' => $request->skills,
                    'picture' => $imageName, // Save relative path
                    'user_id' => Auth::user()->id,
                ]);

                if ($created) {
                    return redirect()->route('admin.profile')->with('msg', 'Profile updated successfully');
                }
            }
        }
    }



    public function clientProfile(){
        $user = Auth::user();
        $profile = $user->profile;
        if ($profile != null) {
            $certificates = explode(',', $profile->skills);
            $profile->skills = $certificates;
        }
        return view('client.profile', compact('user', 'profile'));
    }
      public function editClientProfile($id){
        $user = Auth::user();
        $profile = $user->profile;
        return view('client.edit-profile', compact('user', 'profile'));
    }


    public function editClientProfileData(Request $request, $old_picture = null){
        $imageName = $old_picture;
        $validated = $request->validate([
                'headline' => 'required|string',
                'description' => 'required|string',
                'skills' => 'required',
            ]);

        if($validated){
            if ($request->id && $request->file('profile-pic') != null) {
                $path = 'assets/profiles/' . $old_picture;
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }
                $image = $request->file('profile-pic');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/assets/profiles', $imageName);
            }
            if ($request->id) {
                Profile::where('id', $request->id)->update([
                    'headline' => $request->headline,
                    'description' => $request->description,
                    'linkedin_profile' => $request->linkedin_profile,
                    'website_url' => $request->website_url,
                    'skills' => $request->skills,
                    'picture' => $imageName, // Save relative path
                ]);
                
                User::where('id', Auth::user()->id)->update([
                    // dd("hi its model"),
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
                return redirect()->route('client.profile')->with('msg', 'Profile updated successfully');
            } else {
               
                $image = $request->file('profile-pic');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('assets/profiles', $imageName);
                $created = Profile::create([
                    'headline' => $request->headline,
                    'description' => $request->description,
                    'linkedin_profile' => $request->linkedin_profile,
                    'website_url' => $request->website_url,
                    'skills' => $request->skills,
                    'picture' => $imageName, // Save relative path
                    'user_id' => Auth::user()->id,
                ]);
                if ($created){
                    return redirect()->route('client.profile')->with('msg', 'Profile updated successfully');
                }
            }
        }
    }
}
