<html>
   <head>
      <title>@yield('title') - Grovery  </title>
      @include('common.admin.header_script')
   </head>
   <body>
    @yield('content')
   </body>
   @include('common.admin.footer_script')
   @yield('footer_script')
</html>