@extends('layouts.admin2')
@section('title','Dashboard') 
@section('content')
<div class="content-wrapper">
   <!--  <div class="row" id="proBanner">
      <div class="col-12">
        <span class="d-flex align-items-center purchase-popup">
          <p>Get tons of UI components, Plugins, multiple layouts, 20+ sample pages, and more!</p>
          <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template?utm_source=organic&amp;utm_medium=banner&amp;utm_campaign=free-preview" target="_blank" class="btn download-button purchase-button ml-auto">Upgrade To Pro</a>
          <i class="mdi mdi-close" id="bannerClose"></i>
        </span>
      </div>
      </div> -->
   <div class="page-header">
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="mdi mdi-home"></i>
         </span> Dashboard 
      </h3>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
               <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
         </ul>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
         <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
               <h4 class="font-weight-normal mb-3">Total Sellers <i class="mdi mdi-diamond mdi-24px float-right"></i>
               </h4>
               <h2 class="mb-5">{{$sellers_count}}</h2>
               <h6 class="card-text"></h6>
            </div>
         </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
         <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
               <h4 class="font-weight-normal mb-3">Total Customers <i class="mdi mdi-diamond mdi-24px float-right"></i>
               </h4>
               <h2 class="mb-5">{{$customers_count}}</h2>
               <h6 class="card-text"></h6>
            </div>
         </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
         <div class="card bg-gradient-warning card-img-holder text-white">
            <div class="card-body">
               <h4 class="font-weight-normal mb-3">Total Orders <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
               </h4>
               <h2 class="mb-5">{{$orders_count}}</h2>
               <h6 class="card-text"></h6>
            </div>
         </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
           <div class="card-body">
              <h4 class="font-weight-normal mb-3">Total Sales <i class="mdi mdi-chart-line mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">₹ {{$total_sales}}</h2>
              <h6 class="card-text"></h6>
           </div>
        </div>
     </div>
     <!-- <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
           <div class="card-body">
              <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-chart-line mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">95,5741</h2>
              <h6 class="card-text">Increased by 5%</h6>
           </div>
        </div>
     </div>
     <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
           <div class="card-body">
              <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">95,5741</h2>
              <h6 class="card-text">Increased by 5%</h6>
           </div>
        </div>
     </div> -->
   </div>


</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<!-- partial -->
@endsection