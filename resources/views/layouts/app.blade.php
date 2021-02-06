<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}"/>

    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .main-head {
            height: 150px;
            background: #FFF;
        }

        .sidenav {
            height: 100%;
            background-color: #000;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .main {
            padding: 0 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }
        }

        @media screen and (max-width: 450px) {
            .login-form {
                margin-top: 10%;
            }

            .register-form {
                margin-top: 10%;
            }
        }

        @media screen and (min-width: 768px) {
            .main {
                margin-left: 40%;
            }

            .sidenav {
                width: 40%;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
            }

            .login-form {
                margin-top: 35%;
            }

            .register-form {
                margin-top: 20%;
            }

            .login-main-text {
                margin-top: 35%;
            }
        }

        .login-main-text {
            /*margin-top: 10%;*/
            padding: 60px;
            color: #fff;
        }

        .login-main-text h2 {
            font-weight: 300;
        }

        .btn-black {
            background-color: #000 !important;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="sidenav">
    <div class="login-main-text">
        <h2>FutAmigos</h2>
    </div>
</div>
<div class="main">
    <div class="col-md-8 col-sm-12 py-4">
        @yield('content')
    </div>
</div>
<script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
</body>
</html>
