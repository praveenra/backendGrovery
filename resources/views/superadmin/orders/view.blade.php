<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


<style>

.w3-col.m4, .w3-third {
    width: 24.33333%;
}

</style>

@extends('layouts.admin')
@section('title','Orders') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Orders</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
              <div class="w3-row">
                <a href="javascript:void(0)" onclick="openOrder(event, 'Basic_details');">
                  <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-border-red">Basic Details</div>
                </a>
                <a href="javascript:void(0)" onclick="openOrder(event, 'Order_details');">
                  <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Order Details</div>
                </a>
                <a href="javascript:void(0)" onclick="openOrder(event, 'Invoice');">
                  <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Invoice</div>
                </a>
                <a href="javascript:void(0)" onclick="openOrder(event, 'Status');">
                  <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Status</div>
                </a>
              </div>

              <div id="Basic_details" class="w3-container order grid">
                <div class="row">
                  <div class="col-md-12 grid-margin stretch-card">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="card-title">Basic Details</h4>

                           <div class="form-group">
                              <h5>Order By</h5>
                              <h6>{{$order->customer}}</h6>
                              <h6>{{$order->phone_no}}</h6>
                              <br>

                              <h6>{{$order->customer}} ({{$order->phone_no}})</h6>
                              <br>

                              <h4 style="color: pink">Delivery Note:</h4>
                              <br>
                              <h5>Order To</h5>
                              <h6>{{$order->customer}}</h6>
                              <h6>{{$order->email}}</h6>
                              <h6>{{$order->phone_no}}</h6>
                              <br><br>
                              <h6>{{$order->address}}</h6>
                              <h6>{{$order->address_type}}</h6>
                              <h6>{{$order->landmark}}</h6>
                              <h6>{{$order->mobile_no}}</h6>
                              
                           </div>

                        </div>
                     </div>
                  </div>
                </div>
              </div>

              <div id="Order_details" class="w3-container order grid">
                <div class="row">
                  <div class="col-md-12 grid-margin stretch-card">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="card-title">Order Details</h4>

                          <div class="form-group">
                              <h5>Order By</h5>
                              <h6>{{$order->product}} ({{$order->measurement}}) </h6>
                              <h6><span>Quantity</span> {{$order->quantity}}</h6>
                              <h6 class="float-right">({{$order->measurement}})  {{$order->total}} </h6>
                              <br>
                              <hr>
                              <h6 class="float-right">{{$order->total}}</h6> <span class="float-right">Cart Total:</span><br><br><br>

                              <h6 class="float-right">{{$order->total}}</h6> <span class="float-right"> Total Cart Price:</span>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
              </div>



            <div id="Invoice" class="w3-container order grid">
                <div class="row">
                  <div class="col-md-12 grid-margin stretch-card">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="card-title">Invoice</h4>                           

                        </div>
                     </div>
                  </div>
               </div>
            </div>


            <div id="Status" class="w3-container order grid" >
                <div class="row">
                  <div class="col-md-12 grid-margin stretch-card">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="card-title">Status</h4>

                          
                        </div>
                     </div>
                  </div>
                </div>
            </div>



            </div>
         </div>
      </div>
   </div>
</div>


<script type="text/javascript">

function openOrder(evt, customerName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("order");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
  }
  document.getElementById(customerName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-red";
}

</script>

@endsection
