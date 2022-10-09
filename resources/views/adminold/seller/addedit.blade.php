@extends('layouts.admin2')
@section('title','Seller') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> create Seller </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">create Seller</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">User Details</h4>
               {!! Form::model($senddata, ['route' => $route, 'method' => $method, 'id'=>"formValidate" , 'novalidate'=>"true", 'files' => true]) !!}
               <div class="form-group">
                  <label for="first_name">User Name</label>
                  {{ Form::text('first_name',old('first_name'),['class' => 'form-control','data-error' => 'Enter Your User Name','placeholder'=>'Enter Your User Name','required'=>'required','type'=>'text'] )}}
                  @if($errors->has('first_name'))
                  <div class="error_span help-text text-danger">{{ $errors->first('first_name') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="mobile_number">Mobile Number</label>
                  {{ Form::number('mobile_number',old('mobile_number'),['class' => 'form-control','data-error' => 'Enter Your Mobile Number','placeholder'=>'Enter Your Mobile Number','required'=>'required','type'=>'number','min'=>"1",'max'=>"9999999999"] )}}
                  @if($errors->has('mobile_number'))
                  <div class="error_span help-text text-danger">{{ $errors->first('mobile_number') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="email">Email Id</label>
                  {{ Form::text('email',old('email'),['class' => 'form-control','data-error' => 'Enter Your Email','placeholder'=>'Enter Your Email','required'=>'required','type'=>'text'] )}}
                  @if($errors->has('email'))
                  <div class="error_span help-text text-danger">{{ $errors->first('email') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="">Password</label>
                  {{ Form::password('password',['class' => 'form-control','data-error' => 'Enter Your Password','placeholder'=>'Enter Your Password','required'=>'required','type'=>'password'] )}}
                  @if($errors->has('password'))
                  <div class="error_span help-text text-danger">{{ $errors->first('password') }}</div>
                  @endif
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Seller Details</h4>
               <div class="form-group">
                  <label for="first_name">Store Name</label>
                  {{ Form::text('storedetails[sd_sname]',old('sd_sname'),['class' => 'form-control','data-error' => 'Enter Your Store Name','placeholder'=>'Enter Your Store Name','required'=>'required','type'=>'text'] )}}
                  @if($errors->has('storedetails.sd_sname'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_sname') }}</div>
                  @endif
               </div>
			    <div class="form-group">
				<label for="first_name">Main Category</label>
				{!! Form::select('storedetails[main_category]', (['' => '--Select a Category--'] + $main_category), ($senddata->main_category) ? $senddata->main_category : null ,['class' => 'form-control','data-error' => 'Choose Main Category']) !!}                    
                  <div class="help-block form-text with-errors form-control-feedback"></div>
                  @if( $errors->has('storedetails.main_category') )
                  <div class="error_span help-text text-danger"> {{ $errors->first('storedetails.main_category') }}</div>
                  @endif
                  
               </div>
               <div class="form-group">
                  <label for="mobile_number">Store Number</label>
                  {{ Form::number('storedetails[sd_snumber]',old('sd_snumber'),['class' => 'form-control','data-error' => 'Enter Your Store Mobile Number','placeholder'=>'Enter Your Store Mobile Number','required'=>'required','type'=>'number','min'=>"1",'max'=>"9999999999"] )}}
                  @if($errors->has('storedetails.sd_snumber'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_snumber') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="email">Store AdminShare</label>
                  {{ Form::text('storedetails[sd_sadminshare]',old('sd_sadminshare'),['class' => 'form-control','data-error' => 'Enter Your Store AdminShare','placeholder'=>'Enter Your Store AdminShare','required'=>'required','type'=>'text'] )}}
                  @if($errors->has('storedetails.sd_sadminshare'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_sadminshare') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="">Store City</label>
                  {!! Form::select('storedetails[sd_scityid]', (['' => '--Select a City--'] + $cityvalue), ($senddata->sd_scityid) ? $senddata->sd_scityid : null ,['class' => 'form-control','data-error' => 'Choose City']) !!}                    
                  <div class="help-block form-text with-errors form-control-feedback"></div>
                  @if( $errors->has('storedetails.sd_scityid') )
                  <div class="error_span help-text text-danger"> {{ $errors->first('storedetails.sd_scityid') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="">Store DeliveryKm</label>
                  {{ Form::number('storedetails[sd_sdeliverykm]',old('sd_sdeliverykm'),['class' => 'form-control','data-error' => 'Enter Your Store DeliveryKm','placeholder'=>'Enter Your Store DeliveryKm','required'=>'required','type'=>'number','min'=>"1",'max'=>"10000"] )}}
                  @if($errors->has('storedetails.sd_sdeliverykm'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_sdeliverykm') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="email">Store Address</label>
                  {{ Form::text('storedetails[sd_address]',old('sd_address'),['class' => 'form-control','data-error' => 'Enter Your Store Address','placeholder'=>'Enter Your Store Address','required'=>'required','type'=>'text'] )}}
                  @if($errors->has('storedetails.sd_address'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_address') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="email">Store Pincode</label>
                  {{ Form::number('storedetails[sd_spincode]',old('sd_spincode'),['class' => 'form-control','data-error' => 'Enter Your Store Pincode','placeholder'=>'Enter Your Store Pincode','required'=>'required','type'=>'number','min'=>"1",'max'=>"9999999"] )}}
                  @if($errors->has('storedetails.sd_spincode'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_spincode') }}</div>
                  @endif
               </div>
               <div class="form-group">
             
                    <label for="first_name">Store Logo</label>
                    {{ Form::file('store_logo', old('store_logo'), ['class' => 'form-control']) }}
                    @if($errors->has('store_logo'))
                    <div class="error_span help-text text-danger">{{ $errors->first('store_logo') }}</div>
                    @endif
               </div>
               <div class="form-group">
                  @if($senddata->id!="")
                     <img src="{{url('admin/images/store_logo/')}}/{{$seller->store_logo}}" alt="" class="img-thumbnail" height="100" width="100" id="preview1"/>
                     <a style="cursor:pointer" onclick="removelogo()" id="remove1">Remove</a>
                     <input type="hidden" name="findremove" id="findremove1">
                  @endif  

               </div><br>
               <div class="form-group">
                    <label for="first_name">Store Image</label>
                    {{ Form::file('store_image', old('store_image'), ['class' => 'form-control']) }}
                    @if($errors->has('store_image'))
                    <div class="error_span help-text text-danger">{{ $errors->first('store_image') }}</div>
                    @endif
               </div>
               <div class="form-group">
                   
                  @if($senddata->id!="")
                     <img src="{{url('admin/images/store_image/')}}/{{$seller->store_image}}" alt="" class="img-thumbnail" height="100" width="100" id="preview"/>
                     <a style="cursor:pointer" onclick="removeimg()" id="remove">Remove</a>
                     <input type="hidden" name="findremove" id="findremove">
                  @endif  

               </div>
            </div>
         </div>
      </div>
      <button type="submit" class="btn btn-gradient-primary mr-2" style="margin-left: 45%">Submit</button>
      </form>
   </div>
</div>

<script type="text/javascript">

function removeimg()
{
   document.getElementById("preview").style.display="none";
   document.getElementById("remove").style.display="none";
   document.getElementById("findremove").value="1";
}

function removelogo()
{
   document.getElementById("preview1").style.display="none";
   document.getElementById("remove1").style.display="none";
   document.getElementById("findremove").value="1";
}
</script>
@endsection