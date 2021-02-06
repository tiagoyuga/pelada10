@extends('layouts.app')

@section('content')
    <script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous"></script>
    <div class="login-form">

        @if($errors->any())
            <div class="alert alert-danger dev-mod">
                <li>{{ $errors->first() }}</li>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input id="password" type="password"
                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                       value="12345678" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

            </div>
            <button type="submit" class="btn btn-black">Entrar</button>
            <a href="{{ route('social-auth-google') }}" class="btn btn-google-plus btn-danger">Login via Google</a>

            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                    Esqueceu sua senha?
                </a>
            @endif

            {{-- auth social--}}
            {{--<form>
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        --}}{{--<a href="{{ url('/login/facebook') }}" class="btn btn-facebook btn-primary"> Facebook</a>--}}{{--
                        --}}{{--<a href="{{ url('/login/google') }}" class="btn btn-google-plus btn-danger">Login via Google</a>--}}{{--
                        <a href="{{ route('social-auth-google') }}" class="btn btn-google-plus btn-danger">Login via Google</a>
                    </div>
                </div>
            </form>--}}


        </form>
    </div>
@endsection
