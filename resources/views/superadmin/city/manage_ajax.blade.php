@forelse($senddata as $key=>$slider)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$slider->city_name}}</td>
                        <td>{{$slider->lat}}</td>
                        <td>{{$slider->long}}</td>
                        @if($slider->city_status == 1)
                        <td><a href="javascript:" class="badge badge-success active" data-id='{{$slider->city_id}}' style="cursor: pointer;">Active</a></td>
                        @else
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='{{$slider->city_id}}' style="cursor: pointer;">Inactive</a></td>
                        @endif
                        <td>
                            <a href="{{url('superadmin/city_edit')}}/{{$slider->city_id}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
                           <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$slider->city_id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a> 
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
        url:"{{route('inactiveCity')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

    $(".inactive").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('activeCity')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

  });

</script>