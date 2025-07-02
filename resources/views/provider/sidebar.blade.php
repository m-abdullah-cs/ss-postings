<?php
use App\Models\User;
    // $user = auth()->user();
    //     $profile = $user->profile; 
    //     dd($profile); 
    $user = auth()->user();
        // $profile = $user->profile;
        $profile=User::LeftJoin('Profiles', 'users.id', '=', 'profiles.user_id')
        ->select(   'profiles.*')
        ->where('users.id', $user->id)
        ->first();
?>


<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel d-flex mb-2 mt-2">
      <div class="image">
        <img src="{{($profile)? asset('storage/assets/profiles/'. $profile->picture):    asset('assets/images/default.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info align-items-center d-flex">
        <a href="#" class="d-block">{{($user) ? $user->name: ''}}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             <li class="nav-item">
              <a href="{{route('provider-dashboard')}}" class="nav-link {{Route::is('provider-dashboard') ? 'active' : ''}}">
                <i class="nav-icon fas fa-th"></i>
                <p>Dashboard</p>
              </a>
            </li>

        <li class="nav-item">
          <a href="{{route('provider.jobs')}}" class="nav-link {{ Route ::is('provider.jobs*') ? 'active': ''}}">
            <i class="fas fa-tree"></i>
            <p>
              Jobs
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('provider.profile')}}" class="nav-link {{ Route::is('provider.profile*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>
              My Profile
            </p>
          </a>
        </li>
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>