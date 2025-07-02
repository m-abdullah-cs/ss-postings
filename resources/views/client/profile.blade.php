@extends('layouts.client-layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/client/profile.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header bg-success text-white">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">My Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content mt-4">
            <div class="container-fluid">
                <div class="row justify-content-evenly">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ $profile ? asset('storage/assets/profiles/' . $profile->picture) : asset('assets/images/default.jpg') }}"
                                class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="d-flex gap-3">
                                    <p class="card-title">Name:</p>
                                    <p class="card-text">{{ $user->name }}</p>
                                </div>
                                <div class="d-flex gap-3">
                                    <p class="card-title">Email:</p>
                                    <p class="card-text">{{ $user->email }}</p>
                                </div>
                                <div class="d-flex gap-3">
                                    @if ($profile)
                                        <p class="card-title">Headlines:</p>
                                        <p class="card-text">{{ $profile->headline }}</p>
                                    @endif
                                </div>


                                @if ($profile)
                                    <div class="d-flex gap-3">
                                        <p class="card-title">Skills:</p>

                                        <div class="flex flex-wrap gap-3">
                                            @foreach ($profile->skills as $skill)
                                                <span class="badge bg-primary">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif



                                <div class="d-flex gap-3">
                                    @if ($profile)
                                        <p class="card-title">Description:</p>
                                        <p class="card-text">{{ $profile->description }}</p>
                                    @endif
                                </div>

                                @if ($profile)
                                    <div>
                                        <a href="{{ $profile->linkedin_profile }}" target="_blank"
                                            class="btn btn-warning">Linkedin Profile</a>
                                        <a href="{{ $profile->website_url }}" target="_blank" class="btn btn-warning">Visit
                                            Website</a>
                                    </div>
                                @endif
                                <a href="{{ route('client.profile.edit', $user->id) }}" class="btn btn-primary">Edit
                                    Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection



@section('js')
    <script src="{{ asset('assets/js/provider/profile.js') }}"></script>
@endsection
