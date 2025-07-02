

<div>

  <li class="nav-item dropdown">
    @if($notificationSMS)
      @foreach ($notificationSMS as $SMS)
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"></span>
          <div class="dropdown-divider"></div>
             <a href="" class="dropdown-item d-flex">
              <i class="fas fa-envelope mr-2"></i><strong>New Message From:</strong>
              <span class="text-end text-muted text-sm">{{ $SMS['sender']['name'] }}</span>
            </a>
        </div>
      @endforeach
    @endif
  </li>
    
</div>






