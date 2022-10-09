<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


@extends('layouts.admin')
@section('title','Data Analytics') 
@section('content')

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<div class="content-wrapper">
    
   <div class="page-header">
      <h3 class="page-title">
         
         <i class="mdi iconify mdi-iconify" data-icon="mdi:data-matrix-scan"></i>
         </span> Data Analytics 
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
      
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
              <h4 class="font-weight-normal mb-3"> <strong>Highest sale</strong>  </h4>
               <table class="table table-striped" id="highest_sale">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Customers</th>
                        <th>Product Name</th>
                        <th>Total</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($highest_sale as $key=>$orders)
                     <tr>
                      <td>{{$key+1}}</td>                     
                      <td>{{$orders->customer}}</td>
                      <td>{{$orders->product}}</td>
                      <td>{{$orders->total}}  <span>Rs</span></td>                        
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>


        <div class="col-lg-12 grid-margin stretch-card">
           <div class="card">

              <div class="card-body table-responsive">
                <a href="javascript:" type="button" class="btn btn-warning btn-sm float-right" style="float: left; position: relative; left: 10px;" onclick="location.href='{{url('superadmin/export_top_products_order')}}'">Export</a>
                <h4 class="font-weight-normal mb-3"> <strong>Top Products</strong>  </h4>

                  <div id="barchart_material" style="width: 100%; height: 500px;"></div>

              </div>
           </div>
        </div>






    <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">

            <div class="card-body table-responsive">
              
              <h4 class="font-weight-normal mb-3"> <strong>Store Depend Product Price list </strong>  </h4>
              <a href="javascript:" type="button" class="btn btn-warning float-right" style="float: left; position: relative; left: 10px;" onclick="location.href='{{url('superadmin/store_depend_product_price_list')}}'">Export</a>
               <table class="table table-striped" id="store_dependent_product">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Product Name</th>
                        <th>Brand Name</th>
                        <th>Store Name</th>
                        <th>Sales Price</th>
                        <th>Store Address</th>
                        <th>Store Pincoode</th>
                        <th>Store Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($store_depend_product_price_list as $key=>$product)
                     <tr>
                      <td>{{$key+1}}</td>                     
                      <td>{{$product->product_name}}</td>
                      <td>{{$product->brand_name}}</td>
                      <td>{{$product->sd_sname}}</td>
                      <td>{{$product->sales_price}}</td>
                      <td>{{$product->sd_address}}</td>
                      <td>{{$product->sd_spincode}}</td>
                      <td>{{$product->sd_status}}</td>
                      
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>


      <!-- for export -->
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets1/css/plugins/dataTables/datatables.min.css')}}">
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets1/css/style.css')}}">








      <div class="col-lg-12 grid-margin stretch-card">
           <div class="card">
              <div class="card-body table-responsive">
                
                <h4 class="font-weight-normal mb-3"> <strong>Area Based Customer</strong></h4>
                <a href="javascript:" type="button" class="btn btn-warning float-right" style="float: left; position: relative; left: 10px;" onclick="location.href='{{url('superadmin/area_based_customer')}}'">Export</a>
                 <table class="table table-striped" id="area_based_customer">
                    <thead>
                       <tr>
                          <th>S.No</th>
                          <th>Customer Name</th>
                          <th>Address</th>
                          <th>Landmark</th>
                          <th>Address Type</th>
                          <th>Mobile Number</th>
                       </tr>
                    </thead>
                    <tbody>
                       @forelse($area_based_customer as $key=>$customer)
                       <tr>
                        <td>{{$key+1}}</td>                     
                        <td>{{$customer->name}}</td>   
                        <td>{{$customer->address}}</td>                    
                        <td>{{$customer->landmark}}</td>  
                        <td>{{$customer->address_type}}</td>  
                        <td>{{$customer->mobile_no}}</td>  
                       </tr>
                       @empty
                       <tr>
                          <td colspan="7" class="text-center">
                             {{$message}}
                          </td>
                       <tr>
                       @endforelse
                    </tbody>
                 </table>
              </div>
           </div>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
              <h4 class="font-weight-normal mb-3"> <strong>Repeat Buyers</strong>  </h4>
               <table class="table table-striped" id="repeat_buyers">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Customers</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($repeat_buyers as $key=>$buyer)
                     <tr>
                      <td>{{$key+1}}</td>                     
                      <td>{{$buyer->customer_name}}</td>                     
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>

      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
              <h4 class="font-weight-normal mb-3"> <strong>Recent Orders</strong>  </h4>
               <table class="table table-striped" id="recent_orders">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Store Name</th>
                        <th>Product Name</th>
                        <th>Total</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($order_product as $key=>$orders)
                     <tr>
                      <td>{{$key+1}}</td>   
                      <td>{{$orders->sd_sname}}</td>                   
                      <td>{{$orders->product}}</td>  
                      <td>{{$orders->total}}  <span>Rs</span></td>                     
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>

      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
              <h4 class="font-weight-normal mb-3"><strong>Top Orders in Areas </strong></h4>
               <table class="table table-striped" id="top_orders_in_areas">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Order Area</th>
                        <th>Store Name</th>
                        <th>Product Name</th>
                        <th>Total</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($top_orders_in_areas as $key=>$address)
                     <tr>
                      <td>{{$key+1}}</td>                     
                      <td>{{$address->addresses}}</td>      
                      <td>{{$address->sd_sname}}</td> 
                      <td>{{$address->product}}</td>  
                      <td>{{$address->total}}  <span>Rs</span></td>                 
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>

      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
              <h4 class="font-weight-normal mb-3"><strong>Customer Orders And Total </strong></h4>
              <a href="javascript:" type="button" class="btn btn-warning float-right" style="float: left; position: relative; left: 10px;" onclick="location.href='{{url('superadmin/customer_orders_total')}}'">Export</a>
               <table class="table table-striped" id="customer_order_total">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Customer Name</th>
                        <th>Total Amount</th>
                        <th>Customer count of orders</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($customer_order_total as $key=>$address)
                     <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$address->name}}</td> 
                      <td>{{$address->total}}</td> 
                      <td>{{$address->customer_count}}</td> 
    
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>


      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
              <h4 class="font-weight-normal mb-3"><strong>Users List</strong></h4>
               <table class="table table-striped" id="active_users">
                <!-- <a href="javascript:" type="button" class="btn btn-primary" style="float: left;" data-toggle="modal" data-target="#filter">Filter</a> -->
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($senddata as $key=>$slider)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$slider->first_name}}</td>
                        <td>{{$slider->email}}</td>
                        <td>{{$slider->mobile_number}}</td>
                        @if($slider->user_status == 1)
                        <td><a href="javascript:" class="badge badge-success active" data-id='{{$slider->id}}' style="cursor: pointer;">Active</a></td>
                        @else
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='{{$slider->id}}' style="cursor: pointer;">Inactive</a></td>
                        @endif
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                        @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>


   </div>


