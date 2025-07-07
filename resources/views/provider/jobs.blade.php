@extends('layouts.provider-layout')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/client/jobs-detail.css') }}">
    <style>
  .btn-purple {
    background-color: #6f42c1 !important;
    border-color: #6f42c1 !important;
  }
  .btn-purple:hover {
    background-color: #5936a6 !important;
    border-color: #5936a6 !important;
  }
</style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-evenly">
                    <div class="col-md-8 details mt-4 mb-4 pt-2 ">
                        <div class="row justify-content-evenly">
                           
                            @if($jobs->isNotEmpty())
                                <h1>Available Jobs</h1>
                                <div class="container">
                                    <div class="card shadow-sm rounded">  
                                        <ul class="list-group list-group-flush">
                                            <!-- Job Item -->
                                            @foreach ($jobs as $job)
                                                <li class="list-group-item py-4">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-9">
                                                            <h5 class="mb-2 fw-semibold text-dark">{{$job->title}}</h5>
                                                            <div class="d-flex flex-wrap text-muted small gap-3">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="bi bi-clock me-1"></i>
                                                                    <span>Created: <time datetime="2025-03-04 16:28:39">Mar 4,
                                                                            2025</time></span>
                                                                </div>
                                                                <!-- Add more job meta info here if needed -->
                                                            </div>
                                                        </div>
                                                        
                                                        @php
                                                            $proposal = $job->proposals->where('provider_id', auth()->user()->id)->first();
                                                
                                                        @endphp


                                                        @if(!$proposal)
                                                            <div class="col-md-3 text-md-end mt-3 mt-md-0">
                                                                <a href="{{ route('provider.jobs.detail', $job->id) }}"
                                                                    class="btn btn-purple text-white w-100">
                                                                    Make Proposal
                                                                </a>
                                                            </div>
                                                            @else
                                                            <div class="col-md-3 text-md-end mt-3 mt-md-0">
                                                                <a href="{{ route('provider.job.proposal.view', ['jobId'=> $job->id, 'proposalId' => $proposal->id]) }}"
                                                                    class="btn btn-purple text-white w-100">
                                                                    View Proposal
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @else
                                <div style="border: 1px solid grey; width: 456px; height: auto; border-radius: 5px;" class="text-center bg-primary pt-3 pb-3">
                                    <h1>Jobs Not Available</h1>
                                   <div class="d-flex justify-content-end">
                                        @php
                                            $user = auth()->user()->role;
                                            
                                        @endphp
                                        <a type="button" href="{{ route($user.'-dashboard') }}" class="btn btn-success w-20 h-10 justify-content-end">Back</a>
                                   </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
