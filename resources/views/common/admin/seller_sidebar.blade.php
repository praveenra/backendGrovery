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
          <a href="{{url('superadmin/dashboard')}}" class="nav-link">
             <div class="nav-profile-image">
                <img src="{{asset('public/admin/images/Grovery.png')}}" alt="profile">
                <span class="login-status online"></span>
                <!--change to offline or busy as needed-->
             </div>
             <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2">Grovery</span>
                <span class="text-secondary text-small">{{auth()->guard('seller')->user()->first_name}} {{auth()->guard('seller')->user()->last_name}}</span>
             </div>
             <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
          </a>
       </li>
       <li class="nav-item">
          <a class="nav-link" href="{{url('seller/dashboard')}}">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
          </a>
       </li>
       
     
            <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#ui-basic8" aria-expanded="false" aria-controls="ui-basic8">
         <span class="menu-title">Products</span>
         <i class="menu-arrow"></i>
         <i class="mdi mdi-image-filter"></i>
         </a>
         <div class="collapse" id="ui-basic8">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"> <a class="nav-link" href="{{url('seller/product/create')}}">Add Products</a></li>
               <li class="nav-item"> <a class="nav-link" href="{{url('seller/product')}}">Manage Products</a></li>
			   <li class="nav-item"> <a class="nav-link" href="{{url('seller/product/uploadview')}}">Bulk Products Upload</a></li>
            </ul>
         </div>
      </li>
	  
	   <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#ui-basic48" aria-expanded="false" aria-controls="ui-basic48">
         <span class="menu-title">Store Settings</span>
         <i class="menu-arrow"></i>
         <i class="mdi mdi-image-filter"></i>
         </a>
         <div class="collapse" id="ui-basic48">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"> <a class="nav-link" href="{{url('seller/setting/create')}}">Add Store Settings</a></li>
               <li class="nav-item"> <a class="nav-link" href="{{url('seller/setting')}}">Manage Store Settings</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#ui-basic48" aria-expanded="false" aria-controls="ui-basic48">
         <span class="menu-title">Orders</span>
         <i class="menu-arrow"></i>
         <i class="mdi mdi-image-filter"></i>
         </a>
         <div class="collapse" id="ui-basic48">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"> <a class="nav-link" href="{{url('seller/orders')}}">Manage Orders</a></li>
            </ul>
         </div>
      </li>
    </ul>
 </nav>