</div>

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<!-- partial -->
@endsection


<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/dataTables.bootstrap4.min.js')}}"></script>

<!-- Start Datatables -->

<script type="text/javascript">

$(document).ready(function(){

$(function () {
    $.noConflict();  

        $('#highest_sale').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        }); 

        
        $('#store_dependent_product').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        }); 



        $('#area_based_customer').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });  

        $('#repeat_buyers').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });  

        $('#recent_orders').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });  

        $('#top_orders_in_areas').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        }); 

        $('#customer_order_total').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });

        $('#active_users').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });  

        

    });

});

// $(document).ready(function(){

//   $('#store_dependent_product').DataTable({
//           pageLength: 25,
//           responsive: true,
//           dom: '<"html5buttons"B>1Tfgitp',
//           buttons: [
//             {extend: 'pdf', ExampleFile},
//           ],

//         }); 
//   });
 
</script>

<!-- End Datatables -->


<!-- Start Graph Chart -->


<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
      ['Product Name', 'Sale Count'],


      @php
        foreach($top_products_order as $order) {
            echo "['".$order->product_name."', ".$order->product_count."],";
        }
      @endphp
  ]);

  var options = {
    chart: {
      title: 'Bar Graph | Product Count',
    },
    bars: 'vertical'
  };
  var chart = new google.charts.Bar(document.getElementById('barchart_material'));
  chart.draw(data, google.charts.Bar.convertOptions(options));
}
</script>

<!-- End Graph Chart -->