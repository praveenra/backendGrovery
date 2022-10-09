
<?php $__env->startSection('title','Order Earnings'); ?> 
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title">Order Earnings</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order Earnings </li>
         </ol>
      </nav>
   </div>
   
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="delivery_boy_payment">
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>admin_amount_total</th>
                        <th>delivery_man_amount_total</th>
                        <th>store_amount_total</th>
                        <th>complete_count</th>
                        <th>return_count</th>
                        <th>order_completed_count</th>
                        <th>cancel_count</th>
                        <th>total_amount</th>
                     </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>1</td>
                        <td><?php echo e($admin_amount_total); ?></td>
                        <td><?php echo e($delivery_man_amount_total); ?></td>
                        <td><?php echo e($store_amount_total); ?></td>
                        <td><?php echo e($complete_count); ?></td>
                        <td><?php echo e($return_count); ?></td>
                        <td><?php echo e($order_completed_count); ?></td>
                        <td><?php echo e($cancel_count); ?></td>
                        <td><?php echo e($total_amount); ?></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<?php $__env->stopSection(); ?>

<script src="<?php echo e(asset('public/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/dataTables.bootstrap4.min.js')); ?>"></script>

<script type="text/javascript">


   $(document).ready(function(){

     $(".active").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
          type:"GET",
          url:"<?php echo e(route('inactiveDeliveryBoy')); ?>?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

      $(".inactive").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
          type:"GET",
          url:"<?php echo e(route('activeDeliveryBoy')); ?>?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

    });
   
   $(function () {
    $.noConflict();
        $('#delivery_boy_payment').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });        
    });


   $(document).ready(function(){

     $(".active").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
          type:"GET",
          url:"<?php echo e(route('inactiveDeliveryBoy')); ?>?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

      $(".inactive").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
          type:"GET",
          url:"<?php echo e(route('activeDeliveryBoy')); ?>?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

    });

</script>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\Laravel\backendGrovery\resources\views/superadmin/payment/order_earning.blade.php ENDPATH**/ ?>