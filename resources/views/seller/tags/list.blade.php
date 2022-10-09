@extends('layouts.seller')
@section('title','Tags') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title">Tags</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Seller</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tags</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Tags Details</h4>
               <table class="table" id="tags">
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Seller Id</th>
                        <th>Tag</th>
                        <th>Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($tags as $key => $tag)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$tag->sd_sname}}</td>
                        <td>{{$tag->tag}}</td>
                        @if($tag->status == 1)
                          <td><label class="badge badge-success">Active</label></td>
                        @else
                          <td><label class="badge badge-danger">Inactive</label></td>
                        @endif
                        <td>
                          <a href="{{url('seller/tags/form')}}/{{$tag->id}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;	
                          <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$tag->id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a>  
                        </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                        @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <form action="{{route('deleteTag')}}" method="post">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <h4>You Want You Sure Delete This Record?</h4>
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="delete" class="btn btn-danger waves-effect remove-data-from-delete-form delete_data">Delete</button>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection

<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">

  $(document).ready(function(){
    $(".delete").click(function(){
      var id = $(this).attr('data-id');
      $('#id').val(id); 
    });
  });

  
   $(function () {
    $.noConflict();
        $('#tags').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });        
    });
</script>