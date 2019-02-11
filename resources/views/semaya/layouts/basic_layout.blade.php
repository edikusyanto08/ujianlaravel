<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Semaya</title>
    @include('semaya.layouts.main_asset')
  </head>
  <body class="grey lighten-4">
    <div class="navbar-fixed">
     <nav class="blue accent-4">
       <div class="nav-wrapper container">
         <a href="{{ route('home') }}" class="brand-logo">Semaya</a>
         <ul class="right hide-on-med-and-down">
           <li class="waves-effect waves-light"><a href="{{ route('home') }}">Halaman Awal</a></li>
         </ul>
       </div>
     </nav>
   </div>
   <div class="container">
     <div class="row">
       <div class="col s12 m12 l12">
         @yield('content')
       </div>
     </div>
   </div>
  </body>
</html>
