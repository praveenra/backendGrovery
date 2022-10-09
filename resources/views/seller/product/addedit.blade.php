@extends('layouts.seller')
@section('title','Seller') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> create Product </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Seller</a></li>
            <li class="breadcrumb-item active" aria-current="page">create Product</li>
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
                    <label for="">Brand</label>
                    {!! Form::select('brand_id', (['' => '--Select a Brand--']+ $brand), ($senddata->brand_id) ? $senddata->brand_id : null ,['class' => 'form-control','data-error' => 'Choose brand','id' => 'brand_id']) !!}                    
                    <div class="help-block form-text with-errors form-control-feedback"></div>
                    
                 </div> 
				 
				 <div class="form-group">
                   
					@php
					$sellerid=auth()->guard('seller')->user()->id;
					@endphp
                    {{ Form::hidden('seller_id',$sellerid , ['class' => 'form-control','readonly', 'placeholder' => 'Seller Id']) }}              
                    <div class="help-block form-text with-errors form-control-feedback"></div>
                    @if( $errors->has('seller_id') )
                    <div class="error_span help-text text-danger"> {{ $errors->first('seller_id') }}</div>
                    @endif
                 </div> 
				 
                  <div class="form-group">
                    <label for="">Measurement</label>
                    {!! Form::select('measurement_id', (['' => '--Select a Measurement--'] + $measurement), ($senddata->measurement_id) ? $senddata->measurement_id : null ,['class' => 'form-control','data-error' => 'Choose Measurement']) !!}                    
                    <div class="help-block form-text with-errors form-control-feedback"></div>
                    @if( $errors->has('measurement_id') )
                    <div class="error_span help-text text-danger"> {{ $errors->first('measurement_id') }}</div>
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
                    {{ Form::textarea('product_long_description', old('product_long_description'), ['class' => 'form-control', 'placeholder' => 'Product Long Description']) }}
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
                                <td>Measurement</td>
                                <td>Quantity</td>
                                <td>Price</td>
                                <td>Offer %</td>
                                <td>Sales Price</td>
                            </tr>
                        </thead>
                        <tbody>
                          @if($action == 'Add')
                            <tr>
                                <td><input type="text" class="form-control" name="form_data[0][measurement]" placeholder="Measurement"></td>
                                <td><input type="text" class="form-control" name="form_data[0][quantity]" placeholder="Quantity"></td>
                                <td><input type="text" class="form-control price" name="form_data[0][price]" placeholder="Price"></td>
                                <td><input type="text" class="form-control offer" name="form_data[0][offer]" placeholder="Offer"></td>
                                <td><input type="text" class="form-control sales_price" name="form_data[0][sales_price]" placeholder="Sales Price" readonly required></td>
                            </tr>
                          @endif
                          @if($action == 'Edit')
                            @foreach($product_quantity as $key => $data)
                            <tr>
                                <td><input type="text" class="form-control" name="form_data[{{$key}}][measurement]" placeholder="Measurement" value="{{$data->measurement}}"></td>
                                <td><input type="text" class="form-control" name="form_data[{{$key}}][quantity]" placeholder="Quantity" value="{{$data->quantity}}" required></td>
                                <td><input type="text" class="form-control price" name="form_data[{{$key}}][price]" placeholder="Price" value="{{$data->price}}" required></td>
                                <td><input type="text" class="form-control offer" name="form_data[{{$key}}][offer]" placeholder="Offer" value="{{$data->offer}}"></td>
                                <td><input type="text" class="form-control sales_price" name="form_data[{{$key}}][sales_price]" placeholder="Sales Price" value="{{$data->sales_price}}" readonly required></td>
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
                            $('#product_details').append('<tr class="dynamic-added"><td><input type="text" class="form-control" name="form_data['+i+'][measurement]" placeholder="Measurement"></td><td><input type="text" class="form-control" name="form_data['+i+'][quantity]" placeholder="Quantity" required></td><td><input type="text" class="form-control price" name="form_data['+i+'][price]" placeholder="Price" required></td><td><input type="text" class="form-control offer" name="form_data['+i+'][offer]" placeholder="Offer"></td><td><input type="text" class="form-control sales_price" name="form_data['+i+'][sales_price]" placeholder="Sales Price" required readonly></td><td><i class="fa fa-times btn_remove" name="remove" style="cursor: pointer; color: red; font-size: 20px; "></i></td></tr>');  
                          });

                           $("body").on("keyup",".price",function(){

                            var a = $(this).val();
                            var r = $(this).closest('td').siblings().find('.sales_price').val(a);

                          });

                          $("body").on("keyup",".offer",function(){

                            var a = $(this).closest('td').siblings().find('.price').val();
                            var b = $(this).val();
                            var output = (parseInt(a) * parseInt(b)) / 100;
                            var result = parseInt(a) - output;
                            var r = $(this).closest('td').siblings().find('.sales_price').val(result);

                          });

                      });

                      $(document).on('click', '.btn_remove', function(){  
                          var remove = $(this).closest("tr").remove();   
                      }); 
                  </script>
                <!-- <div class="form-group">
                    <label for="first_name">Product Stock</label>
                    {{ Form::text('product_stock', old('product_stock'), ['class' => 'form-control', 'placeholder' => 'Product Stock']) }}
                    @if($errors->has('product_stock'))
                    <div class="error_span help-text text-danger">{{ $errors->first('product_stock') }}</div>
                    @endif
                 </div>-->
                <!--  <div class="form-group">
                    <label for="first_name">Product Price</label>
                    {{ Form::text('product_price', old('product_price'), ['class' => 'form-control', 'placeholder' => 'Product Price']) }}
                    @if($errors->has('product_price'))
                    <div class="error_span help-text text-danger">{{ $errors->first('product_price') }}</div>
                    @endif
                 </div> -->
                 <div class="form-group">
                    <label for="first_name">Product Tax</label>
                    {{ Form::text('product_tax', old('product_tax'), ['class' => 'form-control', 'placeholder' => 'Product Tax']) }}
                    @if($errors->has('product_tax'))
                    <div class="error_span help-text text-danger">{{ $errors->first('product_tax') }}</div>
                    @endif
                 </div>
                <!--  <div class="form-group">
                    <label for="first_name">Product Sales Price</label>
                    {{ Form::text('product_sales_price', old('product_sales_price'), ['class' => 'form-control', 'placeholder' => 'Product Sales Price']) }}
                    @if($errors->has('product_sales_price'))
                    <div class="error_span help-text text-danger">{{ $errors->first('product_sales_price') }}</div>
                    @endif
                 </div> -->
                 <!-- <div class="form-group">
                    <label for="first_name">Product Offer</label>
                    {{ Form::text('product_offer', old('product_offer'), ['class' => 'form-control', 'placeholder' => 'Product Offer']) }}
                    @if($errors->has('product_offer'))
                    <div class="error_span help-text text-danger">{{ $errors->first('product_offer') }}</div>
                    @endif
                 </div> -->
				 
				 <div class="form-group">
                    <label for="first_name">Main Image</label>
                    <input type="file" name="main_image" value="{{old('main_image')}}" class="form-control" onchange="loadImage(this);">
                    <div style="margin-left:10px;">
                                    <img src="" id="img_preview">
                                </div>
                    @if($errors->has('main_image'))
                    <div class="error_span help-text text-danger">{{ $errors->first('main_image') }}</div>
                    @endif
					@if($senddata['main_image']!="")
					<img src="{{url('/admin/images/products/')}}/{{$senddata['main_image']}}" height="100" width="100" id="preview"><a style="cursor:pointer" onclick="removeimg()" id="remove">Remove</a>
					<input type="hidden" name="findremove" id="findremove">
					@endif
                 </div>

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
                        <label class="form-control-label" for="input-email">Additional Images</label>
                       <!-- <input type="text" id="address" name="address" class="form-control" placeholder="Address">-->
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

<script>
$('#product_category_id').on('change',function(){
  var cate_id = $(this).val();   //alert(stateID);
  if(cate_id){
    $.ajax({
      type:"GET",
      url:"{{url('seller/product/get_subcategory')}}?cate_id="+cate_id,
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
      url:"{{url('seller/product/get_brand')}}?cate_id="+cate_id,
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
function removeimages(id)
  {
	  document.getElementById('div_'+id).style.display="none";
	$.ajax({
	  type:"GET",
	  url:"{{url('seller/product/remove_images')}}?id="+id,
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
@endsection