<!DOCTYPE html>
<html>
   <head>
      <title>@yield('title') - Grovery</title>
       <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      @include('common.admin.header_script')
   </head>
   <body>
      <div class="container-scroller">
         @include('common.admin.header')
         @yield('header')
         <div class="container-fluid page-body-wrapper">

            @include('common.admin.sidebar')
            <div class="main-panel">
               @include('common.admin.flash_message')
               @yield('content')
               @include('common.admin.footer')
            </div>
         </div>
      </div>
   </body>
   @include('common.admin.footer_script')
   @yield('footer_script')
</html>
