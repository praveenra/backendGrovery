<style type="text/css">
   body {
  background: #20262E;
  padding: 20px;
  font-family: Helvetica;
}

.message {
  background: #fff;
  border-radius: 4px;
  padding: 4px;
  font-size: 14px;
  transition: all 0.2s;
  width:350px;
  height:100px;
}

</style>


<?php $__env->startSection('title','Membership Plan'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Membership Plan </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Membership Plan</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Membership Plan</h4>
               <form action="<?php echo e(url('superadmin/save_plan')); ?>" method="post">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="id" value="<?php echo e($plan->id); ?>">
                  <div class="form-group">
                     <label for="first_name">Plan Name</label>
                        <input type="text" name="plan_name" class="form-control" value="<?php echo e($plan->plan_name); ?>" placeholder="Plan Name" required="">
                        <?php if($errors->has('plan_name')): ?>
                           <div class="error_span help-text text-danger"><?php echo e($errors->first('plan_name')); ?></div>
                        <?php endif; ?>
                  </div>
				      <div class="form-group">
                     <label for="first_name">Plan Duration</label>
                     <input type="text" name="plan_duration" class="form-control" value="<?php echo e($plan->plan_duration); ?>" placeholder="Plan Duration" required="">
                     <?php if($errors->has('plan_duration')): ?>
                        <div class="error_span help-text text-danger"><?php echo e($errors->first('plan_duration')); ?></div>
                     <?php endif; ?>
                  </div>
				      
                  <div class="form-group">
                     <label for="first_name">Plan Limit</label>
                     <input type="text" name="plan_limit" class="form-control" id="plan_limit_number_format" value="<?php echo e($plan->plan_limit); ?>" placeholder="Plan Limit">
                     <div class="help-block form-text with-errors form-control-feedback"></div>
                     <?php if( $errors->has('plan_limit') ): ?>
                        <div class="error_span help-text text-danger"> <?php echo e($errors->first('plan_limit')); ?></div>
                     <?php endif; ?>
                  </div>
                  <div class="form-group">
                     <label for="first_name">Original Plan Amount</label>
                     <input type="text" name="original_plan_amount"  id="original_plan_amount_number_format" class="form-control" value="<?php echo e($plan->original_plan_amount); ?>" placeholder="Original Plan Amount">
                     <?php if($errors->has('original_plan_amount')): ?>
                        <div class="error_span help-text text-danger"><?php echo e($errors->first('original_plan_amount')); ?></div>
                     <?php endif; ?>
                  </div>
				      <div class="form-group">
                     <label for="first_name">Plan Amount</label>
                     <input type="text" name="plan_amount" class="form-control" id="plan_amount_number_format" value="<?php echo e($plan->plan_amount); ?>" placeholder="Plan Amount">
                     <?php if($errors->has('plan_amount')): ?>
                        <div class="error_span help-text text-danger"><?php echo e($errors->first('plan_amount')); ?></div>
                     <?php endif; ?>
                  </div>
				      <div class="form-group">
                     <label for="first_name">Description</label>

                     <textarea id="banner-message" class="message form-control"  name="description"><?php echo e($plan->description); ?>

                     </textarea>

                     <div id="display" class="message" style="overflow-y:auto">
                     </div>


                     <!-- <textarea class="form-control" name="description"><?php echo e($plan->description); ?></textarea> -->
                     <?php if($errors->has('description')): ?>
                        <div class="error_span help-text text-danger"><?php echo e($errors->first('description')); ?></div>
                     <?php endif; ?>
                  </div>

                  <div class="form-group">
                     <label for="offer">Offer</label>
                     <input type="checkbox" name="free_delivery" value="free_delivery"> Free Delivery
                     <input type="checkbox" name="carry_bag" id="check_coupon" value="carry_bag"> Carry Bag

                     <?php if($errors->has('free_delivery')): ?>
                        <div class="error_span help-text text-danger"><?php echo e($errors->first('free_delivery')); ?></div>
                     <?php endif; ?>
                     <?php if($errors->has('carry_bag')): ?>
                        <div class="error_span help-text text-danger"><?php echo e($errors->first('carry_bag')); ?></div>
                     <?php endif; ?>
                  </div>

                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                  <script type="text/javascript">
                     
                     var strings = [];
                     
                     var htmlContent='';
                     var textAreaContent='';
                     $(document).ready(function(){
                        strings.forEach(element => htmlContent += "<li>"+element+"</li>");
                        $("#display").html(htmlContent);
                        var i=1;
                        strings.forEach(function(element){ 
                        if(strings.length==i)
                           textAreaContent += ">"+ element;
                         else
                           textAreaContent += ">"+ element+"\n";
                         i++;
                       });
                       $("#banner-message").val(textAreaContent);  
                     })

                     $("#display").click(function(){
                        $(this).css("display","none");
                       $("#banner-message").css("display","");
                       var currentText= $("#banner-message").val();
                       //currentText+="\n>";
                       $("#banner-message").val(currentText);
                        $("#banner-message").focus();
                     });

                     $("#banner-message").blur(function(){
                      var currentText=$("#banner-message").val();
                      var plainText=currentText.replace(/>/g, "")
                      var splitText=plainText.split("\n");
                      console.log(splitText);
                        htmlContent='';
                        splitText.forEach(element => htmlContent += "<li>"+element+"</li>");
                        $("#display").html(htmlContent);
                       
                        $(this).css("display","none");
                       $("#display").css("display","");
                     })

                     $("#banner-message").keyup(function(e) {
                        var code = e.keyCode ? e.keyCode : e.which;
                        if (code == 13) {  
                                 var text=$(this).val();
                             text+=">";
                             $(this).val(text);
                          }
                        });
                  </script>


                  <div class="form-group">
                    <label for="first_name">Plan Status</label>
                    <div class="radio-list">
                        <input type="radio" name="plan_status" value="1" checked <?php echo e($plan->plan_status == '1' ? 'checked' : ''); ?>> Active &nbsp;
                        <input type="radio" name="plan_status" value="0" <?php echo e($plan->plan_status == '0' ? 'checked' : ''); ?>> Inactive
                     </div>
                 </div>
                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){

    $("#plan_limit_number_format").keypress(function (e) {
          var keyCode = e.keyCode || e.which;

          var regex = /^[0-9]+$/;

          //Validate TextBox value against the Regex.
          var isValid = regex.test(String.fromCharCode(keyCode));
          return isValid;
        
      });

    $("#original_plan_amount_number_format").keypress(function (e) {
          var keyCode = e.keyCode || e.which;

          var regex = /^[0-9]+$/;

          //Validate TextBox value against the Regex.
          var isValid = regex.test(String.fromCharCode(keyCode));
          return isValid;
        
      });

    $("#plan_amount_number_format").keypress(function (e) {
          var keyCode = e.keyCode || e.which;

          var regex = /^[0-9]+$/;

          //Validate TextBox value against the Regex.
          var isValid = regex.test(String.fromCharCode(keyCode));
          return isValid;
        
      });

    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\Laravel\backendGrovery\resources\views/superadmin/plan/addedit.blade.php ENDPATH**/ ?>