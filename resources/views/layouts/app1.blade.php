<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Dekhtamasha') }}</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- custom css -->
        <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
        <!-- font waesome -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>
    <body>
        <nav class="navbar navbar-expand-md custom-nav-color shadow-sm" >
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('image/logo-icon.png')}}" width="157px;" height="50px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <i class="fas fa-bars" style="color: white;"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto nav-font-size">
                        <li class="nav-item">
                            <a href="{{route('user.getIndex')}}" class="nav-link">All Video</a>
                        </li>
                        @if(isset($categories) && count($categories)>0)
                        @foreach($categories as $category)
                        <li class="nav-item">
                            <a href="{{route('user.getVideoWithCategory', $category->id)}}" class="nav-link">{{$category->title}}</a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto nav-font-size">
                        <li class="nav-item mb-1">
                            <a href="#" class="nav-link btn-primary mr-2">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item mr-2 mb-1">
                            <a class="nav-link btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        @if (Route::has('register'))
                        <li class="nav-item mr-2">
                            <a class="nav-link btn-primary" href="{{ route('register') }}">{{ __('Signup for free') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle bg-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="border-radius5px;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right bg-danger" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="ml-3 mr-3">
            <div class="row">
                <div class="container-fluid">
                    <div class="scrolling-wrapper row flex-row flex-nowrap mt-4 pb-4 pt-2">    
                        @if(isset($playlists) && count($playlists)>0)      
                        @foreach($playlists as $playlist)
                         <div class="col-md-4 col-6 col-lg-4 col-sm-6 col-xs-6 col-xl-3">
                            <a href="{{route('user.getVideoWithPlaylist', $playlist->id)}}"><div class="card card-block card-1" style="color:black;"><center>{{$playlist->title}}</center></div></a>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
        <style type="text/css">
        .scrolling-wrapper{
        overflow-x: auto;
        }
        .subtitle{
        font-size: 1.25em;
        opacity: 0.65;
        }
        .card-block{
        height: 25px;
        background-color: #fff;
        border: none;
        background-position: center;
        background-size: cover;
        transition: all 0.2s ease-in-out !important;
        border-radius: 24px;
        &:hover{
        transform: translateY(-5px);
        box-shadow: none;
        }
        }
        .card-1{
        background-color: #4158D0;
        background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
        }
        </style>
        <script src="{{ asset('light-bootstrap/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
        <!-- <script type="text/javascript" src="{{asset('js/front-customjs.js')}}"></script> -->
        @yield('scripts')
    </body>
</html>