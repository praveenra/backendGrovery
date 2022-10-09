@extends('layouts.admin')
@section('title','Products') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Products</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bulk Uploads</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Bulk Upload Products</h4>
			   
			   <div class="form-group">
                Sample Files For Upload Data.<a href="{{url('/admin/products.xlsx/')}}">Clik Here</a>
					
                 </div>
				 <form method="POST" action="{{url('/superadmin/products/uploadexcel')}}" enctype="multipart/form-data">
				@csrf
				 <div class="form-group">
                    <label for="first_name">Upload Excel</label>
                       <input type="file" name="file" class="form-control" id="customFile">

                 </div>
				 <input type="submit" class="btn btn-gradient-primary mr-2" value="submit">
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection