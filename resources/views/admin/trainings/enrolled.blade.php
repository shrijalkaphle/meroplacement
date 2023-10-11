@extends('layout.admin')
@section('title', 'Enrolled | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Enrolled for {{ $training->title }} </div>
                </div>
                <div class="page-title-actions">
                    <button type="button" class="btn-shadow mr-3 btn btn-dark" data-toggle="modal" data-target="#addModel">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-transform: capitalize">
                <strong> <i class="fas fa-check-circle"></i></strong>
                {{ Session::get('success') }}
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
                                <th>Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Paid</th>
                                <th class="text-center">Remaining</th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach ($training->enroll as $enroll)
                                <tr>
                                    <td>{{ $enroll->name }}</td>
                                    <td class="text-center"><a href="mailto:{{ $enroll->email }}">{{ $enroll->email }}</a></td>
                                    <td class="text-center"><a href="tel:{{ $enroll->mobile }}">{{ $enroll->mobile }}</a></td>
                                    <td class="text-center">{{ $enroll->address }}</td>
                                    <td class="text-center">Rs. {{ $enroll->paid }}</td>
                                    <td class="text-center">Rs. {{ $training->fee - $enroll->paid }}</td>
                                    <td class="text-right">
                                        <button type="button" id="PopoverCustomT-1" class="btn btn-success btn-sm payment-modal" data-id="{{ $enroll->id }}" data-toggle="modal" data-target="#paidModel">Payment</button>
                                        <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm edit-modal" data-all="{{ $enroll }}" data-toggle="modal" data-target="#editModel">Edit</button>
                                        <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $enroll->id }}" data-toggle="modal" data-target="#deleteModel">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="Add Training" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEnrolledTitle">Add Enrolled Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('training.enroll') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="training_id" value="{{$training->id}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Full Name*</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email">Email*</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="mobile">Mobile*</label>
                                <input type="number" name="mobile" id="mobile" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address*</label>
                            <input type="text" name="address" id="address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="paid">Paid*</label>
                            <input type="number" name="paid" id="paid" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="Delete Industry" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryTitle">Edit Enrolled Student Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('training.enrolled.update') }}" method="post">
                    @csrf
                    <div class="modal-body edit-body">
                        <input type="hidden" name="enrolled_id" id="enrolled_id">
                        <div class="form-group">
                            <label for="name">Full Name*</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email">Email*</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="mobile">Mobile*</label>
                                <input type="number" name="mobile" id="mobile" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address*</label>
                            <input type="text" name="address" id="address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="paid">Paid*</label>
                            <input type="number" name="paid" id="paid" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="paidModel" tabindex="-1" role="dialog" aria-labelledby="Delete Industry" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryTitle">Add Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('training.enrolled.payment') }}" method="post">
                    @csrf
                    <div class="modal-body payment-body">
                        <input type="hidden" name="enrolled_id" id="enrolled_id">
                        <div class="form-group">
                            <label for="paidamt">Paid Amount*</label>
                            <input type="number" name="paidamt" id="paidamt" required class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="Delete Industry" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryTitle"><i class="fas fa-info-circle" style="color:red"></i> Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('training.enrolled.delete') }}" method="post">
                    @csrf
                    <div class="modal-body delete-body">
                        <input type="hidden" name="enrolled_id" id="enrolled_id">
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
        $('#training').addClass('mm-active')
        $('#viewTraining').addClass('mm-active')
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            $('.delete-body #enrolled_id').val(id)
        })
        $(document).on("click", ".payment-modal", function() {
            var id = $(this).data('id')
            $('.payment-body #enrolled_id').val(id)
        })
        $(document).on("click", ".edit-modal", function() {
            var all = $(this).data('all')
            $('.edit-body #enrolled_id').val(all.id)
            $('.edit-body #name').val(all.name)
            $('.edit-body #email').val(all.email)
            $('.edit-body #mobile').val(all.mobile)
            $('.edit-body #address').val(all.address)
            $('.edit-body #paid').val(all.paid)
        })
    </script>
@endsection