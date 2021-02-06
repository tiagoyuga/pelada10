<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    <title>Laravel</title>
    <!-- Fonts -->
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #333;
            font-family: Arial, Helvetica, sans-serif;
            height: 100vh;
            margin: 0;
            font-size: 80%;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            display: flex;
            justify-content: center;
        }

        #title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .position-ref {
            position: relative;
        }

        td {
            padding: 10px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @yield('content')
</div>
</body>
</html>
