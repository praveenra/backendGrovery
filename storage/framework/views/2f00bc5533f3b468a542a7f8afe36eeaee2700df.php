<?php $__env->startSection('title','Grovery'); ?> 
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
<div class="row">
	<img class="banner" src="<?php echo e(asset('public/web/images/banner.jpg')); ?>" alt="">
</div>
</div>

<div class="category">
<section class="container">
<h2>CATEGORY</h2>
			<?php $__currentLoopData = $maincategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maincategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div><a href="store/<?php echo e($maincategory['mc_id']); ?>"><img src="<?php echo e(asset('public/admin/images/category/')); ?>/<?php echo e($maincategory['image']); ?>" alt=""><small><?php echo e($maincategory['mc_name']); ?></small></a></div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<section class="clear"></section>
			</section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\Laravel\backendGrovery\resources\views/index.blade.php ENDPATH**/ ?>