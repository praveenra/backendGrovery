
<?php $__env->startSection('title','Profile Detail'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Profile Detail </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperadminAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile Detail</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Profile Detail</h4>
               <form action="<?php echo e(url('profile_detail_update')); ?>" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <input type="hidden" value="<?php echo e($user->id); ?>" name="id">

                <div class="form-group">
                  <label for="first_name">User Name</label>
                  <input type="text" name="first_name" value="<?php echo e($user->first_name); ?>"  class="form-control" placeholder="First Name" style="width: 50%;">
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" name="email" value="<?php echo e($user->email); ?>"  class="form-control" placeholder="Email" style="width: 50%;">
                </div>

         
                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button> 

          </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/common/admin/superadmin_profile_detail.blade.php ENDPATH**/ ?>