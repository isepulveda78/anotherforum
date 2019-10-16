<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>
    <div id="app">
    @include('partials.navigation')
    @auth 
        <main class="py-4">
            <div class="container">
                <div class="row">
          
                        <div class="col-md-4">
                        @auth 
                        <div class="d-flex justify-content-end mb-2">
                            <a href="{{ route('discussions.create') }}" class="btn btn-info btn-block">Add Discusion</a>
                        </div>
                        @else 
                        <div class="d-flex justify-content-end mb-2">
                            <a href="{{ route('login') }}" class="btn btn-info btn-block">Login</a>
                        </div>
                        @endauth
                            <ul class="list-group">
                                @foreach($channels as $channel)
                                        <li class="list-group-item"><a href="{{ route('discussions.index') }}?channel={{ $channel->slug }}">{{ $channel->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-8">
                                @yield('content')
                        </div>
                    </div>
                </div>
        </main>
    @else 
        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    @endauth
    </div>

       <!-- Scripts -->
       <script src="{{ asset('js/app.js') }}"></script>
       @yield('js')
</body>
</html>
