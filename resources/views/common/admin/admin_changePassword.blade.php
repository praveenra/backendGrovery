@extends('layouts.admin2')
@section('title','Change Password') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Change Password </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">

               <form method="POST" action="{{ route('change.password') }}">
                  @csrf 

                   @foreach ($errors->all() as $error)
                      <p class="text-danger">{{ $error }}</p>
                   @endforeach 


                  <input type="hidden" value="{{$user->id}}" name="id">

                  <div class="form-group row">
                      <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                      <div class="col-md-6">
                          <input type="password" id="txtPassword" class="form-control" name="password" autocomplete="current-password" inputmode="numeric" minlength="6">
                          
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                      <div class="col-md-6">
                          <input type="password" class="form-control" id="txtConfirmPassword" name="confirm_password" autocomplete="confirm-password" inputmode="numeric" minlength="6">
                          <span id='message'></span>
                      </div>
                  </div>




                  <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                          <button type="submit" id="btnSubmit" onclick="return Validate()" class="btn btn-primary">
                              Update Password
                          </button>
                      </div>
                  </div>
              </form>
                    
            </div>
         </div>
      </div>
   </div>
</div>

@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("txtPassword").value;
        var confirmPassword = document.getElementById("txtConfirmPassword").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>