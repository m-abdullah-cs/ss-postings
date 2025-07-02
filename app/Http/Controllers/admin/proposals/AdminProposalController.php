<?php

namespace App\Http\Controllers\admin\proposals;

use App\Models\Job;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminProposalController extends Controller
{
    public function proposals($jobId){
         $proposals = Proposal::select('proposals.*', 'jobs.title as job_title')
        ->leftJoin('jobs', 'proposals.job_id', '=', 'jobs.id')
        ->where('job_id', $jobId)
        ->get();
        return view('admin.proposals.list', compact('proposals'));
    }

      public function proposal($jobId, $proposalId){
        $user = Auth::user();
        $userProfile =$user->profile;
        $proposal = Proposal::select('proposals.*', 'users.name as proposal_submitted_by')
        ->leftJoin('users','proposals.provider_id', '=', 'users.id')
        ->where('proposals.id', $proposalId)->first();
            $job = Job::where('id', $jobId)->first();
        return view('admin.proposals.detail', compact('proposal', 'user', 'userProfile', 'job'));
    }
}
