
<?php $__env->startSection('title','Orders History'); ?> 
<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Orders</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders History</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
              
               <table class="table table-striped" id="orders_history">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Total Customer Uses</th>
                        <th>Coupon Order Value</th>
                        <th>Coupon Redeem</th>
                        <th>Admin Pay Amount</th>
                     </tr>
                  </thead>
                  <tbody>

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

   $(function () {
    $.noConflict();
        $('#orders_history').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });        
    });

</script>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/orders/orders_history.blade.php ENDPATH**/ ?>