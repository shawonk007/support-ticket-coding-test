<aside id="sidebar" class="navbar navbar-expand-lg fixed-top" >
  <div class="container" >
    <a href="{{ route('dashboard') }}" class="navbar-brand text-white pb-lg-3" >
      <strong>{{ config('meta.name') }}</strong>
    </a>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" >
      <i class="fas fa-bars" ></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" >
      <ul class="nav nav-pills flex-column my-3" >
        <div class="profile flex-column" >
          <a href="javascript:void(0);" class="d-flex justify-content-center align-items-center" >
            <img src="{{ asset('img/avatar.png') }}" class="avatar rounded-circle p-1" alt="Avatar" />
          </a>
          <h4 class="text-center mt-4 mb-2" >{{ auth()->user()->name }}</h4>
          <h6 class="text-center mt-2 mb-4" >{{ ucfirst(auth()->user()->role) }}</h6>
          <div class="d-flex justify-content-between align-items-center mb-4" >
            <a href="javascript:void(0);" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View Profile" >
              <i class="fas fa-eye" ></i>
            </a>
            <a href="javascript:void(0);" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit Profile" >
              <i class="fas fa-edit" ></i>
            </a>
            <a href="javascript:void(0);" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Settings" >
              <i class="fas fa-cog" ></i>
            </a>
            <form method="POST" action="{{ route('logout') }}" >
              @csrf
              <a href="{{ route('logout') }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Logout" onclick="event.preventDefault();this.closest('form').submit();" >
                <i class="fas fa-power-off" ></i>
              </a>
            </form>
          </div>
        </div>
        <li class="nav-item" >
          <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="nav-link text-white @if ( $current === 'admin.dashboard' || $current === 'dashboard' ) active @endif" >
            <i class="fas fa-compass" style="width: 1rem;" ></i>
            <span class="ps-2" >{{ __('Dashboard') }}</span>
          </a>
        </li>
        <li class="nav-item" >
          <a href="{{ auth()->user()->role === 'admin' ? route('tickets.index') : route('tickets.customer') }}" class="nav-link text-white @if ( $current === 'tickets.index' || $current === 'tickets.customer' ) active @endif" >
            <i class="fas fa-ticket" style="width: 1rem;" ></i>
            <span class="ps-2" >{{ __('View Tickets') }}</span>
          </a>
        </li>
        @if ( auth()->user()->role === 'admin' )
          <li class="nav-item" >
            <a href="{{ route('users.index') }}" class="nav-link text-white @if ( $current === 'users.index' ) active @endif" >
              <i class="fas fa-users" style="width: 1rem;" ></i>
              <span class="ps-2" >{{ __('Users & Members') }}</span>
            </a>
          </li>
          <li class="nav-item" >
            <a href="{{ route('customers.index') }}" class="nav-link text-white @if ( $current === 'customers.index' ) active @endif" >
              <i class="fas fa-user-tag" style="width: 1rem;" ></i>
              <span class="ps-2" >{{ __('Customers') }}</span>
            </a>
          </li>
        @endif
        @if ( auth()->user()->role === 'customer' )
          <li class="nav-item" >
            <a href="javascript:void(0);" class="nav-link text-white" >
              <i class="fas fa-user-circle" style="width: 1rem;" ></i>
              <span class="ps-2" >{{ __('View Profile') }}</span>
            </a>
          </li>
          <li class="nav-item" >
            <a href="javascript:void(0);" class="nav-link text-white" >
              <i class="fas fa-user-edit" style="width: 1rem;" ></i>
              <span class="ps-2" >{{ __('Edit Profile') }}</span>
            </a>
          </li>
        @endif
        <li class="nav-item d-inline-block d-lg-none" >
          <form method="POST" action="{{ route('logout') }}" >
            @csrf
            <a href="{{ route('logout') }}" class="nav-link text-white bg-danger" onclick="event.preventDefault();this.closest('form').submit();" >
              <i class="fas fa-power-off" ></i>
            </a>
          </form>
        </li>
      </ul>
    </div>
  </div>
</aside>
