<header>

   
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                
                <button class="navbar-toggler ml-auto" type="button" style="color:black;" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span style="color:black;" class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto" >
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: 20px; color:black;"  href="{{ route('login') }}">{{ __('Trattamenti') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: 20px;color:black;" href="{{ route('login') }}">{{ __('Chi siamo') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: 20px;color:black;" href="{{ route('login') }}">{{ __('Contatti') }}</a>
                        </li>
                    </ul>
                    <!-- Center Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        <li>
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" style="font-size: 20px;" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" style="font-size: 20px; color:pink;" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" style="font-size: 20px; t;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span style="color:black;" >{{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profilo', Auth::user() -> id) }}">{{ __('Profilo') }}</a>
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

</header>