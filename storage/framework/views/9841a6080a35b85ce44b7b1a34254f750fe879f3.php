<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<?php $__env->startSection('title','Dashboard'); ?> 
<?php $__env->startSection('content'); ?>


<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<div class="content-wrapper">
    
   <div class="page-header">
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="mdi mdi-home"></i>
         </span> Dashboard 
      </h3>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
               <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
         </ul>
      </nav>
   </div>
   <div class="row">

      <div class="col-md-4 stretch-card grid-margin seller1111">

         <div class="card bg-gradient-danger card-img-holder text-white" onclick="location.href='<?php echo e(url('superadmin/seller')); ?>'">

            <div class="card-body" >
               <h4 class="font-weight-normal mb-3">Total Sellers <i class="mdi mdi-diamond mdi-24px float-right"></i>
               </h4>
               <h2 class="mb-5"><?php echo e($sellers_count); ?></h2>
               <h6 class="card-text"></h6>
            </div>
         </div>
      </div>



      <div class="col-md-4 stretch-card grid-margin" onclick="location.href='<?php echo e(url('superadmin/customers')); ?>'">
         <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
               <h4 class="font-weight-normal mb-3">Total Customers <i class="mdi mdi-diamond mdi-24px float-right"></i>
               </h4>
               <h2 class="mb-5"><?php echo e($customers_count); ?></h2>
               <h6 class="card-text"></h6>
            </div>
         </div>
      </div>


      <div class="col-md-4 stretch-card grid-margin" onclick="location.href='<?php echo e(url('superadmin/orders')); ?>'">
         <div class="card bg-gradient-warning card-img-holder text-white">
            <div class="card-body">
               <h4 class="font-weight-normal mb-3">Total Orders <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
               </h4>
               <h2 class="mb-5"><?php echo e($orders_count); ?></h2>
               <h6 class="card-text"></h6>
            </div>
         </div>
      </div>


      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
           <div class="card-body">
              <h4 class="font-weight-normal mb-3">Total Sales <i class="mdi mdi-chart-line mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">₹ <?php echo e($total_sales); ?></h2>
              <h6 class="card-text"></h6>
           </div>
        </div>
     </div>
     <div class="col-md-4 stretch-card grid-margin" onclick="location.href='<?php echo e(url('superadmin/customers')); ?>'">
         <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
               <h4 class="font-weight-normal mb-3">Active Customers <i class="mdi mdi-diamond mdi-24px float-right"></i>
               </h4>
               <h2 class="mb-5"><?php echo e($active_customers); ?></h2>
               <h6 class="card-text"></h6>
            </div>
         </div>
      </div>

   </div>

</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<!-- partial -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/dashboard/manage.blade.php ENDPATH**/ ?>