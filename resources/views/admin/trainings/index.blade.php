@extends('layout.admin')
@section('title', 'Training | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Trainings </div>
                </div>
                <div class="page-title-actions">
                    <button type="button" class="btn-shadow mr-3 btn btn-dark" data-toggle="modal" data-target="#addTraining">
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
                                <th class="text-center">Duration</th>
                                <th class="text-center">Start Date</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($trainings as $training)
                                    <tr>
                                        <th> {{$training->title}} </th>
                                        <td class="text-center">{{ $training->duration }}</td>
                                        <td class="text-center">
                                            <div class="badge badge-info">{{ date('M j, Y',strtotime($training->start_date)) }}</div>
                                        </td>
                                        <td class="text-center">
                                            @if($training->status)
                                                <div class="badge badge-success">Active</div>
                                            @else
                                                <div class="badge badge-danger">Expired</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('training.enrolled', $training->slug) }}" id="PopoverCustomT-1" class="btn btn-success btn-sm">Enrolled</a>
                                            <button type="button" id="PopoverCustomT-1" onclick="redirectEdit({{ $training->id }})" class="btn btn-primary btn-sm">Edit</button>
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $training->id }}" data-toggle="modal" data-target="#deleteTraining">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        {{$trainings->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<div class="modal fade" id="addTraining" tabindex="-1" role="dialog" aria-labelledby="Add Training" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTrainingTitle">Add Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('training.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title <span style="color:red">*</span> </label>
                        <input type="text" name="title" required id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date <span style="color:red">*</span></label>
                        <input type="date" name="start_date" required id="start_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="duration">Training Duration <span style="color:red">*</span></label>
                        <input type="text" name="duration" required id="duration" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image">Image <span style="color:red">*</span></label>
                        <input type="file" name="image" id="image" required onchange="loadImage(event)" class="form-control">
                    </div>
                    <img src="" id="preview" alt="" style="max-height: 150px">
                    <div class="form-group">
                        <label for="description">Description <span style="color:red">*</span></label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fee">Fee <span style="color:red">*</span> </label>
                        <input type="number" name="fee" required id="fee" class="form-control">
                    </div>
                    <hr>
                    <h4>Trainer Details</h4>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="trainer_name">Trainer Name</label>
                            <input type="text" name="trainer_name" id="trainer_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="trainer_image">Trainer Image</label>
                            <input type="file" name="trainer_image" id="trainer_image" class="form-control" required onchange="loadTrainerImage(event)" >
                        </div>
                        <div class="col-md-6">
                            <img src="" id="trainer_preview" alt="" style="max-height: 150px">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="trainer_description">Trainer Description</label>
                        <textarea name="trainer_description" id="trainer_description" cols="30" required rows="10" class="form-control"></textarea>
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
<div class="modal fade" id="deleteTraining" tabindex="-1" role="dialog" aria-labelledby="Delete Industry" aria-modal="true">
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
                    <input type="hidden" name="training_id" id="training_id">
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
        function redirectEdit(id) {
            window.location.href = '/training/'+id+'/edit'
        }
        var loadImage = function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var loadTrainerImage = function(event) {
            var output = document.getElementById('trainer_preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            $('.delete-body #training_id').val(id)
            var action = '/training/'+id
            $('#deleteTraining #deleteForm').attr("action", action)
        })
        ClassicEditor.create( document.querySelector( '#description' )).catch( error => {
            console.error( error );
        } );
    </script>
@endsection