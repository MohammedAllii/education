@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-10"> <!-- Increased the container width to lg-10 -->
            <div class="card border rounded shadow-lg">
                <div class="row no-gutters">
                    <!-- Form on the left -->
                    <div class="col-md-6 d-flex justify-content-center align-items-center p-5"> <!-- Increased padding for more space -->
                        <div class="w-100">
                            <h1 class="text-black text-center">
                                {{ __('Login') }}
                            </h1>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-4">
                                        <label for="email" class="form-label">{{ __('Email Address') }}</label> <!-- Changed to form-label -->
                                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <!-- Added form-control-lg for larger input -->

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="password" class="form-label">{{ __('Password') }}</label> <!-- Changed to form-label -->
                                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <!-- Added form-control-lg for larger input -->

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Image on the right -->
                    <div class="col-md-6 d-none d-md-flex justify-content-center align-items-center">
                        <img src="{{ asset('assets/img/login.avif') }}" alt="Login Image" class="img-fluid rounded" style="max-height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
