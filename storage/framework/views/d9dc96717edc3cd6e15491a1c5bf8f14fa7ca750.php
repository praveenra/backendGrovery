
<?php $__env->startSection('title','Membership User'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Membership User</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Membership User </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="plan">
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Customer Name</th>
                        <th>Customer Phone Number</th>
                        <th>Plan Name</th>
                        <th>Plan Duration</th>
                        <th>Plan Limit</th>
                        <th>Original Plan Amount</th>
                        <th>Plan Amount</th>
                        <th>Description</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $__empty_1 = true; $__currentLoopData = $mebership_user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($data->name); ?></td>
                        <td><?php echo e($data->phone_no); ?></td>
                        <td><?php echo e($data->plan_name); ?></td>
                        <td><?php echo e($data->plan_duration); ?></td>
                        <td><?php echo e($data->plan_limit); ?></td>
                        <td><?php echo e($data->original_plan_amount); ?></td>
                        <td><?php echo e($data->plan_amount); ?></td>
                        <td><?php echo e($data->description); ?></td>
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
        $('#plan').DataTable({
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\Laravel\backendGrovery\resources\views/superadmin/plan/membership_user_list.blade.php ENDPATH**/ ?>