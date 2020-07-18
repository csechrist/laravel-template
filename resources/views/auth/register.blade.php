@extends('layouts.app', ['use_recaptcha' => true])

@section('content')
<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-md-5 col-lg-4">
            <div class="card bg-light border-0 shadow-none">
                <div class="card-body">
                    <h3 class="card-title text-center">{{ __('Register') }}</h3>
                    <p class="text-center">{{__('Get started with your free account')}}</p>

                    @if(config('auth.oauth_providers.twitter'))
                    <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   {{__('Register via
                        Twitter')}}</a>
                    @endif

                    @if(config('auth.oauth_providers.facebook'))
                    <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   {{__('Register via
                        Facebook')}}</a>
                    @endif

                    @if(config('auth.oauth_providers.google'))
                    <a href="" class="btn btn-block btn-google"> <i class="fab fa-google"></i>   {{__('Register via
                        Google')}}</a>
                    @endif

                    @if(config('auth.oauth_providers.google') || config('auth.oauth_providers.twitter') ||
                    config('auth.oauth_providers.facebook'))
                    <p class="divider-text">
                        <span class="bg-light">OR</span>
                    </p>
                    @endif

                    <form method="POST" action="{{ route('register') }}" id="register-form">
                        @csrf

                        <div class="form-label-group">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                placeholder="{{ __('Name') }}">
                            <label for="name">{{ __('Name') }}</label>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="{{ __('Email') }}">
                            <label for="email">{{ __('Email') }}</label>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="{{ __('Password') }}">
                            <label for="password">{{ __('Password') }}</label>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input id="confirm-password" type="password" class="form-control "
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="{{ __('Confirm Password') }}">
                            <label for="confirm-password">{{ __('Confirm Password') }}</label>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="hidden" name="recaptcha" id="recaptcha">

                                @error('recaptcha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-block" type="submit">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center w-100 mt-2">
                        <a href="{{ route('login') }}" class="btn-back"><i class="fas fa-long-arrow-alt-left"></i> Back
                            to
                            Login </a>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('js')
    @if(config('services.recaptcha.enabled'))
    <script>
        $(function () {
            document.getElementById("register-form").addEventListener('submit', function (e) {
                e.preventDefault();
                grecaptcha.ready(function () {
                    grecaptcha.execute("{{ config('services.recaptcha.site_key') }}", {
                        action: 'register'
                    }).then(function (token) {
                        if (token) {
                            console.log(token);
                            document.getElementById('recaptcha').value = token;
                            document.getElementById("register-form").submit();
                        }
                    });
                });
                return false;
            })

        })

    </script>
    @endif
    @endsection
