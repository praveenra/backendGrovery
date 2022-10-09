
<?php $__env->startSection('title','Delivery Boy Cash In Hand'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title">Delivery Boy Cash In Hand</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Delivery Boy Cash In Hand</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body p-3">

            <form action="<?php echo e(route('savedboycashinhandview')); ?>" method="post" enctype="multipart/form-data">
               <?php echo csrf_field(); ?>
              <input type="hidden" name="id" value="<?php echo e($setting->s_id); ?>">

             
               <div class="form-group">
                  <label for="cancel_reason">Delivery Boy Cash In Hand</label>
                  <input type="text" name="cash_in_hand" class="form-control" placeholder="Cancel Reason" value="<?php echo e($setting->s_content); ?>">
               </div>
            </div>
         </div>
      </div>

      <button type="submit" class="btn btn-gradient-primary mr-2" style="margin-left: 45%">Submit</button>
      </form>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/deliverySettings/dboycashinhand.blade.php ENDPATH**/ ?>