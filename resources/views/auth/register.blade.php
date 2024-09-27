<x-layouts.guest>

  <x-slot name="title" >{{ $title ?: __('Sample Page') }}</x-slot>

  <form method="POST" action="{{ route('register') }}" >
    @csrf
    <div class="row g-3" >
      <div class="col-12" >
        <div class="input-group mt-1" >
          <span class="input-group-text rounded-0" id="name-icon" >
            <i class="fas fa-user" ></i>
          </span>
          <input type="text" name="name" class="form-control rounded-0" id="name" placeholder="Enter your name" aria-label="name" aria-describedby="name-icon" />
        </div>
      </div>
      <div class="col-12" >
        <div class="input-group mt-1" >
          <span class="input-group-text rounded-0" id="email-icon" >
            <i class="fas fa-envelope" ></i>
          </span>
          <input type="email" name="email" class="form-control rounded-0" id="email" placeholder="Enter your email" aria-label="email" aria-describedby="email-icon" />
        </div>
      </div>
      <div class="col-12" >
        <div class="input-group mt-1" >
          <span class="input-group-text rounded-0" id="password-icon" >
            <i class="fas fa-key" ></i>
          </span>
          <input type="password" name="password" class="form-control rounded-0" id="password" placeholder="Enter your password" aria-label="password" aria-describedby="password-icon" />
        </div>
      </div>
      <div class="col-12" >
        <div class="input-group mt-1" >
          <span class="input-group-text rounded-0" id="cpassword-icon" >
            <i class="fas fa-key" ></i>
          </span>
          <input type="password" name="password_confirmation" class="form-control rounded-0" id="password_confirmation" placeholder="Confirm your password" aria-label="password_confirmation" aria-describedby="cpassword-icon" />
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary rounded-0 mt-4 w-100" >
      <span>{{ $title ?: __('Submit') }}</span>
    </button>
  </form>

  <x-slot name="bottom" >
    <p class="pb-0 mb-0" >
      <span>{{ __('Already have an account?') }}</span>
      <a href="{{ route('login') }}" class="text-muted" >
        <strong>{{ __('Login') }}</strong>
      </a>
    </p>
  </x-slot>

</x-layouts.guest>
