@extends('layouts.admin2')
@section('title','Sub Sub Category') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Create Sub Sub Category </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Sub Sub Category</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Sub Sub Category</h4>
               <form action="{{url('admin/subsubcategory/save')}}" method="post" enctype="multipart/form-data">
                @csrf
               <div class="form-group">
                     <label for="">Name</label>
                     <input type="hidden" name="id" class="form-control" value="{{$data->id}}">
                     <input type="text" name="name" class="form-control" value="{{$data->name}}{{old('name')}}" placeholder="Sub Sub Category Name">
                     <div class="help-block form-text with-errors form-control-feedback"></div>
                     @if( $errors->has('name') )
                     <div class="error_span help-text text-danger"> {{ $errors->first('name') }}</div>
                     @endif
                  </div>
                  
                  <div class="form-group">
                     <label for="first_name">Category</label>
                     <select class="form-control" name="category_id">
                      <option value="">Select Category</option>
                      @foreach($categories as $category)
                        <option value="{{$category->cat_id}}" {{$category->cat_id == $data->category_id ? 'selected' : ''}}>{{$category->cat_name}}</option>
                      @endforeach
                     </select>
                     @if( $errors->has('category_id') )
                     <div class="error_span help-text text-danger">{{ $errors->first('category_id') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                     <label for="first_name">Sub Category</label>
                     <select class="form-control" name="sub_category_id">
                      <option value="">Select Sub Category</option>
                      @foreach($subcategories as $subcategory)
                        <option value="{{$subcategory->cat_id}}" {{$subcategory->cat_id == $data->sub_category_id ? 'selected' : ''}}>{{$subcategory->cat_name}}</option>
                      @endforeach
                     </select>
                     @if( $errors->has('sub_category_id') )
                     <div class="error_span help-text text-danger">{{ $errors->first('sub_category_id') }}</div>
                     @endif
                  </div>
                 <script type="text/javascript">
                   function loadImage(input, id) {
                      id = id || '#img_preview';
                      if (input.files && input.files[0]) {
                          var reader = new FileReader();

                          reader.onload = function (e) {
                          $(id)
                              .attr('src', e.target.result)
                              .width(100)
                              .height(100);
                          };
                          reader.readAsDataURL(input.files[0]);
                      }
                  }
                 </script>
                 <div class="form-group">
                    <label for="first_name">Status</label>
                    <div class="radio-list">
                        <label>
                        <input type="radio" name="status" value="1" {{'1' == $data->status ? 'checked' : '' }}> Active</label> <br/>
                        <label>
                        <input type="radio" name="status" value="0" {{'0' == $data->status ? 'checked' : '' }}> Inactive</label>
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