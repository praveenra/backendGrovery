<html>
   <head>
      <title><?php echo $__env->yieldContent('title'); ?> - Grovery  </title>
      <?php echo $__env->make('common.admin.header_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   </head>
   <body>
    <?php echo $__env->yieldContent('content'); ?>
   </body>
   <?php echo $__env->make('common.admin.footer_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <?php echo $__env->yieldContent('footer_script'); ?>
</html><?php /**PATH /home/ubuntu/Documents/mahe/latestcodeteam/GroveryVThree/Grovery/resources/views/layouts/auth.blade.php ENDPATH**/ ?>