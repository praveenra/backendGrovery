<!DOCTYPE html>
<html>
   <head>
      <title><?php echo $__env->yieldContent('title'); ?> - Grovery</title>
       <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <?php echo $__env->make('common.admin.header_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   </head>
   <body>
      <div class="container-scroller">
         <?php echo $__env->make('common.admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <?php echo $__env->yieldContent('header'); ?>
         <div class="container-fluid page-body-wrapper">

            <?php echo $__env->make('common.admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="main-panel">
               <?php echo $__env->make('common.admin.flash_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               <?php echo $__env->yieldContent('content'); ?>
               <?php echo $__env->make('common.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
         </div>
      </div>
   </body>
   <?php echo $__env->make('common.admin.footer_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <?php echo $__env->yieldContent('footer_script'); ?>
</html>
<?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/layouts/admin.blade.php ENDPATH**/ ?>