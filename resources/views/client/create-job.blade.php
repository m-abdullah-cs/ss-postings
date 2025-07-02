@extends('layouts.client-layout')


@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
          <div class="row justify-content-evenly">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">{{isset($job) ? "Update Form" : "Create Job"}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ isset($job) ? route('client.update-job-data') : route('client.create-job-data') }}">
                      @csrf
                      <div class="card-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="title" class="form-control" value="{{isset($job) ? $job->title : ''}}">
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Description</label>
                          <div class="form-floating">
                            
                            <textarea class="form-control" name="description" placeholder="Leave a comment here">{{isset($job)? $job->description : ''}}</textarea>
                            <label for="floatingTextarea">Comments</label>
                          </div>
                        </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Budget</label>
                            <input type="text" name="budget" class="form-control" value="{{isset($job)? $job->budget : ''}}">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Timeline</label>
                            <input type="date" name="timeline" class="form-control" value="{{ isset($job)? Carbon\Carbon::parse($job->timeline)->format('Y-m-d') : ''}}">
                          </div>

                      </div>
                    <!-- /.card-body -->
        
                      <div class="card-footer">
                          <button type="submit" class="btn btn-primary">{{isset($job)? "Update": "Create"}}</button>
                      </div>
                    </form>
                </div>

                <!-- /.card-body -->
            </div>
              <!-- /.card -->
              <!-- general form elements disabled -->
              
              <!-- /.card -->
            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>

@endsection