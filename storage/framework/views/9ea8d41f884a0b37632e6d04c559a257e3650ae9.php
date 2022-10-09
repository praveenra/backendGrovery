
<?php $__env->startSection('title','Admin'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Admin </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Admin</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Admin Details</h4>
               <?php echo Form::model($senddata, ['route' => $route, 'method' => $method, 'id'=>"formValidate" , 'novalidate'=>"true", 'files' => true]); ?>

                  <div class="form-group">
                     <label for="first_name">User Name</label>
                     <?php echo e(Form::text('first_name',old('first_name'),['class' => 'form-control','data-error' => 'Enter Your User Name','placeholder'=>'Enter Your User Name','required'=>'required','type'=>'text'] )); ?>

                     <?php if($errors->has('first_name')): ?>
                     <div class="error_span help-text text-danger"><?php echo e($errors->first('first_name')); ?></div>
                     <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                    <?php echo e(Form::number('mobile_number',old('mobile_number'),['class' => 'form-control','data-error' => 'Enter Your Mobile Number','placeholder'=>'Enter Your Mobile Number','required'=>'required','type'=>'number','min'=>"1",'max'=>"9999999999"] )); ?>

                    <?php if($errors->has('mobile_number')): ?>
                    <div class="error_span help-text text-danger"><?php echo e($errors->first('mobile_number')); ?></div>
                    <?php endif; ?>
                 </div>
                 <div class="form-group">
                    <label for="email">Email Id</label>
                    <?php echo e(Form::text('email',old('email'),['class' => 'form-control','data-error' => 'Enter Your Email','placeholder'=>'Enter Your Email','required'=>'required','type'=>'text'] )); ?>

                    <?php if($errors->has('email')): ?>
                    <div class="error_span help-text text-danger"><?php echo e($errors->first('email')); ?></div>
                    <?php endif; ?>
                 </div>
                 <div class="form-group">
                    <label for="">Password</label>
                    <?php echo e(Form::password('password',['class' => 'form-control','data-error' => 'Enter Your Password','placeholder'=>'Enter Your Password','required'=>'required','type'=>'password'] )); ?>

                    <?php if($errors->has('password')): ?>
                    <div class="error_span help-text text-danger"><?php echo e($errors->first('password')); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="first_name">User Status</label>
                    <div class="radio-list">
                        <label>
                        <?php echo e(Form::radio('user_status', 1)); ?> Active</label> <br/>
                        <label>
                        <?php echo e(Form::radio('user_status', 0)); ?> In Active</label>
                     </div>
                 </div><br>
                 <div class="form-group">
                    <label for="first_name">Permissions</label><br>
                    <div class="form-group" style="column-count: 4;">
                      <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="checkbox" name="permissions[]" value="<?php echo e($permission->id); ?>" <?php echo e($senddata->permissions->contains($permission->id) ? 'checked' : ''); ?>> &nbsp; <?php echo e($permission->display_name); ?> <br>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/admin/addedit.blade.php ENDPATH**/ ?>