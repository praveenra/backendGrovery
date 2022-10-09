@extends('layouts.admin')
@section('title','FAQ') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> FAQ </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">FAQ</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Faq</h4>
               {!! Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="first_name">Type</label>
                     <select name="type" class="form-control" required>
                       <option value="">Select Type</option>
                       <option value="1" {{$senddata->type == '1' ? 'selected' : ''}}>Seller</option>
                       <option value="2" {{$senddata->type == '2' ? 'selected' : ''}}>Customer</option>
                       <option value="3" {{$senddata->type == '3' ? 'selected' : ''}}>Membership</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="first_name">Question</label>
                     {{ Form::text('question', old('question'), ['class' => 'form-control', 'placeholder' => 'Question']) }}
                     @if($errors->has('question'))
                     <div class="error_span help-text text-danger">{{ $errors->first('question') }}</div>
                     @endif
                  </div>
				          <div class="form-group">
                     <label for="first_name">Answer</label>
                     {{ Form::textarea('answer', old('answer'), ['class' => 'form-control answer','id' => 'answer', 'placeholder' => 'Answer']) }}
                     @if($errors->has('answer'))
                     <div class="error_span help-text text-danger">{{ $errors->first('answer') }}</div>
                     @endif
                  </div>
                  
                 <div class="form-group">
                    <label for="first_name">Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('status', 0) }} In Active</label>
                     </div>
                      @if($errors->has('status'))
                     <div class="error_span help-text text-danger">{{ $errors->first('status') }}</div>
                     @endif
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
    CKEDITOR.replace( 'answer' );
  </script>

@endsection