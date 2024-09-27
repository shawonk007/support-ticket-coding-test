<x-layouts.guest>

  <x-slot name="title" >{{ $title ?: __('Sample Page') }}</x-slot>

  <form method="POST" action="{{ route('login') }}" >
    @csrf
    <div class="row g-3" >
      <div class="col-12" >
        <label for="email" >
          <strong >{{ __('Email') }}</strong>
        </label>
        <div class="input-group mt-1" >
          <span class="input-group-text rounded-0" id="email-icon" >
            <i class="fas fa-envelope" ></i>
          </span>
          <input type="email" name="email" class="form-control rounded-0" id="email" placeholder="Enter your email" value="netcoden@gmail.com" aria-label="email" aria-describedby="email-icon" />
        </div>
      </div>
      <div class="col-12" >
        <label for="password" >
          <strong >{{ __('Password') }}</strong>
        </label>
        <div class="input-group mt-1" >
          <span class="input-group-text rounded-0" id="password-icon" >
            <i class="fas fa-key" ></i>
          </span>
          <input type="password" name="password" class="form-control rounded-0" id="password" value="12345678" placeholder="Enter your password" aria-label="password" aria-describedby="password-icon" />
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-between align-items-center my-3" >
      <div class="form-check" >
        <input type="checkbox" class="form-check-input" id="remember" />
        <label class="form-check-label" for="remember" >{{ __('Remember me') }}</label>
      </div>
      <a href="javascript:void(0);" >{{ __('Forgot password?') }}</a>
    </div>
    <button type="submit" class="btn btn-primary rounded-0 w-100" >
      <span>{{ $title ?: __('Submit') }}</span>
    </button>
  </form>

  <x-slot name="bottom" >
    <p class="pb-0 mb-0" >
      <span>{{ __('Need an account?') }}</span>
      <a href="{{ route('register') }}" class="text-muted" >
        <strong>{{ __('Register') }}</strong>
      </a>
    </p>
  </x-slot>

</x-layouts.guest>
