@extends('layouts.admin2')
@section('title','Delivery Boy') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> create Delivery Boy </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">create Delivery Boy</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Deliveryboy Details</h4>
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
                    <label for="">Alternative Number</label>
                    <input type="text" name="alternative_number" class="form-control" value="{{$senddata->alternative_number}}" required placeholder="Enter Alternative Number">
                    @if($errors->has('alternative_number'))
                    <div class="error_span help-text text-danger">{{ $errors->first('alternative_number') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="">Aadhar Number</label>
                    <input type="text" name="aadhar" class="form-control" value="{{$senddata->aadhar}}" required placeholder="Enter Aadhar Number">
                    @if($errors->has('aadhar'))
                    <div class="error_span help-text text-danger">{{ $errors->first('aadhar') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="">Driving License Number</label>
                    <input type="text" name="driving_license_no" class="form-control" value="{{$senddata->driving_license_no}}" required placeholder="Enter Driving License Number">
                    @if($errors->has('driving_license_no'))
                    <div class="error_span help-text text-danger">{{ $errors->first('driving_license_no') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="">Driving License Expiry</label>
                    <input type="text" name="driving_license_expiry" class="form-control" value="{{$senddata->driving_license_expiry}}" required placeholder="Enter Driving License Expiry">
                    @if($errors->has('driving_license_expiry'))
                    <div class="error_span help-text text-danger">{{ $errors->first('driving_license_expiry') }}</div>
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
                <div class="form-group">
                    <label for="">Deliveryboy City</label>
                    {!! Form::select('city_id', (['' => '--Select a City--'] + $cityvalue), ($senddata->city_id) ? $senddata->city_id : null ,['class' => 'form-control','data-error' => 'Choose City']) !!}                    
                    <div class="help-block form-text with-errors form-control-feedback"></div>
                    @if( $errors->has('city_id') )
                    <div class="error_span help-text text-danger"> {{ $errors->first('city_id') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="">Deliveryboy Address</label>
                    {{ Form::textarea('address',old('address'),['class' => 'form-control','data-error' => 'Enter Your Delivery Address','placeholder'=>'Enter Your Delivery Address','required'=>'required','type'=>'text'] )}}
                    @if($errors->has('address'))
                    <div class="error_span help-text text-danger">{{ $errors->first('address') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="">Bank Details</label>
                    <table>
                      <thead>
                        <tr>
                          <th>Bank Name</th>
                          <th>Account Number</th>
                          <th>IFSC Code</th>
                          <th>Pan Card No</th>
                          <th>Max. Security Deposit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input type="text" name="bank_name" class="form-control" value="{{$bank->bank_name}}" required placeholder="Bank Name"></td>
                          <td><input type="text" name="acc_no" class="form-control" value="{{$bank->acc_no}}" required placeholder="Account Number"></td>
                          <td><input type="text" name="ifsc" class="form-control" value="{{$bank->ifsc}}" required placeholder="IFSC Code"></td>
                          <td><input type="text" name="pan" class="form-control" value="{{$bank->pan}}" required placeholder="Pan Card Number"></td>
                          <td><input type="text" name="max_deposit" class="form-control" value="{{$bank->max_deposit}}" required placeholder="Max. Security Deposit"></td>
                        </tr>
                      </tbody>
                    </table>
                 </div>
                 <div class="form-group">
                    <label for="first_name">Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('user_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('user_status', 0) }} In Active</label>
                     </div>
                 </div>
                 <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection