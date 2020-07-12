@extends('layouts.app', ['use_recaptcha' => true])

@section('content')
<div class="container h-100" id="login">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-md-5 col-lg-4">
            <div class="card bg-light border-0 shadow-none">
                <div class="card-body">
                    <h3 class="card-title text-center">{{ __('Uh oh!') }}</h3>
                    <p class="text-center">{{__("Don't worry, we can send you a link.")}}</p>

                    <form method="POST" action="{{ route('password.request') }}" id="reset-form">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center w-100 mt-2">
                        <a href="{{ url()->previous() }}" class="btn-back"> <i class="fas fa-long-arrow-alt-left"></i>
                            {{__("Return back")}} </a>
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
