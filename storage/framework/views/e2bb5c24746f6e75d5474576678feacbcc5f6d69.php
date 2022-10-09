<!DOCTYPE html>
<html>
<head>
<?php echo $__env->make('common.web.header_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>
<?php echo $__env->make('common.web.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>


<?php echo $__env->make('common.web.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.web.footer_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/layouts/web.blade.php ENDPATH**/ ?>