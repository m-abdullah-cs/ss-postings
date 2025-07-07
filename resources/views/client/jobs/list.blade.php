@php
    use Carbon\Carbon;
@endphp

@extends('layouts.client-layout')




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
                            @if($jobs)
                                <h1>Available Jobs</h1>
                                <div class="container">
                                    <div class=" shadow-sm rounded">
                                        <ul class="list-unstyled mb-4">
                                            <!-- Job Item -->
                                            @foreach ($jobs as $job)
                                                <li class="card mb-4 shadow-sm border-0 position-relative">
                                                    <div class="position-absolute top-0 start-0 w-100"
                                                        style="height: 8px; background: linear-gradient(to right, #6f42c1, #cfe2ff); border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="d-flex flex-column">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="flex-grow-1">
                                                                    <h5 class="card-title mb-2 fw-bold text-dark mr-5">{{$job['title']}}</h5>

                                                                    <div class="mb-2">
                                                                        @php
                                                                            $created_at = Carbon::parse($job['created_at']);
                                                                        @endphp
                                                                        <span
                                                                            class="badge bg-success bg-opacity-10 text-success">
                                                                            Posted: <time datetime="{{ $created_at->toDateTimeString() }}">{{ $created_at->diffForHumans() }}</time>
                                                                        </span>
                                                                    </div>

                                                                    <div class="mt-2 small text-muted">
                                                                        <div class="d-flex align-items-center mb-1">
                                                                            @php
                                                                                $created_at = Carbon::parse($job['created_at']);
                                                                                $timeline = Carbon::parse($job['timeline']);
                                                                            @endphp
                                                                            <i class="bi bi-clock me-2"></i>
                                                                            Posted: <time datetime="{{ $created_at->toDateTimeString() }}">{{ $created_at->diffForHumans() }}</time>
                                                                        </div>
                                                                        <div class="d-flex align-items-center mb-1">
                                                                            <i class="bi bi-calendar-event me-2"></i>
                                                                            Needed by: <time datetime="{{ $timeline->toDateTimeString() }}">{{ $timeline->diffForHumans() }}</time>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="bi bi-currency-dollar me-2"></i>
                                                                            Budget: {{$job['budget']}}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="ms-3">
                                                                    <a href="{{route('client.job.detail', $job['id'])}}"
                                                                        class="btn btn-outline-primary d-inline-flex align-items-center">
                                                                        <i class="bi bi-eye me-2"></i>
                                                                        Manage Job Posting
                                                                    </a>
                                                                </div>
                                                                    {{-- @dd($job['proposals']['0']['status']) --}}
                                                                @if($job['proposals'] != null && count($job['proposals']) > 0)
                                                                    <div class="ms-3">
                                                                        <a href="{{route('client.jobs.proposal.list', $job['id'])}}"
                                                                            class="btn btn-outline-primary d-inline-flex align-items-center">
                                                                            <i class="bi bi-eye me-2"></i>
                                                                            Proposal
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="border-top mt-3 pt-3 small text-muted">
                                                                Waiting for expert proposals...
                                                            </div>
                                                        </div>
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
