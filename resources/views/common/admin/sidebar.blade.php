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
                    <span class="text-secondary text-small">{{auth()->guard('superadmin')->user()->first_name}} {{auth()->guard('superadmin')->user()->last_name}}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('superadmin/dashboard')}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
       </li>
       <li class="nav-item">
            <a class="nav-link" href="{{url('superadmin/data_analytics')}}">
                <span class="menu-title">Data Analytics</span>
                <i class="mdi mdi-store menu-icon"></i>
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
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/area')}}">Areas</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/brand')}}">Brands</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/offer')}}">Coupons</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/city_index')}}">Cities</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/contactus')}}">Contact Us</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/maincategory')}}">Main Categories</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/category')}}">Categories</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/subcategory')}}">Sub Categories</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/subsubcategory')}}">Sub Sub Categories</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/productSize')}}">Product Size</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/productColor')}}">Product Color</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/products')}}">Products</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/pages')}}">Pages</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/faq')}}">Faq</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/zone')}}">Grovery Zone</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/delivery_info_index')}}">Delivery Fee</a></li>
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
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/admindata')}}">Admins</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/seller')}}">Sellers</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/delivery')}}">Care Givers</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/customers')}}">Customers</a></li>
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
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/banner')}}">Banners</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/areabanner')}}">Area Banners</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/plan_list')}}">Membership Plans</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/membership_user_list')}}">Membership Users</a></li>
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
                   <!-- <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/settings')}}">Store Settings</a></li> -->
                   <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/delivery_settings_list')}}">Delivery Settings</a></li>
                   <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/notification')}}">Notifications</a></li>
                   <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/cancel_reason')}}">Cancel Reason</a></li>
                   <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/cashinhand')}}">Deliveryboy cash in hand</a></li>
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
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/orders')}}">Orders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/delivery_man')}}">Delivery Man Assign</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/orders_limit_list')}}">Order Limit</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/orders_history')}}">Order History</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/store_reviews')}}">Store Reviews</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/product_reviews')}}">Product Reviews</a></li>
                </ul>
             </div>
        </li>
       <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic22" aria-expanded="false" aria-controls="ui-basic22">
                <span class="menu-title">Delivery</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-image"></i>
            </a>
            <div class="collapse" id="ui-basic22">
              <!--  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/delivery_man')}}">Delivery Man Assign</a></li>
                </ul> -->
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/waiting_for_approval_order')}}">Waiting For Approval <br>Order</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/approve_and_reject_order')}}">Approved And Reject <br>Orders</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/ready_to_pickup_and_delivery')}}">Ready To Pickup And <br>Delivery Orders</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/complete_and_return_order')}}">Complete And Return <br>Orders</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basi5">
                <span class="menu-title">Activity Log</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-store"></i>
            </a>
            <div class="collapse" id="ui-basic5">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/log_history')}}"> Log History</a></li>
                </ul>
             </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basi6">
                <span class="menu-title">Payments</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-store"></i>
            </a>
            <div class="collapse" id="ui-basic6">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/order_earning')}}">Order Earning</a></li>
                </ul>

                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/order_payments')}}">Seller Payments</a></li>
                </ul>

                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/delivery_boy_payments')}}">Delivery Boy Payments</a></li>
                </ul>

                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('superadmin/return_payments')}}">Return Payments</a></li>
                </ul>

             </div>
        </li>

    </ul>
 </nav>