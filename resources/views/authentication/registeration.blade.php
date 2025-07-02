<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="{{asset('assets/css/registeration.css')}}">

    <!-- MDB v6 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />


  </head>
  <body style="height: 200px;">
    <section class="h-100 h-custom" style="background-color: #8fc4b7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img3.webp"
                            class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                            alt="Sample photo">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Registration Info</h3>

                            <form class="px-md-2" method="POST" action="{{route('register-data')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline datepicker">
                                            <input type="text" name="name" class="form-control" id="exampleDatepicker1" />
                                            <label for="exampleDatepicker1" class="form-label">Name</label>
                                        </div>
                                        @error('name')
                                            <div class="text-danger">
                                            {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline datepicker">
                                            <input type="text" name="email" class="form-control" id="exampleDatepicker1" />
                                            <label for="exampleDatepicker1" class="form-label">Email Address</label>
                                        </div>
                                        @error('email')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="password" name="password" id="form3Example1q" class="form-control" />
                                            <label class="form-label" for="form3Example1q">Password</label>
                                        </div>
                                        @error('password')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                              
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" name="password_confirmation" id="form3Example1q" class="form-control" />
                                    <label class="form-label" for="form3Example1q">Confirm Password</label>
                                </div>

                                <div class="mb-4">
                                    <select data-mdb-select-init class="form-select" name="role">
                                        <option value="1" disabled>Type</option>
                                        <option value="client">Client</option>
                                        <option value="provider">Provider</option>
                                    </select>
                                </div>

                                <input type="submit" name="submit" class="btn btn-success btn-lg mb-1" value="SignUp">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- MDB v6 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
  </body>
</html>