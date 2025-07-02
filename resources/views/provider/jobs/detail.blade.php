@extends('layouts.provider-layout')

@section('css')
      <style>
    .svg-icon {
      width: 1.2rem;
      height: 1.2rem;
    }
  </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container my-5">
            <!-- Back to Jobs Button -->
            <div class="mb-4">
                <a href="https://prfy-laravel-stg-95864fbb917b.herokuapp.com/provider/jobs" class="btn btn-outline-secondary d-inline-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-2 svg-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                <strong>Back to Jobs</strong>
                </a>
            </div>

            <!-- Job Card -->
            <div class="card border">
                <div class="card-body p-4 p-md-5">

                <!-- Title and Status -->
                <div class="mb-4">
                    <h1 class="h3 mb-3 fw-bold">{{$job->title}}</h1>
                    <span class="badge bg-primary text-light px-3 py-2">Open</span>
                </div>
                <hr>

                <!-- Meta Info -->
                <div class="mb-4">
                    <div class="d-flex align-items-center text-muted mb-2">
                    <svg class="me-2 svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <small>Posted <time datetime="2025-05-01 17:35:17">{{$job->created_at->diffForHumans()}}</time></small>
                    </div>
                    <div class="d-flex align-items-center text-muted">
                    <svg class="me-2 svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <small>0 proposals submitted</small>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-light rounded p-4 mb-4">
                    <h5>Description</h5>
                    {!! $job->description !!}
                </div>

                <!-- Job Details -->
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <p class="text-muted mb-1">Budget</p>
                        <p class="fw-semibold">{{$job->budget}}</p>
                    </div>
                </div>

                <hr>

                <!-- Call to Action -->
                <div class="text-center p-4">
                    <a href="{{ route('provider.jobs.proposal.create', $job->id) }}" class="btn btn-primary d-inline-flex align-items-center">
                        <svg class="me-2 svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                        </svg>
                        Submit Your Proposal
                    </a>
                    <p class="mt-3 text-muted">Be one of the first to apply and increase your chances of landing this job!</p>
                </div>

                </div>
            </div>
        </div>
    </div>
@endsection