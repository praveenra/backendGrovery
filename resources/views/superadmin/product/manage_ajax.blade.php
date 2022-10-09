 @forelse($senddata as $key=>$data)
   <tr>
      <td>{{$key+1}}</td>
      <td>{{$data->product_name}}</td>
      <td>{{$data->product_category->cat_name}}</td>
      <!--<td>{{$data->product_stock}}</td>-->
      <!-- <td>{{$data->product_price}}</td> -->
      <!-- <td>{{$data->product_sales_price}}</td> -->
      <td>{{$data->sd_sname}}</td>
      @if($data->product_status == 1)
      <td><a href="javascript:" class="badge badge-success active" data-id='{{$data->product_id}}' style="cursor: pointer;">Active</a></td>
      @else
      <td><a href="javascript:" class="badge badge-danger inactive" data-id='{{$data->product_id}}' style="cursor: pointer;">Inactive</a></td>
      @endif
      <td >

         <a href="{{url($edit).'/'.$data->product_id.'/edit'}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
         <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$data->product_id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a> 
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
        url:"{{route('inactiveProducts')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

    $(".inactive").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('activeProducts')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

  });

</script>