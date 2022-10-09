<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

@extends('layouts.admin')
@section('title','Product') 
@section('content')

<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Product </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Product</h4>
               {!! Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="first_name">Product Name</label>
                     {{ Form::text('product_name', old('product_name'), ['class' => 'form-control', 'placeholder' => 'Product Name']) }}
                     @if($errors->has('product_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('product_name') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                    <label for="">Category</label>
                    {!! Form::select('product_category_id', (['' => '--Select a Category--'] + $category), ($senddata->product_category_id) ? $senddata->product_category_id : null ,['class' => 'form-control','data-error' => 'Choose Category','id' => 'product_category_id']) !!}                    
                    <div class="help-block form-text with-errors form-control-feedback"></div>
                    @if( $errors->has('product_category_id') )
                    <div class="error_span help-text text-danger"> {{ $errors->first('product_category_id') }}</div>
                    @endif
                 </div> 
				 
				          <div class="form-group">
                    <label for="">Sub Category</label>
                    {!! Form::select('sub_category_id', (['' => '--Select a Sub Category--']+ $subcategory), ($senddata->sub_category_id) ? $senddata->sub_category_id : null ,['class' => 'form-control','data-error' => 'Choose Sub Category','id' => 'sub_category_id']) !!}                    
                    <div class="help-block form-text with-errors form-control-feedback"></div>
                    
                 </div>
                 <div class="form-group">
                    <label for="">Sub Sub Category</label>
                    {!! Form::select('sub_sub_category_id', (['' => '--Select a Sub Sub Category--']+ $subsubcategory), ($senddata->sub_sub_category_id) ? $senddata->sub_sub_category_id : null ,['class' => 'form-control','data-error' => 'Choose Sub Sub Category','id' => 'sub_sub_category_id']) !!}                    
                    <div class="help-block form-text with-errors form-control-feedback"></div>
                    
                 </div> 

        				 <div class="form-group">
                    <label for="">Brand</label>
                    {!! Form::select('brand_id', (['' => '--Select a Brand--']+ $brand), ($senddata->brand_id) ? $senddata->brand_id : null ,['class' => 'form-control','data-error' => 'Choose Sub Category','id' => 'brand_id']) !!}                    
                    <div class="help-block form-text with-errors form-control-feedback"></div>
                    
                 </div> 
				 
        				 <div class="form-group">
                    <label for="">Seller</label>
                    {!! Form::select('seller_id', (['' => '--Select a Seller--'] + $seller), ($senddata->seller_id) ? $senddata->seller_id : null ,['class' => 'form-control','data-error' => 'Choose Seller']) !!}                    
                    <div class="help-block form-text with-errors form-control-feedback"></div>
                    @if( $errors->has('seller_id') )
                    <div class="error_span help-text text-danger"> {{ $errors->first('seller_id') }}</div>
                    @endif
                 </div> 
                  <div class="form-group">
                    <label for="first_name">Product Short Description</label>
                    {{ Form::text('product_short_description', old('product_short_description'), ['class' => 'form-control', 'placeholder' => 'Product Short Description']) }}
                    @if($errors->has('product_short_description'))
                    <div class="error_span help-text text-danger">{{ $errors->first('product_short_description') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="first_name">Product Long Description</label>
                    {{ Form::textarea('product_long_description', old('product_long_description'), ['class' => 'form-control', 'id' => 'product_long_description', 'placeholder' => 'Product Long Description']) }}
                    @if($errors->has('product_long_description'))
                    <div class="error_span help-text text-danger">{{ $errors->first('product_long_description') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <div class="row" style="margin-left: 0px;">
                        <div class="col-md-9">
                            <label for="first_name">Product Details</label>
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="add_more" class="btn btn-danger pull-right">Add More</button>
                        </div>
                    </div><br><br>
                   <table id="product_details">
                        <thead>
                            <tr style="font-size: 14px;">
                                <td>Availability</td>
                                <td>Measurement</td>
                                <td>Price</td>
                                <td>Sales Price</td>
                                <td>Offer %</td>
                            </tr>
                        </thead>
                        <tbody>
                          @if($action == 'Add')
                            <tr>
                                <td><input type="checkbox" name="form_data[0][availability]"required> </td>
                                <td><input type="text" class="form-control" id="measurement_number_format" name="form_data[0][measurement]" placeholder="Measurement" required></td>
                                <td><input type="text" class="form-control price" id="price_number_format" name="form_data[0][price]" placeholder="Price" required></td>
                                <td><input type="text" class="form-control sales_price" id="sales_price_number_format" name="form_data[0][sales_price]" placeholder="Sales Price" required></td>
                                <td><input type="text" class="form-control offer" name="form_data[0][offer]" placeholder="Offer" readonly></td>
                            </tr>
                          @endif
                          @if($action == 'Edit')
                            @foreach($product_quantity as $key => $data)
                            <tr>
                                <input type="hidden" name="form_data[{{$key}}][id]" value="{{$data->id}}">
                                <td><input type="checkbox" name="form_data[{{$key}}][availability]" {{$data->availability == "on" ? "checked" : ""}}></td>
                                <td><input type="text" class="form-control" name="form_data[{{$key}}][measurement]" placeholder="Measurement" id="measurement_number_format" value="{{$data->measurement}}"></td>
                                <td><input type="text" class="form-control price" name="form_data[{{$key}}][price]" id="price_number_format" placeholder="Price" value="{{$data->price}}" required></td>
                                <td><input type="text" class="form-control sales_price" id="sales_price_number_format" name="form_data[{{$key}}][sales_price]" placeholder="Sales Price" value="{{$data->sales_price}}" required></td>
                                <td><input type="text" class="form-control offer" name="form_data[{{$key}}][offer]" placeholder="Offer" value="{{$data->offer}}" readonly></td>
                                <td><i class="fa fa-times btn_remove" name="remove" style="cursor: pointer; color: red; font-size: 20px;"></i></td>
                            </tr>
                            @endforeach
                          @endif
                        </tbody>
                   </table>
                  </div>
                  <input type="hidden" name="quantity_count" id="quantity_count" value="{{$quantity_count}}">
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
                  <script type="text/javascript">
                      
                      $(document).ready(function(){
                          
                          var i = $("#quantity_count").val();

                          $("#add_more").click(function(){
                            i++;
                            $('#product_details').append('<tr class="dynamic-added"><input type="hidden" name="form_data['+i+'][id]" value=""><td><input type="checkbox" name="form_data['+i+'][availability]"></td><td><input type="text" class="form-control" name="form_data['+i+'][measurement]" placeholder="Measurement"></td><td><input type="text" class="form-control price" name="form_data['+i+'][price]" placeholder="Price" required></td><td><input type="text" class="form-control sales_price" name="form_data['+i+'][sales_price]" placeholder="Sales Price" required><td><input type="text" class="form-control offer" name="form_data['+i+'][offer]" placeholder="Offer" readonly></td></td><td><i class="fa fa-times btn_remove" name="remove" style="cursor: pointer; color: red; font-size: 20px; "></i></td></tr>');  
                          });


                          $("body").on("keyup",".sales_price",function(){

                            var a = $(this).closest('td').siblings().find('.price').val();
                            var b = $(this).val();
                            var output = 100 - (parseInt(b) * 100 / parseInt(a));
                            var r = $(this).closest('td').siblings().find('.offer').val(output);

                          });

                      });

                      $(document).on('click', '.btn_remove', function(){  
                          var remove = $(this).closest("tr").remove();   
                      }); 
                  </script>

                 <div class="form-group">
                    <label for="first_name">Product Tax</label>
                    <td><input type="text" class="form-control" id="product_tax_number_format" value="{{old('product_tax')}}" name="product_tax" placeholder="Product Tax"></td>
                    @if($errors->has('product_tax'))
                    <div class="error_span help-text text-danger">{{ $errors->first('product_tax') }}</div>
                    @endif
                 </div>

				 
        				 <div class="form-group">
                    <label for="first_name">Main Image</label><br><br>
                    <input type="file" name="main_image" value="{{old('main_image')}}" class="form-control" onchange="loadImage(this);">
                    <div style="margin-left:10px;">
                                    <img src="" id="img_preview">
                                </div>
                    <!-- {{ Form::file('main_image', old('main_image'), ['class' => 'form-control']) }} -->
                    @if($errors->has('main_image'))
                    <div class="error_span help-text text-danger">{{ $errors->first('main_image') }}</div>
                    @endif
          					@if($senddata['main_image']!="")
          					<img src="{{url('admin/images/products/')}}/{{$senddata['main_image']}}" height="100" width="100" id="preview"><a style="cursor:pointer" onclick="removeimg()" id="remove">Remove</a>
          					<input type="hidden" name="findremove" id="findremove">
          					@endif
                 </div><br>
                 <script type="text/javascript">
                   function loadImage(input, id) {
                        id = id || '#img_preview';
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                            $(id)
                                .attr('src', e.target.result)
                                .width(100)
                                .height(100);
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                  </script>
				
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Additional Images</label><br><br>
            						<input type="file" name="images[]" id="images" multiple >
                      </div> @if($senddata['product_id']!="")
        						 <div class="form-group">
        						      <div class="box">
        							 
        							  @foreach($upload as $uploads)
        							  
        								<div id="div_{{$uploads['id']}}"><img src="{{url('/admin/images/products/')}}/{{$uploads['image_name']}}" height="100" width="100" id="preview_{{$uploads['id']}}"><a style="cursor:pointer" onclick="removeimages({{$uploads['id']}})" id="remove">Remove</a></div>
        								@endforeach
        							  </div>
        					  </div>
                      @endif

                 <div class="form-group">
                    <label for="first_name">Product Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('product_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('product_status', 0) }} In Active</label>
                     </div>
                 </div>

                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
  .box {
    display: flex;
    flex-wrap: wrap;
  }
  .box>* {
    flex: 1 1 160px;
  }
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<script>
  CKEDITOR.replace( 'product_long_description' );
$('#product_category_id').on('change',function(){
  var cate_id = $(this).val();   //alert(stateID);
  if(cate_id){
    $.ajax({
      type:"GET",
      url:"{{url('superadmin/products/get_subcategory')}}?cate_id="+cate_id,
      success:function(res){        
      if(res){
        $("#sub_category_id").empty();
        $("#sub_category_id").append('<option value="" disabled selected>Select</option>');
        console.log(res);
        $.each(res,function(key,value){
          $("#sub_category_id").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#sub_category_id").empty();
      }
      }
    });
  }else{
    $("#sub_category_id").empty();
  }
  
  var cate_id = $(this).val();   //alert(stateID);
  if(cate_id){
    $.ajax({
      type:"GET",
      url:"{{url('superadmin/products/get_brand')}}?cate_id="+cate_id,
      success:function(res){        
      if(res){
        $("#brand_id").empty();
        $("#brand_id").append('<option value="" disabled selected>Select</option>');
        console.log(res);
        $.each(res,function(key,value){
          $("#brand_id").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#brand_id").empty();
      }
      }
    });
  }else{
    $("#brand_id").empty();
  }
});

$('#sub_category_id').on('change',function(){
  var sub_id = $(this).val();
  if(sub_id){
    $.ajax({
      type:"GET",
      url:"{{url('superadmin/products/get_subsubcategory')}}?sub_id="+sub_id,
      success:function(res){        
      if(res){
        $("#sub_sub_category_id").empty();
        $("#sub_sub_category_id").append('<option value="" disabled selected>Select</option>');
        console.log(res);
        $.each(res,function(key,value){
          $("#sub_sub_category_id").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#sub_sub_category_id").empty();
      }
      }
    });
  }else{
    $("#sub_sub_category_id").empty();
  }
  
});
function removeimages(id)
  {
	  document.getElementById('div_'+id).style.display="none";
	$.ajax({
	  type:"GET",
	  url:"{{url('superadmin/products/remove_images')}}?id="+id,
	  success:function(res){  
	  }
	});		
  }
  
function removeimg()
{
	document.getElementById("preview").style.display="none";
	document.getElementById("remove").style.display="none";
	document.getElementById("findremove").value="1";
}
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#measurement_number_format").keypress(function (e) {
          var keyCode = e.keyCode || e.which;

          var regex = /^[0-9]+$/;

          //Validate TextBox value against the Regex.
          var isValid = regex.test(String.fromCharCode(keyCode));
          return isValid;
        
      });

    $("#price_number_format").keypress(function (e) {
          var keyCode = e.keyCode || e.which;

          var regex = /^[0-9]+$/;

          //Validate TextBox value against the Regex.
          var isValid = regex.test(String.fromCharCode(keyCode));
          return isValid;
        
      });

    $("#sales_price_number_format").keypress(function (e) {
          var keyCode = e.keyCode || e.which;

          var regex = /^[0-9]+$/;

          //Validate TextBox value against the Regex.
          var isValid = regex.test(String.fromCharCode(keyCode));
          return isValid;
        
      });

    $("#product_tax_number_format").keypress(function (e) {
          var keyCode = e.keyCode || e.which;

          var regex = /^[0-9]+$/;

          //Validate TextBox value against the Regex.
          var isValid = regex.test(String.fromCharCode(keyCode));
          return isValid;
        
      });

    });
</script>

@endsection