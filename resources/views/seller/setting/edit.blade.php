@extends('layouts.seller')
@section('title','Seller') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> create Store Settings </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Seller</a></li>
            <li class="breadcrumb-item active" aria-current="page">create store settings</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Store Settings</h4>
                <form method="post" action="{{route('saveSetting')}}" >
                  @csrf
                  <input type="hidden" name="id" value="{{$senddata->id}}">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Opening Days</th>
                        <th>Opening Time</th>
                        <th>Closing Time</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="text" name="opening_day" class="form-control" value="{{$senddata->opening_day}}" readonly></td>
                        <td><input type="time" name="opening_time" class="form-control" value="{{$senddata->opening_time}}"></td>
                        <td><input type="time" name="closing_time" class="form-control" value="{{$senddata->closing_time}}"></td>
                      </tr>
                    </tbody>
                  </table>
				  	 
                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection