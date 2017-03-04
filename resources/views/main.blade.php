<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._header')
  </head>
  <body>
    @include('partials._nav')
    <div class="container-fluid">
    @yield('content')
    </div>
    @include('partials._footer')
  </body>
</html>
