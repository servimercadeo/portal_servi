<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">


        <!-- Scripts -->
        @routes
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="bg-light" style="{{ (Auth::check()&&!Auth::user()->hasRole('admin')) ? 'background-image: url('.asset('imgs/fondo.jpg').') !important;':'' }}">
        @inertia

        @env ('local')
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv
    </body>
    <footer class="text-center text-white bg-blue">
        <div class="container pt-4">
            <section class="mb-2">
                <a href="https://www.facebook.com/ServimercadeoColombia/" role="button" data-mdb-ripple-color="dark" class="btn btn-link btn-floating btn-lg text-white m-1">
                    <i class="icon-facebook-sign"></i>
                </a>
                <a href="https://www.instagram.com/servimercadeo_/" role="button" data-mdb-ripple-color="dark" class="btn btn-link btn-floating btn-lg text-white m-1">
                    <i class="icon-instagram"></i>
                </a>
                <a href="https://www.linkedin.com/company/servimercadeo-sas/" role="button" data-mdb-ripple-color="dark" class="btn btn-link btn-floating btn-lg text-white m-1">
                    <i class="icon-linkedin"></i>
                </a>
            </section>
        </div>
        <p class="text-white fs-5 m-0">© 2022 Copyright Servimercadeo</p>
    </footer>
</html>
