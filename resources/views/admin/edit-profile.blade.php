@extends('layouts.admin-layout')

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
                    <h3 class="card-title">Edit Profile</h3>
                    </div>
                    <!-- /.card-header -->
                    
                    <!-- form start -->
                    <form method="post" action="{{ route('admin.profile.editData', $profile->picture?? null) }}" enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">
                         <div class="form-group">
                          <input type="hidden" name="id" class="form-control" value="{{($profile)? $profile->id: ""}}">
                        </div>

                          <div class="form-group">
                          <label for="exampleInputEmail1">Name</label>
                          <input type="text" name="name" class="form-control" value="{{($user)? $user->name: ""}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Headline</label>
                          <input type="text" name="headline" class="form-control" value="{{($profile)? $profile->headline: ""}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Description</label>
                          <input type="text" name="description" class="form-control" value="{{($profile)? $profile->description: ""}}">
                        </div>


                        <div class="form-group">
                          <label for="exampleInputEmail1">linkedin profile</label>
                          <input type="text" name="linkedin_profile" class="form-control" value="{{($profile)? $profile->linkedin_profile: ""}}">
                        </div>

                         <div class="form-group">
                          <label for="exampleInputEmail1">website url</label>
                          <input type="text" name="website_url" class="form-control" value="{{($profile)? $profile->website_url: ""}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Skills</label>
                          <input type="text" name="skills" id="demo" value="{{($profile)? $profile->skills: ""}}" class="form-control" placeholder="Enter skills" data-role="tagsinput">
                        </div>

                        @if ($profile)
                          <div class="form-group">
                            <label for="exampleInputPassword1">Profile Picture</label>
                            <img src="{{asset('storage/assets/profiles/'.$profile->picture) }}" alt="" style="width: 100px; height: 100px;">
                            {{-- <img src="{{asset('assets/images/default.jpg')}}"> --}}
                            <input type="file" name="profile-pic" class="form-control">
                          </div> 
                        @else

                        <div class="form-group">
                            <label for="exampleInputPassword1">Profile Picture</label>
                            <input type="file" name="profile-pic" class="form-control">
                          </div> 
                        @endif

                      </div>
                    <!-- /.card-body -->
        
                      <div class="card-footer">
                        <input type="submit" name="submit" class="btn btn-primary" value="Update Profile">
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


@section('js')
  <script>

      $('#demo').tagEditor();

      $('form').on('keydown', function(e) {
        if (e.key === 'Enter' && $(e.target).is('input')) {
          e.preventDefault();
        }
      });


    
  </script>
@endsection