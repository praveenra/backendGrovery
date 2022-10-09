@forelse($sliders as $key=>$slider)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$slider->ab_name}}</td>
                        <td>{{$slider->areabanner->area_name}}</td>
                        <td><img width="100px" src="{{$slider->SliderImage()}}"></td>
                        @if($slider->ab_status == 1)
                        <td><label class="badge badge-success">Active</label></td>
                        @else
                        <td><label class="badge badge-danger">Inactive</label></td>
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