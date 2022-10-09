
<?php $__env->startSection('title','Brand'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Brand </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Brand</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Brand</h4>
               <?php echo Form::model($slider, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']); ?>

               <div class="form-group">
                     <label for="">Category</label>
                     <?php echo Form::select('cat_is_parent_id', (['' => '--Select a Category--'] + $category), ($slider->cat_is_parent_id) ? $slider->cat_is_parent_id : null ,['class' => 'form-control','data-error' => 'Choose category']); ?>                    
                     <div class="help-block form-text with-errors form-control-feedback"></div>
                     <?php if( $errors->has('cat_is_parent_id') ): ?>
                     <div class="error_span help-text text-danger"> <?php echo e($errors->first('cat_is_parent_id')); ?></div>
                     <?php endif; ?>
                  </div>
                  
                  <div class="form-group">
                     <label for="first_name">Brand Name</label>
                     <?php echo e(Form::text('brand_name', old('cat_name'), ['class' => 'form-control', 'placeholder' => 'Brand Name'])); ?>

                     <?php if($errors->has('brand_name')): ?>
                     <div class="error_span help-text text-danger"><?php echo e($errors->first('brand_name')); ?></div>
                     <?php endif; ?>
                  </div>
                 <div class="form-group">
                    <label for="first_name">Brand Status</label>
                    <div class="radio-list">
                        <label>
                        <?php echo e(Form::radio('brand_status', 1)); ?> Active</label> <br/>
                        <label>
                        <?php echo e(Form::radio('brand_status', 0)); ?> In Active</label>
                     </div>
                 </div>




                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/brand/addedit.blade.php ENDPATH**/ ?>