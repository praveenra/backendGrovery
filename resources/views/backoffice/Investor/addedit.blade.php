@extends('layouts.admin')
@section('title','Investor') 
@section('content')
<div class="content-wrapper">
    <div class="page-header">
       <!-- <h3 class="page-title"> User Management </h3> -->
       <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active" aria-current="page">Investor Creation</li>
          </ol>
       </nav>
    </div>
    <div class="row">
       <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
             <div class="card-body">
                <form class="forms-sample" id="myForm" method="post" enctype="multipart/form-data">
                   <h2 class="card-title">Personal Info</h2>
                   <div class="form-group">
                      <label for="username">Shareholder Name</label>
                      <input type="text" class="form-control" required id="username" name="username" placeholder="Shareholder Name">
                   </div>
                   <div class="form-group">
                      <label for="gender">Gender</label>
                      <select class="form-control" name="gender"  required >
                         <option value="male" >Male</option>
                         <option value="female" >Female</option>
                         <option value="other" >Other</option>
                      </select>
                   </div>
                   <div class="form-group">
                      <label for="phone">Mobile</label>
                      <input type="text" class="form-control" required id="phone" name="phone" placeholder="Mobile" >
                   </div>
                   <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" name="email" required class="form-control" id="email" placeholder="Email" >
                   </div>
                   <div class="form-group">
                      <label for="address">Address as in Aadhaar/Passport/Driving Licence *</label>
                      <textarea type="address" name="address" required class="form-control" id="address" placeholder="Address"></textarea>
                   </div>
                   <div class="form-group">
                      <label for="dob">DOB</label>
                      <input type="date" class="form-control" required id="dob" name="dob" placeholder="Dob">
                   </div>
                   <div class="form-group">
                      <label for="city">City</label>
                      <input type="text" class="form-control" required id="city" name="city" placeholder="City">
                   </div>
                   <div class="form-group">
                      <label for="state">State</label>
                      <input type="text" class="form-control" required id="state" name="state" placeholder="State" >
                   </div>
                   <div class="form-group">
                      <label for="pincode">Pincode</label>
                      <input type="number" class="form-control" required id="pincode" name="pincode" placeholder="Pincode">
                   </div>
                   <div class="form-group">
                      <label for="country">Country</label>
                      <input type="text" class="form-control" required id="country" name="country" placeholder="Country">
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection