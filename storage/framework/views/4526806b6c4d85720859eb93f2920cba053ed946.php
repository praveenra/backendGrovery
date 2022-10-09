
<?php $__env->startSection('title','Area'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Area </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Area</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Area</h4>
               <?php echo Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']); ?>

                  <div class="form-group">
                     <label for="first_name">Area Name</label>
                     <?php echo e(Form::text('area_name', old('area_name'), ['class' => 'form-control', 'placeholder' => 'Title'])); ?>

                     <?php if($errors->has('area_name')): ?>
                     <div class="error_span help-text text-danger"><?php echo e($errors->first('area_name')); ?></div>
                     <?php endif; ?>
                  </div>
                  <div class="form-group">
                     <label for="">City</label>
                     <?php echo Form::select('area_cityid', (['' => '--Select a City--'] + $cityvalue), ($senddata->area_cityid) ? $senddata->area_cityid : null ,['class' => 'form-control','data-error' => 'Choose City']); ?>                    
                     <div class="help-block form-text with-errors form-control-feedback"></div>
                     <?php if( $errors->has('area_cityid') ): ?>
                     <div class="error_span help-text text-danger"> <?php echo e($errors->first('area_cityid')); ?></div>
                     <?php endif; ?>
                  </div>
                  <div class="form-group">
                     <label for="">Zone</label>
                     <?php echo Form::select('Zone_id', (['' => '--Select a Zone--'] + $zonevalue), ($senddata->Zone_id) ? $senddata->Zone_id : null ,['class' => 'form-control','data-error' => 'Choose Zone']); ?>                    
                     <div class="help-block form-text with-errors form-control-feedback"></div>
                     <?php if( $errors->has('Zone_id') ): ?>
                     <div class="error_span help-text text-danger"> <?php echo e($errors->first('Zone_id')); ?></div>
                     <?php endif; ?>
                  </div>
                 <div class="form-group">
                    <label for="first_name">Area Status</label>
                    <div class="radio-list">
                        <label>
                        <?php echo e(Form::radio('area_status', 1)); ?> Active</label> <br/>
                        <label>
                        <?php echo e(Form::radio('area_status', 0)); ?> In Active</label>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/area/addedit.blade.php ENDPATH**/ ?>