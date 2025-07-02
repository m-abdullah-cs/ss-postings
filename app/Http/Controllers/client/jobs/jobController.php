<?php

namespace App\Http\Controllers\client\jobs;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class jobController extends Controller
{
    public function list(){
        $user = Auth::user();
        $profile=$user->profile;
        $jobsonly = Job::all()->where('status', '!=' ,1);
        $jobs = [];
        foreach($jobsonly as $job){
            $formattedjob = $job->toArray();
            
            $formattedjob['proposals'] = $job->proposals->map(function($proposal){
                return [
                    'id' => $proposal->id,
                    'status' => $proposal->status,
                ];
            });
            $jobs[] = $formattedjob;
        }

        
        return view('client.jobs.list', compact('jobs', 'profile', 'user'));
    }


    public function detail($id){
        $job = Job::find($id);
        $user = Auth::user();
        $profile=$user->profile;
    
        return view('client.jobs.detail', compact('job', 'user', 'profile'));
    }

    public function Delete($jobId){
        $job = Job::find($jobId);
        $deleted = $job->delete();
        if($deleted){
            return redirect()->route('client.jobs')->with('msg', 'job deleted successfully');
        }else{
            return redirect()->route('client.jobs')->with('error', 'Couldnt Deleted Job');
        }
    }

    public function edit($id){
        $job = Job::find($id);
        return view('client.jobs.edit', compact('job'));
    }

      public function editData(Request $request,$id){
        $edited = Job::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'budget' => $request->budget,
            'timeline' => $request->timeline,
        ]);
        if($edited){
            return redirect()->route('client.jobs')->with('msg', 'Data Successfully edited');
        }
        else{
            return redirect()->route('client.jobs')->with('error', 'Couldnt Edit');
        }
    }
}
