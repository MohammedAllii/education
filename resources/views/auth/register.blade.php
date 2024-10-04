@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-10">
            <div class="card border rounded shadow-lg">
                <div class="row no-gutters">
                    <!-- Form on the left -->
                    <div class="col-md-6 d-flex justify-content-center align-items-center p-5">
                        <div class="w-100">
                            <div class="card-header bg-primary text-white text-center">
                                {{ __('Register') }}
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="mb-4">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none d-md-flex justify-content-center align-items-center">
                        <img src="{{ asset('assets/img/register.avif') }}" alt="Register Image" class="img-fluid rounded" style="max-height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
