
<?php $__env->startSection('title','Login'); ?> 
<?php $__env->startSection('content'); ?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="<?php echo e(asset('public/admin/images/Grovery.png')); ?>">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6><br>
              <form method="POST" action="<?php echo e(url('superadminlogin')); ?>" autocomplete="off" id="loginForm">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="Enter your Email" type="text" name="email" readonly  onfocus="this.removeAttribute('readonly');" >
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                    <?php if($errors->has('email')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="Enter your password" type="password" name="password" readonly  onfocus="this.removeAttribute('readonly');" >
                    <div class="pre-icon os-icon os-icon-fingerprint"></div>
                    <?php if($errors->has('password')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="buttons-w">
                    <button class="btn btn-primary">Log me in</button>
                </div>


              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubuntu/Documents/mahe/latestcodeteam/GroveryVThree/Grovery/resources/views/superadmin/Auth/login.blade.php ENDPATH**/ ?>