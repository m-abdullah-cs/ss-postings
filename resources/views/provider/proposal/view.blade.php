@extends('layouts.provider-layout')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/provider/proposal/view.css') }}">

<style>
    .btn-outline-danger:hover {
      background-color: #f8d7da;
    }
    .trix-editor {
      min-height: 200px;
      border: 1px solid #ced4da;
      border-radius: .375rem;
      padding: 0.75rem;
    }
  </style>

@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="mt-4 p-4 p-sm-5">
                        <a href="{{ route('provider.jobs') }}"
                            class="btn btn-outline-secondary d-inline-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" width="16" height="16" class="me-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                            </svg>
                            <strong>Back to Jobs</strong>
                        </a>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="p-4 p-sm-5">
                        <div class="d-sm-flex align-items-start gap-3">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-1"><strong>Proposal By:</strong> {{ $user->name }}</p>
                                <h3 class="h4 fw-bold text-dark mb-3">{{ $job->title }}</h3>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="border rounded p-3 bg-light">
                                <p>{!! $proposal->description !!}</p>
                            </div>
                        </div>
                        
                        <a class="btn btn-outline-primary mb-4"
                            href="{{route('provider.jobs.detail', $job->id)}}" target="_blank">
                            View Original Job Posting
                        </a>

                        <hr class="my-4">

                        <div class="mt-4">
                            <h3 class="h4 fw-semibold mb-4">Messages</h3>
                            {{-- @dd($receiver) --}}
                            {{-- <livewire:chat :user_id="$receiver" />   --}}
                            @livewire('chat-component', ["user_id" => $receiverid, "job_id" => $job->id, "proposal_id" => $proposal->id])
                        </div>
                    </div>
                </div>
                {{-- 000000000000000000000000 --}}
                <div class="col-md-4">
                    <div class="border-top p-4 p-sm-5">
                        <div class="card text-center bg-light border">
                            <div class="card-body px-4">
                                <p class="text-secondary fw-semibold mb-3">Proposal Bid:</p>
                                <div class="d-flex justify-content-center align-items-baseline mb-3">
                                    <span class="display-4 fw-semibold text-dark">{{ $proposal->your_price }}</span>
                                    <span class="ms-2 text-muted fw-semibold">USD</span>
                                </div>
                                <p class="text-muted small mb-3">
                                    Payment terms:
                                    @if ($proposal->required_deposit == 0)
                                        <span class="fw-semibold text-dark">Deposit Required</span>
                                    @elseif($proposal->required_deposit == 1)
                                        <span class="fw-semibold text-dark">50% Payment Required</span>
                                    @else
                                        <span class="fw-semibold text-dark">Whole Payment required before</span>
                                    @endif
                                </p>

                                <p class="fw-semibold text-muted mb-1">Status</p>
                                <span class="badge rounded-pill bg-warning text-dark">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 0.6rem;"></i>
                                    @if ($proposal->status == 0)
                                        <span class="fw-semibold text-dark">Pending</span>
                                    @elseif($proposal->status == 1)
                                        <span class="fw-semibold text-dark">In-Progress</span>
                                    @else
                                        <span class="fw-semibold text-dark">Completed</span>
                                    @endif
                                </span>

                                <a href="https://prfy-laravel-stg-95864fbb917b.herokuapp.com/provider/jobs/1026/proposal/761/edit"
                                    class="btn btn-outline-primary mt-4 w-100">
                                    Edit This Proposal
                                </a>
                            </div>
                        </div>

                        <!-- Activity Feed -->
                        <section class="mt-4 mt-xl-5">
                            <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">Activity Feed</h5>
                            <ul class="list-unstyled">
                                <li class="mb-4">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3 position-relative">
                                            {{-- <img src="{{ asset('assets/images/default.jpg') }}" class="rounded-circle border border-white" width="48" height="48" alt="Profile Image"> --}}
                                            <img src="{{ $userProfile == null ? asset('assets/images/default.jpg') : asset('storage/assets/profiles/' . $userProfile->picture) }}"
                                                class="rounded-circle border border-white" width="48" height="48"
                                                alt="Profile Image">
                                            <span class="position-absolute bottom-0 end-0 bg-white rounded-circle p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary"
                                                    width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 0 0 1.28.53l3.58-3.579a.78.78 0 0 1 .527-.224 41.202 41.202 0 0 0 5.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0 0 10 2Zm0 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM8 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm5 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-1 fw-semibold text-dark">{{ $user->name }}</p>
                                            <small class="text-muted d-block">
                                                Proposal Submitted
                                                <time
                                                    title="March 21, 2025 at 4:46pm PST">{{ $proposal->created_at->diffForHumans() }}</time>
                                            </small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')

    <script>
        console.log("Hello from view proposal page");
        $.ajax({
            url:
                '/provider/change-message-status',

            type: "GET",
            success: function (data) {
                let x = JSON.stringify(data);
                console.log(x);
            },
            error: function (xhr, status, error) {
                console.log("XHR Response:", xhr.responseText);
                console.log("Status:", status);
                console.log("Error:", error);
            }
        });
    </script>

@endsection



