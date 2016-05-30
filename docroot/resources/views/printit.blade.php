<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $advert['title'] }}</title>
    <!-- Bootstrap Core CSS & Font-Awesome -->
    <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">


    <!-- jQuery -->
    <script src="{{ URL::asset('js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
    <link href="{{ URL::asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/jquery-ui.theme.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/jquery-ui.structure.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

    <!-- Custom CSS & Javascript -->
    <link href="{{ URL::asset('css/defaults.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/print.css') }}" rel="stylesheet">

    <script src="{{ URL::asset('js/elastic.js') }}"></script>
</head>

<body>
@yield('content')

<script type="text/javascript">
    $('textarea').elastic();
</script>
</body>
</html>
