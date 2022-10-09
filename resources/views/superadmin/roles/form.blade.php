@extends('layouts.admin')
@section('title','Roles') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> {{$action}} Role </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$action}} Role</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Role</h4>
               <form action="{{route('saveRole')}}" method="post">
                @csrf
                  <input type="hidden" name="id" value="{{$role->id}}">
                  <div class="form-group">
                    <label for="first_name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$role->name}}" placeholder="Role Name">
                    @if($errors->has('name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('name') }}</div>
                    @endif
                  </div>
				          <div class="form-group">
                    <label for="first_name">Permissions</label><br>
                    <div class="form-group" style="column-count: 4;">
                      @foreach($permissions as $permission)
                        <input type="checkbox" name="permissions[]" value="{{$permission->id}}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}> &nbsp; {{$permission->display_name}} <br>
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
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

  <script>
    CKEDITOR.replace( 'description' );
  </script>

@endsection