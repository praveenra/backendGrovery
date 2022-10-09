@extends('layouts.admin')
@section('title','Product')
@section('content')

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Product Size </li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-striped" id="product">
                            <a href="javascript:" type="button" class="btn btn-primary" style="float: left;" data-toggle="modal" data-target="#sizeCreateModel">Add New Size</a>
                            {{--                            <a href="{{url('superadmin/productColor/create')}}" type="button" class="btn btn-info" style="float: left; position: relative; left: 10px;">Add New</a>--}}
                            <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Product Size</th>
                                <th>Product Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($productSize->count() > 0)
                                @foreach($productSize as $index => $products)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $products->sizeName }}</td>
                                        <td> <a href="javascript:" class="badge badge-{{ $products->status == 1 ? 'success' : 'danger' }} active" data-id="1" style="cursor: pointer;"> {{ ($products->status == 1) ? 'Active' : 'In Active' }} </a> </td>
                                        <td>

                                            <a type="button" class="update" style="float: left;" data-id='{{ $products->id }}' onclick="update({{ $products->id }})" data-toggle="modal" data-target="#sizeUpdateModel"><img src="https://ibotix.tech/Grovery/public/edit.svg"></a>&nbsp;
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
                <form action="{{ route('productSize.delete') }}" method="post">
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

    <div id="sizeCreateModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Size Name</h4>
                </div>
                <form id="productColorForm">
                    <div class="modal-body">

                        <div class="col-lg-12">
                            <label for="sizeName"><strong>Category</strong></label>
                            <input type="text" class="form-control" placeholder="XL" id="sizeName" name="sizeName">
                            <p id="sizeNameError" class="text-danger"></p>
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


    <div id="sizeUpdateModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Size Name Update</h4>
                </div>
                <form id="productColorForm">
                    <div class="modal-body">
                        <input type="hidden" id="updateId">
                        <div class="col-lg-12">
                            <label for="sizeNameUpdate"><strong>Category</strong></label>
                            <input type="text" class="form-control" placeholder="RED" id="sizeNameUpdate" name="sizeNameUpdate">
                            <p id="sizeNameError" class="text-danger"></p>
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
            let sizeName = document.getElementById('sizeName').value;
            let status = document.getElementById('status').value;

            axios({
                method: 'post',
                url: '/Grovery/superadmin/productSize/create',
                data: {
                    sizeName:sizeName,
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
                    $('#sizeCreateModel').modal('hide');
                    document.getElementById('sizeName').value = null;
                    document.getElementById('status').value = null;
                    window.location.reload();

                }
            }).catch((error) => {
                let sizeNameError = error.response.data.errors.colorName[0];
                let statusError = error.response.data.errors.status[0];
                document.getElementById('sizeNameError').innerText = sizeNameError;
                document.getElementById('statusError').innerText = statusError;
            });

        }

        const update = (id) => {
            axios({
                method: 'post',
                url:  '/Grovery/superadmin/productSize/edit',
                data: {
                    id: id,
                },
            }).then((response) => {
                let sizeNameUpdate = document.getElementById('sizeNameUpdate').value = response.data.getSize.sizeName
                let statusUpdate = document.getElementById('statusUpdate').value = response.data.getSize.status
                let id = document.getElementById('updateId').value = response.data.getSize.id
            }).catch((error) => {
                console.log(error);
            });
        }

        const updateSave = () => {
            let siteUrl = '{{ env('APP_URL') }}';
            let sizeNameUpdate = document.getElementById('sizeNameUpdate').value;
            let statusUpdate = document.getElementById('statusUpdate').value;
            let id = document.getElementById('updateId').value;

            axios({
                method: 'post',
                url: '/Grovery/superadmin/productSize/update',
                data: {
                    id: id,
                    sizeName:sizeNameUpdate,
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
                    $('#sizeUpdateModel').modal('hide');
                    document.getElementById('sizeName').value = null;
                    document.getElementById('status').value = null;
                    window.location.reload();

                }
            }).catch((error) => {
                let sizeNameError = error.response.data.errors.sizeName[0];
                let statusError = error.response.data.errors.status[0];
                document.getElementById('sizeNameError').innerText = sizeNameError;
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
