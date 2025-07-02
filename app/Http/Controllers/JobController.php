<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 use Carbon\Carbon;

class JobController extends Controller
{
    public function createJob()
    {
        $user = User::where('role', Auth::user()->role)->first();
        $profile = $user->profile;
        return view('client.create-job', compact('profile', 'user'));
    }

    public function createJobData(Request $request){
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'budget' => 'required',
            'timeline' => 'required|date',
        ]);
        if($validated){
            $created = Job::create([
                'title' => $request->title,
                'description' => $request->description,
                'budget' => $request->budget,
                'timeline' => $request->timeline,
                'client_id' => Auth::user()->id,
            ]);
            if($created){
                return redirect()->route('client-dashboard')->with('msg', 'Successfully Created Job');
            }
        }

        // Store the job data in the database
        // Assuming you have a Job model and a jobs table
        \App\Models\Job::create($request->all());

        return redirect()->route('client-dashboard')->with('success', 'Job created successfully!');
    }

   

    public function jobEdit($id){
        $job = Job::find($id);
        // dd($job);
        return view('client.jobs.edit', compact('job'));
    }


  





    public function deleteJob($id)
    {
        Job::where('id', $id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Job Deleted Successfully',
        ]);
    }


    public function jobsDetail(){
        $jobs = Job::all();
        return view('client.jobs-detail', compact('jobs'));
    }

    public function jobs()
    {
        $userId =  Auth::user()->id;
        

        $jobs = Job::where('status', '0')->get();
        foreach ($jobs as $job) {
            
            $job->formatted_timeline = \Carbon\Carbon::parse($job->timeline)->format('j F Y');
        }
  
        return view('provider.jobs', compact('jobs'));
    }

    public function providerJobDetail($id)
    {
        // dd($id);
        $job = Job::find($id);

        return view('provider.jobs.detail', compact('job'));
    }


}
     