<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel d-flex mb-2 mt-2">
        <div class="image">
         <!-- <img src="{{asset('assets/images/default.jpg')}}" class="img-circle elevation-2" alt="User Image">  -->
          <img src="{{$profile ? asset('storage/assets/profiles/'. $profile->picture) : asset('assets/images/default.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <!--   -->
        <div class="info align-items-center d-flex">
          <a href="#" class="d-block">{{($user) ?  $user->name : ''}}</a>
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
            <a href="{{route('client-dashboard')}}" class="nav-link {{ Route::is('client-dashboard') ? 'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item dropdown {{ Route::is('client.jobs.create', 'client.jobs') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is('client.jobs.create', 'client.jobs') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Jobs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview submenue">
              <li class="nav-item">
                <a href="{{route('client.jobs.create')}}" class="nav-link {{ Route::is('client.jobs.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('client.jobs')}}" class="nav-link {{ Route::is('client.jobs') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Job Listing</p>
                </a>
              </li>
            </ul>
          </li>



           <li class="nav-item">
            <a href="{{route('client.profile')}}" class="nav-link {{ Route::is('client.profile','client.profile.*') ? 'active' : ''}}">
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