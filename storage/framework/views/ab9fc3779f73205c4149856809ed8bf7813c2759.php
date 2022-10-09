
<?php $__env->startSection('title','Contact Us'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Contact Us </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Contact Us</h4>
               <?php echo Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']); ?>

                  <div class="form-group">
                     <label for="first_name">Email Address</label>
                     <?php echo e(Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email Address'])); ?>

                     <?php if($errors->has('email')): ?>
                     <div class="error_span help-text text-danger"><?php echo e($errors->first('email')); ?></div>
                     <?php endif; ?>
                  </div>
                  <div class="form-group">
                     <label for="first_name">Phone No</label>
                     <input type="tel" name="phone_no" class="form-control" value="<?php echo e($senddata->phone_no); ?>" placeholder="Phone No" pattern="[0-9]{10}">
                     <?php if($errors->has('phone_no')): ?>
                     <div class="error_span help-text text-danger"><?php echo e($errors->first('phone_no')); ?></div>
                     <?php endif; ?>
                  </div>
                  <div class="form-group">
                     <label for="first_name">Address</label>
                     <?php echo e(Form::textarea('address', old('address'), ['class' => 'form-control', 'placeholder' => 'Address'])); ?>

                  </div>
                  <div class="form-group">
                     <label for="first_name">Facebook</label>
                     <input type="text" name="facebook" class="form-control" value="<?php echo e($senddata->facebook); ?>" placeholder="Facebook">
                  </div>
                  <div class="form-group">
                     <label for="first_name">Whatsapp</label>
                     <input type="text" name="whatsapp" class="form-control" value="<?php echo e($senddata->whatsapp); ?>" placeholder="Whatsapp">
                  </div>
                  <div class="form-group">
                     <label for="first_name">Instagram</label>
                     <input type="text" name="instagram" class="form-control" value="<?php echo e($senddata->instagram); ?>" placeholder="Instagram">
                  </div>
                  <div class="form-group">
                     <label for="first_name">twitter</label>
                     <input type="text" name="twitter" class="form-control" value="<?php echo e($senddata->twitter); ?>" placeholder="twitter">
                  </div>
                  
                 <div class="form-group">
                    <label for="first_name">Contact Status</label>
                    <div class="radio-list">
                        <label>
                        <?php echo e(Form::radio('status', 1)); ?> Active</label> <br/>
                        <label>
                        <?php echo e(Form::radio('status', 0)); ?> In Active</label>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\Laravel\backendGrovery\resources\views/superadmin/contactus/addedit.blade.php ENDPATH**/ ?>