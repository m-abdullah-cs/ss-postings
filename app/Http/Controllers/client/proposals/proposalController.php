<?php

namespace App\Http\Controllers\client\proposals;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class proposalController extends Controller
{
      public function proposals($jobId){
        $proposals = Proposal::select('proposals.*', 'jobs.title as job_title')
        ->leftJoin('jobs', 'proposals.job_id', '=', 'jobs.id')
        ->where('job_id', $jobId)
        ->get();

       $user = auth()->user();
$profile = $user->profile; // might be null, but it's now defined
return view('client.proposal.list', compact('proposals', 'user', 'profile'));
    }
}
