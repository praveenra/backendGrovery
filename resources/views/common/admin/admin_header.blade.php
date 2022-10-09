@section('header')
<style>
   .sidebar .nav .nav-item.active > .nav-link .menu-title {
   color: #15549a;
   font-family: "ubuntu-medium", sans-serif;
   }
   .sidebar .nav.sub-menu .nav-item .nav-link.active {
   color: #15549a;
   background: transparent;
   }
   .sidebar .nav .nav-item.active > .nav-link i {
   color: #15549a;
   }
</style>
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
   <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="{{url('/superadmin/dashboard')}}">Grovery</a>
      <a class="navbar-brand brand-logo-mini" href="{{url('/superadmin/dashboard')}}"><img src="{{asset('public/admin/images/Grovery.png')}}" alt="logo"/></a>
   </div>
   <div class="navbar-menu-wrapper d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right">
         <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
               <div class="nav-profile-img">
                  <img src="{{asset('public/admin/images/Grovery.png')}}" alt="image">
                  <span class="availability-status online"></span>
               </div>
               <div class="nav-profile-text">
                  <p class="mb-1 text-black">{{auth()->guard('admin')->user()->first_name}} {{auth()->guard('admin')->user()->last_name}}</p>
               </div>
            </a>
			
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
               <a class="dropdown-item" href="{{url('admin/log_history')}}">
               <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
               <div class="dropdown-divider"></div>

               <a class="dropdown-item" href="{{url('/profile_detail')}}">Profile Detail</a>
               <!-- <a class="dropdown-item" href="{{url('/profile')}}">Profile Image</a> -->
               <a class="dropdown-item" href="{{url('/change-password')}}">Change Password</a>
    					 <a class="dropdown-item" href="{{url('/adminlogout')}}">
               <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
            </div>
         </li>
      </ul>


      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
      </button>
   </div>
</nav>
@endsection