<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'User Management System') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" >

        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body >
    <!-------------------------- NAV BAR ------------------------------------->
    <nav class="navbar navbar-expand-lg">
    <div class="container">
  <div class="container-fluid">
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <a class="navbar-brand" href="#">User Management System</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

        <li class="nav-item">
      
        </li>
        <li class="nav-item">
         
        </li>
       </ul>

       <div >
            @if (Route::has('login'))
                <div >
                    @auth
                        <a href="{{ url('/home') }}" >Home</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                     @csrf
                 </form>
                    @else
                        <a href="{{ route('login') }}" >Log in</a>

                        @if (Route::has('register'))
                            <!-- <a href="{{ route('register') }}">Register</a> -->
                           <a href="/register-user">Register</a> 
                        @endif
                    @endauth
                </div>
            @endif
    </div>
      <div class="d-flex">
        
      </div>
      </div>
</nav>
<!------------------------------------------------------------------------------>

@can('logged-in')
<nav class="navbar sub-nav navbar-expand-lg">
    <div class="container">
  
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        @can('is-admin')
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
        </li>
        @endcan
       </ul>
        
      </div>
      </div>
</nav>
@endcan


 <!-------------------------- NAV BAR ENDS ------------------------------------->
   

    <main class="container">
      @include('partials.alerts')
        @yield('content')
    </main>
    </body>
</html>
