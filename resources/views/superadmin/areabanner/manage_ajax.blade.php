@forelse($sliders as $key=>$slider)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$slider->ab_name}}</td>
                        <td>{{$slider->areabanner->area_name}}</td>
                        <td><img width="100px" src="{{$slider->SliderImage()}}"></td>
                        @if($slider->ab_status == 1)
                        <td><a href="javascript:" class="badge badge-success active" data-id='{{$slider->ab_id}}' style="cursor: pointer;">Active</a></td>
                        @else
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='{{$slider->ab_id}}' style="cursor: pointer;">Inactive</a></td>
                        @endif
                        <td >

                           <a href="{{url($edit).'/'.$slider->ab_id.'/edit'}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
                           <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$slider->ab_id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a>
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
<script src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/dataTables.bootstrap4.min.js')}}"></script>
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
        url:"{{route('inactiveAreaBanner')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

    $(".inactive").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('activeAreaBanner')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

  });
  
</script>