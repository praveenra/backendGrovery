@extends('layouts.admin')
@section('title','Admin') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Admin </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Admin</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Admin Details</h4>
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
                <div class="form-group">
                    <label for="first_name">User Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('user_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('user_status', 0) }} In Active</label>
                     </div>
                 </div><br>
                 <div class="form-group">
                    <label for="first_name">Permissions</label><br>
                    <div class="form-group" style="column-count: 4;">
                      @foreach($permissions as $permission)
                        <input type="checkbox" name="permissions[]" value="{{$permission->id}}" {{ $senddata->permissions->contains($permission->id) ? 'checked' : '' }}> &nbsp; {{$permission->display_name}} <br>
                      @endforeach
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
