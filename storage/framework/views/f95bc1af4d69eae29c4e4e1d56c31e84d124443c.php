<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">



<?php $__env->startSection('title','Data Analytics'); ?> 
<?php $__env->startSection('content'); ?>

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
                     <?php $__empty_1 = true; $__currentLoopData = $highest_sale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                      <td><?php echo e($key+1); ?></td>                     
                      <td><?php echo e($orders->customer); ?></td>
                      <td><?php echo e($orders->product); ?></td>
                      <td><?php echo e($orders->total); ?>  <span>Rs</span></td>                        
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr>
                        <td colspan="7" class="text-center">
                           <?php echo e($message); ?>

                        </td>
                     <tr>
                     <?php endif; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>


        <div class="col-lg-12 grid-margin stretch-card">
           <div class="card">

              <div class="card-body table-responsive">
                <a href="javascript:" type="button" class="btn btn-warning btn-sm float-right" style="float: left; position: relative; left: 10px;" onclick="location.href='<?php echo e(url('superadmin/export_top_products_order')); ?>'">Export</a>
                <h4 class="font-weight-normal mb-3"> <strong>Top Products</strong>  </h4>

                  <div id="barchart_material" style="width: 100%; height: 500px;"></div>

              </div>
           </div>
        </div>






    <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">

            <div class="card-body table-responsive">
              
              <h4 class="font-weight-normal mb-3"> <strong>Store Depend Product Price list </strong>  </h4>
              <a href="javascript:" type="button" class="btn btn-warning float-right" style="float: left; position: relative; left: 10px;" onclick="location.href='<?php echo e(url('superadmin/store_depend_product_price_list')); ?>'">Export</a>
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
                     <?php $__empty_1 = true; $__currentLoopData = $store_depend_product_price_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                      <td><?php echo e($key+1); ?></td>                     
                      <td><?php echo e($product->product_name); ?></td>
                      <td><?php echo e($product->brand_name); ?></td>
                      <td><?php echo e($product->sd_sname); ?></td>
                      <td><?php echo e($product->sales_price); ?></td>
                      <td><?php echo e($product->sd_address); ?></td>
                      <td><?php echo e($product->sd_spincode); ?></td>
                      <td><?php echo e($product->sd_status); ?></td>
                      
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr>
                        <td colspan="7" class="text-center">
                           <?php echo e($message); ?>

                        </td>
                     <tr>
                     <?php endif; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>


      <!-- for export -->
      <link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('assets1/css/plugins/dataTables/datatables.min.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('assets1/css/style.css')); ?>">








      <div class="col-lg-12 grid-margin stretch-card">
           <div class="card">
              <div class="card-body table-responsive">
                
                <h4 class="font-weight-normal mb-3"> <strong>Area Based Customer</strong></h4>
                <a href="javascript:" type="button" class="btn btn-warning float-right" style="float: left; position: relative; left: 10px;" onclick="location.href='<?php echo e(url('superadmin/area_based_customer')); ?>'">Export</a>
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
                       <?php $__empty_1 = true; $__currentLoopData = $area_based_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                       <tr>
                        <td><?php echo e($key+1); ?></td>                     
                        <td><?php echo e($customer->name); ?></td>   
                        <td><?php echo e($customer->address); ?></td>                    
                        <td><?php echo e($customer->landmark); ?></td>  
                        <td><?php echo e($customer->address_type); ?></td>  
                        <td><?php echo e($customer->mobile_no); ?></td>  
                       </tr>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                       <tr>
                          <td colspan="7" class="text-center">
                             <?php echo e($message); ?>

                          </td>
                       <tr>
                       <?php endif; ?>
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
                     <?php $__empty_1 = true; $__currentLoopData = $repeat_buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                      <td><?php echo e($key+1); ?></td>                     
                      <td><?php echo e($buyer->customer_name); ?></td>                     
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr>
                        <td colspan="7" class="text-center">
                           <?php echo e($message); ?>

                        </td>
                     <tr>
                     <?php endif; ?>
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
                     <?php $__empty_1 = true; $__currentLoopData = $order_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                      <td><?php echo e($key+1); ?></td>   
                      <td><?php echo e($orders->sd_sname); ?></td>                   
                      <td><?php echo e($orders->product); ?></td>  
                      <td><?php echo e($orders->total); ?>  <span>Rs</span></td>                     
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr>
                        <td colspan="7" class="text-center">
                           <?php echo e($message); ?>

                        </td>
                     <tr>
                     <?php endif; ?>
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
                     <?php $__empty_1 = true; $__currentLoopData = $top_orders_in_areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                      <td><?php echo e($key+1); ?></td>                     
                      <td><?php echo e($address->addresses); ?></td>      
                      <td><?php echo e($address->sd_sname); ?></td> 
                      <td><?php echo e($address->product); ?></td>  
                      <td><?php echo e($address->total); ?>  <span>Rs</span></td>                 
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr>
                        <td colspan="7" class="text-center">
                           <?php echo e($message); ?>

                        </td>
                     <tr>
                     <?php endif; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>

      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
              <h4 class="font-weight-normal mb-3"><strong>Customer Orders And Total </strong></h4>
              <a href="javascript:" type="button" class="btn btn-warning float-right" style="float: left; position: relative; left: 10px;" onclick="location.href='<?php echo e(url('superadmin/customer_orders_total')); ?>'">Export</a>
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
                     <?php $__empty_1 = true; $__currentLoopData = $customer_order_total; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                      <td><?php echo e($key+1); ?></td>
                      <td><?php echo e($address->name); ?></td> 
                      <td><?php echo e($address->total); ?></td> 
                      <td><?php echo e($address->customer_count); ?></td> 
    
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr>
                        <td colspan="7" class="text-center">
                           <?php echo e($message); ?>

                        </td>
                     <tr>
                     <?php endif; ?>
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
                     <?php $__empty_1 = true; $__currentLoopData = $senddata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($slider->first_name); ?></td>
                        <td><?php echo e($slider->email); ?></td>
                        <td><?php echo e($slider->mobile_number); ?></td>
                        <?php if($slider->user_status == 1): ?>
                        <td><a href="javascript:" class="badge badge-success active" data-id='<?php echo e($slider->id); ?>' style="cursor: pointer;">Active</a></td>
                        <?php else: ?>
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='<?php echo e($slider->id); ?>' style="cursor: pointer;">Inactive</a></td>
                        <?php endif; ?>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr>
                        <td colspan="7" class="text-center">
                           <?php echo e($message); ?>

                        </td>
                     <tr>
                        <?php endif; ?>
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
<?php $__env->stopSection(); ?>


<script src="<?php echo e(asset('public/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/dataTables.bootstrap4.min.js')); ?>"></script>

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


      <?php
        foreach($top_products_order as $order) {
            echo "['".$order->product_name."', ".$order->product_count."],";
        }
      ?>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/data_analytics/manage.blade.php ENDPATH**/ ?>