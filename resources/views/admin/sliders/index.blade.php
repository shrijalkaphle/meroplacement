@extends('layout.admin')
@section('title', 'Slider | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Slider </div>
                </div>
                <div class="page-title-actions">
                    <button type="button" class="btn-shadow mr-3 btn btn-dark" data-toggle="modal" data-target="#addSlider">
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
                                <th class="text-center">Image</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $q)
                                    <tr>
                                        <th> {{$q->title}} </th>
                                        <td class="text-center">
                                            <img src="/uploads/{{ $q->photo }}" style="max-height:120px">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm edit-modal" data-id="{{ $q->id }}" data-title="{{ $q->title }}" data-photo="{{ $q->photo }}" data-toggle="modal" data-target="#editQualification">Edit</button>
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $q->id }}" data-toggle="modal" data-target="#deleteIndustry">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        {{$sliders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<div class="modal fade" id="addSlider" tabindex="-1" role="dialog" aria-labelledby="Add Qualification" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQualificationTitle">Add Slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" required id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="photo">Image</label>
                        <input type="file" name="photo" required id="photo" onchange="loadImage(event)" class="form-control">
                    </div>
                    <img src="" id="preview" style="max-height:150px" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editQualification" tabindex="-1" role="dialog" aria-labelledby="Edit Qualification" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQualificationTitle">Edit Qualification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="editForm" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body edit-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" required id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="photo">Image</label>
                        <input type="file" name="photo" id="photo" onchange="loadEditImage(event)" class="form-control">
                    </div>
                    <img src="" id="editpreview" style="max-height:150px" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteIndustry" tabindex="-1" role="dialog" aria-labelledby="Delete Industry" aria-modal="true">
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
        $('#qualification').addClass('mm-active')
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
            var output = document.getElementById('editpreview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            var action = '/slider/'+id
            $('#deleteIndustry #deleteForm').attr("action", action)
        })
        $(document).on("click", ".edit-modal", function() {
            var id = $(this).data('id')
            $('.edit-body #title').val($(this).data('title'))
            src = '/uploads/'+$(this).data('photo')
            $('.edit-body #editpreview').attr('src',src)
            var action = '/slider/'+id
            $('#editQualification #editForm').attr("action", action)
        })
    </script>
@endsection