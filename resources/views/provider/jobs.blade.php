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

        <section class="content mt-4">
            <div class="container-fluid">
                <div class="row justify-content-evenly">
                    <div class="col-md-8 details mt-4 mb-4 pt-2 ">
                        <div class="row justify-content-evenly">
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

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
