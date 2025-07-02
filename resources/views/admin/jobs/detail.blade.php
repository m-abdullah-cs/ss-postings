@extends('layouts.admin-layout')


{{-- @section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/client/jobs-detail.css') }}">
@endsection --}}

@section('content')

<div class="content-wrapper">

    <div class="container pb-5">
        <div class="mb-4 pt-5" >
            <a href="{{route('admin.jobs')}}" class="btn btn-outline-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
            </svg>
            Back to Jobs
            </a>
        </div>

        <div class="card mb-0">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <form method="post" onsubmit="return confirm('Are you sure you want to archive this job? This action cannot be undone.');" action="{{ route('admin.job.delete', $job->id) }}">
                        @csrf
                        {{-- <input type="hidden" name="_method" value="DELETE"> --}}
                        <button type="submit" class="btn btn-outline-danger">Archive Job</button>
                    </form>
                </div>

                <h1 class="h3 mb-3">{{$job->title}}</h1>
                <span class="badge bg-primary">Open for Proposals</span>

                <hr>

                <div class="mb-3 text-muted">
                    <p><i class="bi bi-clock me-2"></i>Posted on: {{$job->created_at}}</p>
                    <p><i class="bi bi-person-check me-2"></i>1 proposals submitted</p>
                </div>

                <div class="bg-light p-4 rounded">
                    <h4>Job Description</h4>
                    <p>{{$job->description}}</p>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                    <h6 class="text-muted">Budget</h6>
                    <p class="fs-5">{{$job->budget}}</p>
                    </div>
                </div>

                <hr>

                <div class="text-center">
                    <a href="#" class="btn btn-primary btn-lg">
                    <i class="bi bi-eye me-2"></i>View 0 Proposal
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection