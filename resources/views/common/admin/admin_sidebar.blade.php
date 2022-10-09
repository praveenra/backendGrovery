<?php
  $user_permissions = auth()->guard('admin')->user()->permissions()->pluck('name');
?>
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
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
          <a href="{{url('admin/dashboard')}}" class="nav-link">
             <div class="nav-profile-image">
                <img src="{{asset('public/admin/images/Grovery.png')}}" alt="profile">
                <span class="login-status online"></span>
                <!--change to offline or busy as needed-->
             </div>
             <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2">Grovery</span>
                <span class="text-secondary text-small">
                  {{auth()->guard('admin')->user()->first_name}} {{auth()->guard('admin')->user()->last_name}}
                </span>
             </div>
             <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
          </a>
      </li>

      <li class="nav-item">
            <a class="nav-link" href="{{url('admin/dashboard')}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
       </li>
       <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
              <span class="menu-title">Masters</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-image"></i>
          </a>
          <div class="collapse" id="ui-basic2">
            <ul class="nav flex-column sub-menu">
              @if($user_permissions->contains('city'))
               <li class="nav-item"> <a class="nav-link" href="{{url('admin/cityadmin')}}">Cities</a></li>
              @endif
              @if($user_permissions->contains('area'))
               <li class="nav-item"> <a class="nav-link" href="{{url('admin/areaadmin')}}">Areas</a></li>
              @endif
              @if($user_permissions->contains('main_category'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/maincategoryadmin')}}">Main Categories</a></li>
              @endif
              @if($user_permissions->contains('category'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/categoryadmin')}}">Categories</a></li>
              @endif
              @if($user_permissions->contains('sub_category'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/subcategoryadmin')}}">Sub Categories</a></li>
              @endif
              @if($user_permissions->contains('sub_sub_category'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/subsubcategory')}}">Sub Sub Categories</a></li>
              @endif
              @if($user_permissions->contains('products'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/productsadmin')}}">Products</a></li>
              @endif
              @if($user_permissions->contains('brand'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/brandadmin')}}">Brands</a></li>
              @endif
              @if($user_permissions->contains('pages'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/pagesadmin')}}">Pages</a></li>
              @endif
              @if($user_permissions->contains('faq'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/faqadmin')}}">Faq</a></li>
              @endif
              @if($user_permissions->contains('contact_us'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/contactusadmin')}}">Contact Us</a></li>
              @endif
              @if($user_permissions->contains('coupons'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/offer')}}">Coupons</a></li>
              @endif
             </ul>
          </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">Users</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-account-circle"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                @if($user_permissions->contains('seller'))
                <li class="nav-item"> <a class="nav-link" href="{{url('admin/selleradmin')}}">Sellers</a></li>
                @endif
                @if($user_permissions->contains('delivery_boy'))
                <li class="nav-item"> <a class="nav-link" href="{{url('admin/deliveryadmin')}}">Care Givers</a></li>
                @endif
                @if($user_permissions->contains('customers'))
                <li class="nav-item"> <a class="nav-link" href="{{url('admin/customers')}}">Customers</a></li>
                @endif
              </ul>
            </div>
        </li> 
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
            <span class="menu-title">Promotions</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-file"></i>
          </a>
          <div class="collapse" id="ui-basic1">
            <ul class="nav flex-column sub-menu">
              @if($user_permissions->contains('banner'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/banneradmin')}}">Banners</a></li>
              @endif
              @if($user_permissions->contains('area_banner'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/areabanneradmin')}}">Area Banners</a></li>
              @endif
              @if($user_permissions->contains('membership_plan'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/plan')}}">Membership Plans</a></li>
              @endif
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
            <span class="menu-title">Settings</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-settings"></i>
          </a>
          <div class="collapse" id="ui-basic3">
            <ul class="nav flex-column sub-menu">
              @if($user_permissions->contains('notifications'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/notification')}}">Manage Notifications</a></li>
              @endif
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
            <span class="menu-title">Order Managements</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-store"></i>
          </a>
          <div class="collapse" id="ui-basic4">
            <ul class="nav flex-column sub-menu">
              @if($user_permissions->contains('reviews'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/store_reviews')}}">Store Reviews</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/product_reviews')}}">Product Reviews</a></li>
              @endif  
              @if($user_permissions->contains('orders'))
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/orders')}}">Manage Orders</a></li>
              @endif
            </ul>
          </div>
        </li>
        
      

      
      <!-- @if($user_permissions->contains('meaurement'))
        <li class="nav-item">
           <a class="nav-link" data-toggle="collapse" href="#ui-basic48" aria-expanded="false" aria-controls="ui-basic48">
           <span class="menu-title">Measurement</span>
           <i class="menu-arrow"></i>
           <i class="mdi mdi-image-filter"></i>
           </a>
           <div class="collapse" id="ui-basic48">
              <ul class="nav flex-column sub-menu">
                 <li class="nav-item"> <a class="nav-link" href="{{url('admin/measurement/create')}}">Add Measurement</a></li>
                 <li class="nav-item"> <a class="nav-link" href="{{url('admin/measurement')}}">Manage Measurements</a></li>
              </ul>
           </div>
        </li>
      @endif -->
            <!-- @if($user_permissions->contains('store_settings'))
        <li class="nav-item">
           <a class="nav-link" data-toggle="collapse" href="#ui-basic48" aria-expanded="false" aria-controls="ui-basic48">
           <span class="menu-title">Store Settings</span>
           <i class="menu-arrow"></i>
           <i class="mdi mdi-image-filter"></i>
           </a>
           <div class="collapse" id="ui-basic48">
              <ul class="nav flex-column sub-menu">
                 <li class="nav-item"> <a class="nav-link" href="{{url('admin/settings/create')}}">Add Store Setting</a></li>
                 <li class="nav-item"> <a class="nav-link" href="{{url('admin/settings')}}">Manage Store Settings</a></li>
              </ul>
           </div>
        </li>
      @endif -->
    </ul>
 </nav>