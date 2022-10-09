 @forelse($senddata as $key=>$slider)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$slider->name}}</td>
                        @if($slider->status == 1)
                        <td><a href="javascript:" class="badge badge-success active" data-id='{{$slider->id}}' style="cursor: pointer;">Active</a></td>
                        @else
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='{{$slider->id}}' style="cursor: pointer;">Inactive</a></td>
                        @endif
                        <td >
                           <a href="{{url($edit).'/'.$slider->id.'/edit'}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
                           <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$slider->id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a> 
                         </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                        @endforelse

<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script type="text/javascript">

   $(document).ready(function(){
    
    $(".delete").click(function(){
      var id = $(this).attr('data-id');
      $('#delete_id').val(id); 
    });
    
    $(".active").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('inactiveMeasurement')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

    $(".inactive").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('activeMeasurement')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

  });

</script>