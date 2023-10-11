@extends('layout.admin')
@section('title', 'Enrollment Inquiry')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Enrollment Inquiry</div>
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
                                <th></th>
                            </tr>
                            </thead>
                            @foreach ($inquiries as $inquiry)
                                <tr>
                                    <td>{{ $inquiry->name }}</td>
                                    <td class="text-center"><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></td>
                                    <td class="text-center"><a href="tel:{{ $inquiry->mobile }}">{{ $inquiry->mobile }}</a></td>
                                    <td class="text-center">{{ $inquiry->address }}</td>
                                    <td class="text-right">
                                        <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $inquiry->id }}" data-toggle="modal" data-target="#deleteModel">Delete</button>
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
    <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="Delete Industry" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryTitle"><i class="fas fa-info-circle" style="color:red"></i> Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('training.delete.inquiry') }}" method="post">
                    @csrf
                    <div class="modal-body delete-body">
                        <input type="hidden" name="inquiry_id" id="inquiry_id">
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
        $('#enrollmentInquiry').addClass('mm-active')
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            $('.delete-body #inquiry_id').val(id)
        })
    </script>
@endsection