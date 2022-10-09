 @forelse($senddata as $key=>$data)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->user_id}}</td>
                        <td>{{$data->first_name}}</td>
                        <td>{{$data->mobile_number	}}</td>
                        <td>{{$data->city->city_name}}</td>
                        @if($data->user_status == 1)
                        <td><label class="badge badge-success">Active</label></td>
                        @else
                        <td><label class="badge badge-danger">Inactive</label></td>
                        @endif
                        <td >
                          <a href="{{url($edit).'/'.$data->id.'/edit'}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
                           <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$data->id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a>     									
                         </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                        @endforelse