@extends('layouts.app', ['use_recaptcha' => true])

@section('content')
<div class="container h-100" id="login">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-md-5 col-lg-4">
            <div class="card bg-light border-0 shadow-none">
                <div class="card-body">
                    <h3 class="card-title text-center">{{ __('Welcome back!') }}</h3>
                    <p class="text-center">{{__('Login to keep working')}}</p>

                    @if(config('auth.oauth_providers.twitter'))
                    <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   {{__('Login via
                        Twitter')}}</a>
                    @endif

                    @if(config('auth.oauth_providers.facebook'))
                    <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   {{__('Login via
                        Facebook')}}</a>
                    @endif

                    @if(config('auth.oauth_providers.google'))
                    <a href="{{ route("provider.auth", ['provider' => 'google']) }}" class="btn btn-block btn-google">
                        <i class="fab fa-google"></i>
                          {{__('Login via
                        Google')}}</a>
                    @endif

                    @if(config('auth.oauth_providers.google') || config('auth.oauth_providers.twitter') ||
                    config('auth.oauth_providers.facebook'))
                    <p class="divider-text">
                        <span class="bg-light">OR</span>
                    </p>
                    @endif

                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf

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
                                autocomplete="password" aria-describedby="passwordHelp"
                                placeholder="{{__('Password')}}">
                            <label for="password">{{ __('Password') }}</label>

                            <small id="passwordHelp" class="form-text text-muted"><a
                                    href="{{ route('password.request') }}" class="forgot-link">Reset
                                    Password</a></small>


                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center w-100 mt-2">
                        <a href="{{ route('register') }}" class="btn-back">{{__("Need an account?  Register")}} </a>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> @endsection @section('js') <script>
        $(function () {
            function onSubmit(token) {
                document.getElementById("register-form").submit();
            }
        })

    </script>
    @endsection
