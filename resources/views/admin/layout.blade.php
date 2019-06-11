<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
   {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="content">

    <div id="app">

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->


                        <li class="nav-item dropdown">


                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                </ul>
            </div>
        </div>
    </nav>

    <main class="ru-4 m-5">
        <div class="col-md-2">
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar col-md-60">
                <!-- Sidebar user panel -->
                <!-- search form -->



                <div class="ml-auto mt-5">
                    <a href="{{route('users.index')}}" class="btn btn-outline-secondary">Users</a>
                </div>

                <div class="ml-auto mt-5">
                    <a href="{{route('admin.questions.index')}}" class="btn btn-outline-secondary">Questions</a>
                </div>

                <div class="ml-auto mt-5">
                    <a href="{{route('categories.index')}}" class="btn btn-outline-secondary">Categories</a>
                </div>

                <div class="ml-auto mt-5">
                    <a href="{{route('admin.answers.index')}}" class="btn btn-outline-secondary">Answers<small class="answer-green">({{$AnswersCount}})</small></a>
                </div>

                <div class="ml-auto mt-5">
                    <a href="{{route('admin.settings')}}" class="btn btn-outline-secondary">Settings</a>
                </div>



            </section>
            <!-- /.sidebar -->
        </aside>
        </div>
        <div class="col-md-6">
        @yield('content')
        </div>
    </main>
    </div>
</div>

<!-- Scripts -->
<footer>
    @include('admin.footer')
</footer>
<script>
    window.Auth = {!! json_encode([
            'signedIn' => Auth::check(),
            'user' => Auth::user()
        ]) !!}
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="/js/admin.js"></script>
</body>
</html>
