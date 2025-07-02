
@extends('layouts.client-layout')


@section('css')

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
    <div class="container" style="min-width: 800px;">
  <!-- Back to Jobs -->
  <div class="mb-4">
    <a href="{{route('client.jobs')}}" class="btn btn-outline-secondary d-inline-flex align-items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
      </svg>
      <strong>Back to Jobs</strong>
    </a>
  </div>

  <!-- Card Container -->
  <div class="card shadow">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
          <h1 class="h3 fw-bold text-dark">Edit Your Job</h1>
          <p class="text-muted mb-0">Update the details of your HubSpot job below</p>
        </div>
        <form method="post" action="https://prfy-laravel-stg-95864fbb917b.herokuapp.com/client/jobs/remove/1257" onsubmit="return confirm('Are you sure you want to archive this job? This action cannot be undone.');">
          <input type="hidden" name="_token" value="H2zae32ORoe8zxLYDyv1GO2Tf3z2nyOis221rOYZ">
          <input type="hidden" name="_method" value="DELETE">
          <button type="submit" class="btn btn-outline-danger btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd"/>
            </svg>
            Archive Job
          </button>
        </form>
      </div>

      <!-- Job Form -->
      <form method="post" action="{{route('client.jobs.edit', $job->id)}}">
        @csrf
      

        <!-- Job Title -->
        <div class="mb-4">
          <label for="job_title" class="form-label fw-semibold">Job Title</label>
          <small class="text-muted d-block mb-2">Make it clear and attention-grabbing. This is what providers will see first.</small>
          <input type="text" class="form-control" id="job_title" name="title" value="{{$job->title}}" placeholder="e.g., HubSpot Email Marketing Campaign Setup">
        </div>

        <!-- Job Description -->
        <div class="mb-4">
          <label for="job_description_trix_input_job" class="form-label fw-semibold">Project Description</label>
          <small class="text-muted d-block mb-2">Detail your project needs, goals, and any specific requirements. The more detail, the better.</small>

          <!-- Hidden input and Trix editor -->
          <input id="job_description_trix_input_job" type="hidden" name="description" value=" {{$job->description}} ">
          <trix-editor input="job_description_trix_input_job" class="trix-editor"></trix-editor>
        </div>

        <div class="mb-4">
          <label for="job_desired_budget" class="form-label fw-semibold">Budget</label>
          <p class="form-text text-muted mb-2">
            Pros will take your overall budget range into consideration when submitting proposals for your job.
          </p>
          <input type="text" class="form-control" id="job_desired_budget" name="budget" placeholder="e.g. $75/hr - $100/hr, $3k - $5k, $5k - $10k" value=" {{$job->budget}} ">
        </div>

        <div class="mb-4">
          <label for="timeline" class="form-label fw-semibold">Timeline</label>
          <p class="form-text text-muted mb-2">
            When do you need this completed? Be specific about your deadline.
          </p>
          <input type="date" class="form-control shadow-sm" id="timeline" name="timeline" value="{{ Carbon\Carbon::parse($job->timeline)->format('Y-m-d') }}">
        </div>

        <!-- Submit Button -->
        <div class="text-end">
          <button type="submit" class="btn btn-primary">Update Job</button>
        </div>
      </form>
    </div>
  </div>
</div>
  </div>

 @endsection
