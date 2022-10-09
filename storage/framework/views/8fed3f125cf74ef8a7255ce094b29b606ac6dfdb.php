
<?php $__env->startSection('title','Zone'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Grovery Service Providing Zone </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Grovery Service Providing Zone</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Grovery Service Providing Zone</h4>
               <?php echo Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']); ?>

                  <div class="form-group">
                     <label for="first_name">Zone Name</label>
                     <?php echo e(Form::text('zone_name', old('zone_name'), ['class' => 'form-control', 'placeholder' => 'Title'])); ?>

                     <?php if($errors->has('zone_name')): ?>
                     <div class="error_span help-text text-danger"><?php echo e($errors->first('zone_name')); ?></div>
                     <?php endif; ?>
                  </div>
                  <div class="form-group">
                     <label for="first_name">Zone Latitude</label>
                     <?php echo e(Form::text('zone_lat', old('zone_lat'), ['class' => 'form-control', 'placeholder' => 'Zone Latitude'])); ?>

                     <?php if($errors->has('zone_lat')): ?>
                     <div class="error_span help-text text-danger"><?php echo e($errors->first('zone_lat')); ?></div>
                     <?php endif; ?>
                  </div>
                  <div class="form-group">
                     <label for="first_name">Zone Longitude</label>
                     <?php echo e(Form::text('zone_lon', old('zone_lon'), ['class' => 'form-control', 'placeholder' => 'Zone Longitude'])); ?>

                     <?php if($errors->has('zone_lon')): ?>
                     <div class="error_span help-text text-danger"><?php echo e($errors->first('zone_lon')); ?></div>
                     <?php endif; ?>
                  </div>
                  <div class="form-group">
                     <label for="first_name">Zone Radius</label>
                     <?php echo e(Form::text('zone_radius', old('zone_radius'), ['class' => 'form-control', 'placeholder' => 'Zone Radius'])); ?>

                     <?php if($errors->has('zone_radius')): ?>
                     <div class="error_span help-text text-danger"><?php echo e($errors->first('zone_radius')); ?></div>
                     <?php endif; ?>
                  </div>
                 <div class="form-group">
                    <label for="first_name">Zone Status</label>
                    <div class="radio-list">
                        <label>
                        <?php echo e(Form::radio('zone_status', 1)); ?> Active</label> <br/>
                        <label>
                        <?php echo e(Form::radio('zone_status', 0)); ?> In Active</label>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\Laravel\backendGrovery\resources\views/superadmin/zone/addedit.blade.php ENDPATH**/ ?>