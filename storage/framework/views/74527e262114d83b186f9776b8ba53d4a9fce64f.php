
<?php $__env->startSection('title','Products'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Products</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bulk Uploads</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Bulk Upload Products</h4>
			   
			   <div class="form-group">
                Sample Files For Upload Data.<a href="<?php echo e(url('/admin/products.xlsx/')); ?>">Clik Here</a>
					
                 </div>
				 <form method="POST" action="<?php echo e(url('/superadmin/products/uploadexcel')); ?>" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>
				 <div class="form-group">
                    <label for="first_name">Upload Excel</label>
                       <input type="file" name="file" class="form-control" id="customFile">

                 </div>
				 <input type="submit" class="btn btn-gradient-primary mr-2" value="submit">
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\Laravel\backendGrovery\resources\views/superadmin/product/uploads.blade.php ENDPATH**/ ?>