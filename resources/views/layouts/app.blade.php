<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{-- We setup the layout styles --}}

<head>
    @laravelPWA

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('UJATCARE', 'UJATCARE') }}</title>

    {{-- STYLE --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            <!-- Fonts -->
        
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,700,900&amp;subset=latin-ext" rel="stylesheet">
</head>
    

<body>
    <main id="app">
        @section('main')
        @show 
    </main>   
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>


</html>
