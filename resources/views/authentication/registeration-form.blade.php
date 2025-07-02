<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    {{-- bootstrap icons cdn --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/registeration-form.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <form action="{{route('register-data')}}" method="POST" class="mt-5">
            @csrf
            <legend class="text-center">Registration</legend>
            <div class="row mb-3">
              <div class="col-md-12 fields">
                <div class="icon">
                  <i class="bi bi-envelope"></i>
                </div>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name" value="{{old('name')}}">
              </div>
              @error('name')
                <div class="text-danger">
                  {{$message}}
                </div>
              @enderror
              <div class="row mb-3">
                <div class="col-md-12 fields">
                  <div class="icon">
                    <i class="bi bi-envelope"></i>
                  </div>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{old('email')}}">
                </div>
                @error('email')
                  <div class="text-danger">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="row mb-3">
                <div class="col-md-12 fields">
                  <div class="icon">
                    <i class="bi bi-microsoft"></i>
                  </div>
                  <input type="password" class="form-control" id="pssword" name="password" placeholder="Enter your password">
                </div>
                @error('password')
                  <div class="text-danger">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="row mb-3">
                <div class="col-md-12 fields">
                  <div class="icon">
                  <i class="bi bi-microsoft"></i>
                  </div>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Confirm password">
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-12 fields">
                  <div class="icon">
                  <i class="bi bi-microsoft"></i>
                  </div>
                  <select name="role" class="form-select">
                    <option value="">Select to choose</option>
                    <option value="client">Client</option>
                    <option value="provider">Provider</option>
                  </select>
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-md-5">
                  <input type="submit" class="btn btn-primary w-50">
                </div>
              </div>
          </form> 
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>