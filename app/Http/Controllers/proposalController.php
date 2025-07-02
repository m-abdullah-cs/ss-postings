<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Message;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\Failed\FileFailedJobProvider;

class proposalController extends Controller
{
    public function create($id){
        $job = Job::find($id);
        // dd($job);
        return view('provider.proposal.create', compact('job'));
    }

    public function store(Request $request, $jobId){
        $userId = Auth::user()->id;  
        // dd($request->all());
        $validated = $request->validate([
            'description' => 'required|string',
            'your_price' => 'required',
            'required_deposit' => 'required',
        ]);
        if($validated){
            $created = Proposal::create([
                'description' => $request->description,
                'your_price' => $request->your_price,
                'required_deposit' => $request->required_deposit,
                'job_id' => $jobId,
                'provider_id' => $userId,
            ]);
            if($created){
                return redirect()->route('provider.jobs')->with('msg', 'Successfully Created Proposal');
            }
        }
    } 
    
    public function view($jobId, $proposalId){
        $user = Auth::user();
       $userProfile =$user->profile;  
        $proposal = Proposal::where('id', $proposalId)->first();
        $job = Job::where('id', $proposal->job_id)->first();
        $receiverid = $job->client_id; 
        return view('provider.proposal.view', compact('proposal', 'user', 'job', 'userProfile', 'receiverid'));
    }

    // ==========================ClientControllr--------------------------

  

    public function clientProposal($jobId, $proposalId){
        $user = Auth::user();
        $profile=$user->profile;
        $proposal = Proposal::select('proposals.*', 'users.name as proposal_submitted_by')
        ->leftJoin('users','proposals.provider_id', '=', 'users.id')
        ->where('proposals.id', $proposalId)->first();
        // dd($proposal);  ok
            $job = Job::where('id', $jobId)->first();
            // dd($job); ok
        return view('client.proposal.detail', compact('proposal', 'user', 'profile', 'job'));
    }

      
}
