
<?php $__env->startSection('title','Return Payment'); ?> 
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title">Return Payment</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Return Payment </li>
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
                        <th>Seller Name</th>
                        <th>Seller Address</th>
                        <th>Seller Bank</th>
                        <th>Seller Account Number</th>
                        <th>Ordered Customer Name</th>
                        <th>Refund Amount</th>
                        <th>Payment</th>
                     </tr>
                  </thead>
                  <tbody>
                      <?php $__empty_1 = true; $__currentLoopData = $return_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($data->sd_sname); ?></td>
                        <td><?php echo e($data->sd_address); ?>,<?php echo e($data->sd_spincode); ?></td>
                        <td><?php echo e($data->bank_name); ?></td>
                        <td><?php echo e($data->acc_no); ?></td>
                        <td><?php echo e($data->name); ?></td>
                        <td><?php echo e($data->final_calculated_amount); ?></td>
                        <?php if($data->return_payment_status == 1): ?>
                        <td><a href="javascript:" class="badge badge-success active" data-id='<?php echo e($data->ord_id); ?>' style="cursor: pointer;">Payment Success</a></td>
                        <?php else: ?>
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='<?php echo e($data->ord_id); ?>' style="cursor: pointer;">Payment Pending </a></td>
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

<?php $__env->stopSection(); ?>

<script src="<?php echo e(asset('public/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/dataTables.bootstrap4.min.js')); ?>"></script>

<script type="text/javascript">

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
          url:"<?php echo e(route('inactiveReturnPayments')); ?>?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

      $(".inactive").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
          type:"GET",
          url:"<?php echo e(route('activeReturnPayments')); ?>?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

    });



</script>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\Laravel\backendGrovery\resources\views/superadmin/payment/return.blade.php ENDPATH**/ ?>