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
   </tr>
   @empty
   <tr>
      <td colspan="7" class="text-center">
         {{$message}}
      </td>
   <tr>
@endforelse