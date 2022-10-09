@extends('layouts.admin2')
@section('title','Profile Detail') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Profile Detail </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile Detail</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Profile Detail</h4>
               <form action="{{ url('profile_detail_update') }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                @csrf

                <input type="hidden" value="{{$user->id}}" name="id">

                <div class="form-group">
                  <label for="first_name">User Name</label>
                  <input type="text" name="first_name" value="{{$user->first_name}}"  class="form-control" placeholder="First Name" style="width: 50%;">
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" name="email" value="{{$user->email}}"  class="form-control" placeholder="Email" style="width: 50%;">
                </div>
         
                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button> 

          </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

