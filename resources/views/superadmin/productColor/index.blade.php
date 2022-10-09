@extends('layouts.admin')
@section('title','Product Size')
@section('content')

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Product Color </li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-striped" id="product">
                            <a href="javascript:" type="button" class="btn btn-primary" style="float: left;" data-toggle="modal" data-target="#colorCreateModel">Add New Color</a>
{{--                            <a href="{{url('superadmin/productColor/create')}}" type="button" class="btn btn-info" style="float: left; position: relative; left: 10px;">Add New</a>--}}
                            <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Product Color</th>
                                <th>Product Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($productColor->count() > 0)
                              @foreach($productColor as $index => $products)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $products->colorName }}</td>
                                    <td> <a href="javascript:" class="badge badge-{{ $products->status == 1 ? 'success' : 'danger' }} active" data-id="1" style="cursor: pointer;"> {{ ($products->status == 1) ? 'Active' : 'In Active' }} </a> </td>
                                    <td>

                                        <a type="button" class="update" style="float: left;" data-id='{{ $products->id }}' onclick="update({{ $products->id }})" data-toggle="modal" data-target="#colorUpdateModel"><img src="https://ibotix.tech/Grovery/public/edit.svg"></a>&nbsp;
                                        <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{ $products->id }}' data-target="#delete"><img src="https://ibotix.tech/Grovery/public/delete.svg"></a>
                                    </td>
                                </tr>
                                @endforeach
                              @else
                                <tr>
                                    <td colspan="7" class="text-center">
                                       No Data Found
                                    </td>
                                <tr>
                              @endif
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
                <form action="{{ route('productColor.delete') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete Product</h4>
                    </div>
                    <div class="modal-body">
                        <h4>You Want You Sure Delete This Record?</h4>
                        <input type="hidden" name="delete_id" id="delete_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" id="delete" class="btn btn-danger waves-effect remove-data-from-delete-form delete_data">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="colorCreateModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Color Name</h4>
                </div>
                <form id="productColorForm">
                    <div class="modal-body">

                        <div class="col-lg-12">
                            <label for="colorName"><strong>Category</strong></label>
                            <input type="text" class="form-control" placeholder="RED" id="colorName" name="colorName">
                             <p id="colorNameError" class="text-danger"></p>
                        </div><br>

                        <div class="col-lg-12">
                            <label for="status"><strong>Status</strong></label>
                            <select id='status' name="status" class="form-control" style="width: 100%;">
                                <option value="">--Select Status--</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <p id="statusError" class="text-danger"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger waves-effect remove-data-from-delete-form filter" onclick="create()">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="colorUpdateModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Color Name Update</h4>
                </div>
                <form id="productColorForm">
                    <div class="modal-body">
                        <input type="hidden" id="updateId">
                        <div class="col-lg-12">
                            <label for="colorNameUpdate"><strong>Category</strong></label>
                            <input type="text" class="form-control" placeholder="RED" id="colorNameUpdate" name="colorName">
                            <p id="colorNameError" class="text-danger"></p>
                        </div><br>

                        <div class="col-lg-12">
                            <label for="statusUpdate"><strong>Status</strong></label>
                            <select id='statusUpdate' name="statusUpdate" class="form-control" style="width: 100%;">
                                <option value="">--Select Status--</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <p id="statusError" class="text-danger"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger waves-effect remove-data-from-delete-form filter" onclick="updateSave()">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection

@section('footer_script')

<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">




    const create = () =>{
         let siteUrl = '{{ env('APP_URL') }}';
         let colorName = document.getElementById('colorName').value;
         let status = document.getElementById('status').value;

        axios({
            method: 'post',
            url: '/Grovery/superadmin/productColor/create',
            data: {
                colorName:colorName,
                status:status
            },
        }).then((response) => {
            if(response.data.status === 1){
                // Swal.fire({
                //     title: 'Success!',
                //     text: response.data.message,
                //     icon: 'success',
                //     confirmButtonText: 'ok'
                // })
                $('#colorCreateModel').modal('hide');
                document.getElementById('colorName').value = null;
                document.getElementById('status').value = null;
                window.location.reload();

            }
        }).catch((error) => {
           let colorNameError = error.response.data.errors.colorName[0];
           let statusError = error.response.data.errors.status[0];
           document.getElementById('colorNameError').innerText = colorNameError;
           document.getElementById('statusError').innerText = statusError;
        });

    }

    const update = (id) => {
        axios({
            method: 'post',
            url:  '/Grovery/superadmin/productColor/edit',
            data: {
                id: id,
            },
        }).then((response) => {
             let colorNameUpdate = document.getElementById('colorNameUpdate').value = response.data.getColor.colorName
             let statusUpdate = document.getElementById('statusUpdate').value = response.data.getColor.status
             let id = document.getElementById('updateId').value = response.data.getColor.id
        }).catch((error) => {
            console.log(error);
        });
    }

    const updateSave = () => {
        let siteUrl = '{{ env('APP_URL') }}';
        let colorNameUpdate = document.getElementById('colorNameUpdate').value;
        let statusUpdate = document.getElementById('statusUpdate').value;
        let id = document.getElementById('updateId').value;

        axios({
            method: 'post',
            url: '/Grovery/superadmin/productColor/update',
            data: {
                id: id,
                colorName:colorNameUpdate,
                status:statusUpdate
            },
        }).then((response) => {
            if(response.data.status === 1){
                // Swal.fire({
                //     title: 'Success!',
                //     text: response.data.message,
                //     icon: 'success',
                //     confirmButtonText: 'ok'
                // })
                $('#colorUpdateModel').modal('hide');
                document.getElementById('colorName').value = null;
                document.getElementById('status').value = null;
                window.location.reload();

            }
        }).catch((error) => {
            let colorNameError = error.response.data.errors.colorName[0];
            let statusError = error.response.data.errors.status[0];
            document.getElementById('colorNameError').innerText = colorNameError;
            document.getElementById('statusError').innerText = statusError;
        });
    }

    $(function () {
        $.noConflict();
        $('#product').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });



    });
    $(document).ready(function(){
        $(".delete").click(function(){
            var id = $(this).attr('data-id');
            $('#delete_id').val(id);
        });
    });
</script>

@endsection
