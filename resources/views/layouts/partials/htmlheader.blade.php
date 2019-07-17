<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    {{-- icono --}}
    <link rel="icon" href="{{ url('/storage/images/inicio.jpeg') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome-5.2.0/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/select2/dist/css/select2.min.css') }}" rel="stylesheet" />

    
    <style>body{background-color: #2a323cff;}</style>
</head>