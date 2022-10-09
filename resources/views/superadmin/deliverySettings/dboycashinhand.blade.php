@extends('layouts.admin')
@section('title','Delivery Boy Cash In Hand') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title">Delivery Boy Cash In Hand</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Delivery Boy Cash In Hand</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body p-3">

            <form action="{{route('savedboycashinhandview')}}" method="post" enctype="multipart/form-data">
               @csrf
              <input type="hidden" name="id" value="{{$setting->s_id}}">

             
               <div class="form-group">
                  <label for="cancel_reason">Delivery Boy Cash In Hand</label>
                  <input type="text" name="cash_in_hand" class="form-control" placeholder="Cancel Reason" value="{{$setting->s_content}}">
               </div>
            </div>
         </div>
      </div>

      <button type="submit" class="btn btn-gradient-primary mr-2" style="margin-left: 45%">Submit</button>
      </form>
   </div>
</div>
@endsection