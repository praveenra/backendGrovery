@extends('layouts.seller')
@section('title','Tag') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title">{{$action}} Tag</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Seller</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$action}} Tag</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Tags</h4>
               <form method="POST" action="{{ route('saveTag') }}">
                @csrf
                <input type="hidden" name="id" value="{{$tag->id}}">
                  <div class="form-group">
                    <label for="first_name">Tag</label>
                    <input type="text" name="tag" class="form-control" value="{{$tag->tag}}" placeholder="Tag">
                     @if($errors->has('tag'))
                     <div class="error_span help-text text-danger">{{ $errors->first('tag') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                    <label for="first_name">Status</label>
                    <div class="radio-list">
                        <label>
                        <input type="radio" name="status" value="1" {{'1' == $tag->status ? 'checked' : '' }}> Active</label> <br/>
                        <label>
                        <input type="radio" name="status" value="0" {{'0' == $tag->status ? 'checked' : '' }}> Inactive</label>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
.box {
display: flex;
flex-wrap: wrap;
}
.box>* {
flex: 1 1 160px;
}
</style>

@endsection