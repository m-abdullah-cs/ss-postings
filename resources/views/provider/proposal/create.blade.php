@extends('layouts.provider-layout')

@section('css')
  <style>
    trix-editor {
      min-height: 200px;
      overflow-y: auto;
      display: block;
      border: 1px solid #ced4da;
      border-radius: 0.375rem; /* matches Bootstrap's rounded */
      padding: 0.75rem;
      font-size: 1rem;
    }

    trix-editor:focus {
      outline: none;
      border-color: #86b7fe;
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25); /* bootstrap-style focus */
    }

    /* Optional: Placeholder support */
    trix-editor:empty:not(:focus)::before {
      content: "Start typing your proposal...";
      color: #999;
    }
  </style>

@endsection

@section('content')
<div class="content-wrapper">
    <div class="container py-5">
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h1>New Proposal</h1>
          <form action="{{ route('provider.jobs.proposal.store', $job->id) }}" method="post">
            @csrf

            <div class="mb-4">
              <label class="form-label">Tell us why you're perfect for this job.</label>
              <small class="form-text text-muted">Share your expertise, relevant experience, and how you'll tackle this project. The more specific you are, the better your chances!</small>
              <input type="hidden" name="description" id="description">
              <trix-editor input="description" class="form-control mt-2"></trix-editor>
            </div>

            <div class="mb-4">
              <label for="price" class="form-label">Your Price</label>
              <small class="form-text text-muted">Set a competitive price that reflects the value and scope of your work.</small>
              <div class="input-group mt-2">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control" name="your_price" id="price" min="0" step="0.01" placeholder="0.00">
                <span class="input-group-text">USD</span>
              </div>
            </div>

            <div class="mb-4">
              <label for="deposit" class="form-label">Required Deposit</label>
              <small class="form-text text-muted">Choose how you'd like to structure the payment for this project.</small>
              <select class="form-select mt-2" id="deposit" name="required_deposit">
                <option value="0">None</option>
                <option value="1" selected>Half up-front</option>
                <option value="2">All up-front</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Create Proposal</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card sticky-top" style="top: 2rem;">
        <div class="card-body">
          <h2>Job Details</h2>
          <h3 class="mt-3">{{$job->title}}</h3>
          <span class="badge bg-primary text-light px-3 py-2 mx-5 rounded-full inline-flex">Open</span>

          <div class="text-muted">
            <p class="mb-2"><i class="bi bi-clock me-2"></i>Timeline: {{ $job->created_at->diffForHumans() }}</p>
            <p><i class="bi bi-people me-2"></i>0 proposals submitted</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection