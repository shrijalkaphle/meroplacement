@extends('layout.admin')
@section('title', 'Payment Method | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Payment Method </div>
                </div>
                <div class="page-title-actions">
                    <button type="button" class="btn-shadow mr-3 btn btn-dark" data-toggle="modal" data-target="#addPayMethod">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-transform: capitalize">
                <strong> <i class="fas fa-times-circle"></i></strong>
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-transform: capitalize">
                <strong> <i class="fas fa-check-circle"></i> </strong>
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 py-3 card ">
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Account Name</th>
                                <th class="text-center">Account Number</th>
                                <th class="text-center">Image</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $pay)
                                    <tr>
                                        <th> {{$pay->title}} </th>
                                        <td class="text-center" style="text-transform: capitalize;"> {{$pay->type}} </td>
                                        <td class="text-center"> {{$pay->acc_name}} </td>
                                        <td class="text-center"> {{$pay->acc_number}} </td>
                                        <td class="text-center"> <img src="/uploads/{{$pay->photo}}" style="max-height:120px"> </td>
                                        <td class="text-center">
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm edit-modal" data-all="{{ $pay }}" data-toggle="modal" data-target="#editPayMethod">Edit</button>
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $pay->id }}" data-toggle="modal" data-target="#deletePayMethod">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        {{$payments->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<div class="modal fade" id="addPayMethod" tabindex="-1" role="dialog" aria-labelledby="Add Payment Method" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPayMethodTitle">Add Payment Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('payment.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="title">Title <span style="color:red">*</span></label>
                            <input type="text" name="title" required id="title" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="type">Type <span style="color:red">*</span></label>
                            <select name="type" id="type" required class="form-control">
                                <option value="saving">Saving</option>
                                <option value="current">Current</option>
                                <option value="wallet">Wallet</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="acc_name">Account Name <span style="color:red">*</span></label>
                        <input type="text" name="acc_name" id="acc_name" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="acc_number">Account Number <span style="color:red">*</span></label>
                        <input type="text" name="acc_number" id="acc_number" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="photo">Image <span style="color:red">*</span></label>
                        <input type="file" name="photo" id="photo" onchange="loadImage(event)" required class="form-control">
                    </div>
                    <img src="" id="preview" alt="" style="max-height: 150px">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editPayMethod" tabindex="-1" role="dialog" aria-labelledby="Edit Payment Method" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPayMethodTitle">Edit Payment Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="editForm" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body edit-body">
                <div class="form-group row">
                        <div class="col-md-6">
                            <label for="title">Title <span style="color:red">*</span></label>
                            <input type="text" name="title" required id="title" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="type">Type <span style="color:red">*</span></label>
                            <select name="type" id="type" required class="form-control">
                                <option value="saving">Saving</option>
                                <option value="current">Current</option>
                                <option value="wallet">Wallet</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="acc_name">Account Name <span style="color:red">*</span></label>
                        <input type="text" name="acc_name" id="acc_name" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="acc_number">Account Number <span style="color:red">*</span></label>
                        <input type="text" name="acc_number" id="acc_number" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="photo">Image</label>
                        <input type="file" name="photo" id="photo" onchange="loadEditImage(event)" class="form-control">
                    </div>
                    <img src="" id="previewedit" alt="" style="max-height: 150px">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deletePayMethod" tabindex="-1" role="dialog" aria-labelledby="Delete Industry" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryTitle"><i class="fas fa-info-circle" style="color:red"></i> Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="deleteForm" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body delete-body">
                    <p>Are You Sure Want to Delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        $('#payment').addClass('mm-active')
        $('#siteinformation').addClass('mm-active')
        function redirectEdit(id) {
            window.location.href = '/industry/'+id+'/edit'
        }
        var loadImage = function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var loadEditImage = function(event) {
            var output = document.getElementById('previewedit');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            var action = '/payment/'+id
            $('#deletePayMethod #deleteForm').attr("action", action)
        })
        $(document).on("click", ".edit-modal", function() {
            var all = $(this).data('all')
            $('.edit-body #title').val(all.title)
            $('.edit-body #type').val(all.type)
            $('.edit-body #acc_name').val(all.acc_name)
            $('.edit-body #acc_number').val(all.acc_number)
            var src = '/uploads/'+all.photo
            $('.edit-body #previewedit').attr('src',src)
            var action = '/payment/'+all.id
            $('#editPayMethod #editForm').attr("action", action)
        })
    </script>
@endsection