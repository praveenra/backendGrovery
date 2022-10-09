<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/googlemap.js"></script>





@extends('layouts.admin')
@section('title','Cancel Reason') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Cancel Reason </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cancel Reason</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body p-3">

            <form action="{{route('saveCancel_reason')}}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="id" value="{{$cancel_reason->id}}">

             
               <div class="form-group">
                  <label for="cancel_reason">Cancel Reason</label>
                  <textarea name="cancel_reason" class="form-control" placeholder="Cancel Reason">{{$cancel_reason->reason}}</textarea>
                  @if($errors->has('cancel_reason'))
                     <div class="error_span help-text text-danger">{{ $errors->first('cancel_reason') }}</div>
                  @endif
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group">
                    <label for="first_name">Type</label>
                    <div class="radio-list">
                        <label>
                        <input type="radio" name="type" value="Admin" checked {{'Admin' == $cancel_reason->type ? 'checked' : '' }}> Admin</label> <br/>
                        <label>
                        <input type="radio" name="type" value="Delivery" {{'Delivery' == $cancel_reason->type ? 'checked' : '' }}> Delivery</label>
                     </div>
                 </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group">
                    <label for="first_name">Status</label>
                    <div class="radio-list">
                        <label>
                        <input type="radio" name="status" value="1" checked {{'1' == $cancel_reason->status ? 'checked' : '' }}> Active</label> <br/>
                        <label>
                        <input type="radio" name="status" value="0" {{'0' == $cancel_reason->status ? 'checked' : '' }}> Inactive</label>
                     </div>
                 </div>
                  </div>
               </div>


            </div>
         </div>
      </div>

      <button type="submit" class="btn btn-gradient-primary mr-2" style="margin-left: 45%">Submit</button>
      </form>
   </div>
</div>
@endsection