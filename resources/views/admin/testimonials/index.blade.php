@extends('layout.admin')
@section('title', 'Testimonials | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Testimonials </div>
                </div>
                <div class="page-title-actions">
                    <button type="button" class="btn-shadow mr-3 btn btn-dark" data-toggle="modal" data-target="#addTestimonial">
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
                                <th>Name</th>
                                <th class="text-center">Position</th>
                                <th class="text-center">Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $testimonial)
                                    <tr>
                                        <th>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img width="80" class="rounded-circle" src="/uploads/{{ $testimonial->image }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $testimonial->title }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="text-center">{{ $testimonial->position }}</td>
                                        <td class="text-center">
                                            <div class="badge badge-info">{{ date('M j, Y',strtotime($testimonial->created_at)) }}</div>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" id="PopoverCustomT-1" onclick="redirectEdit({{ $testimonial->id }})" class="btn btn-primary btn-sm">Edit</button>
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $testimonial->id }}" data-toggle="modal" data-target="#deleteTestimonial">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        {{$testimonials->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<div class="modal fade" id="addTestimonial" tabindex="-1" role="dialog" aria-labelledby="Add Testimonial" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBlogTitle">Add Testimonial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('testimonial.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Name <span style="color:red">*</span> </label>
                        <input type="text" name="title" required id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="position">Position <span style="color:red">*</span></label>
                        <input type="text" name="position" required id="position" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image">Image <span style="color:red">*</span></label>
                        <input type="file" name="image" id="image" required onchange="loadImage(event)" class="form-control">
                    </div>
                    <img src="" id="preview" alt="" style="max-height: 150px">
                    <div class="form-group">
                        <label for="description">Description <span style="color:red">*</span></label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
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
<div class="modal fade" id="deleteTestimonial" tabindex="-1" role="dialog" aria-labelledby="Delete Industry" aria-modal="true">
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
                    <input type="hidden" name="testimonial_id" id="testimonial_id">
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
        $('#other').addClass('mm-active')
        $('#testimonial').addClass('mm-active')
        function redirectEdit(id) {
            window.location.href = '/testimonial/'+id+'/edit'
        }
        var loadImage = function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            $('.delete-body #testimonial_id').val(id)
            var action = '/testimonial/'+id
            $('#deleteTestimonial #deleteForm').attr("action", action)
        })
    </script>
@endsection