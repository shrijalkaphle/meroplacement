@extends('layout.admin')
@section('title', 'Edit Training | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> {{ $training->title }} </div>
                </div>
            </div>
        </div>
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
                <div class="main-card mb-3 card card-body">
                    <form action="{{ route('training.update', $training->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" required value="{{ $training->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date <span style="color:red">*</span></label>
                            <input type="date" name="start_date" required id="start_date" value="{{ $training->start_date }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="duration">Training Duration <span style="color:red">*</span></label>
                            <input type="text" name="duration" required id="duration" value="{{ $training->duration }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" onchange="loadImage(event)" class="form-control">
                        </div>
                        <img src="/uploads/{{ $training->image }}" id="preview" alt="" style="max-height: 150px">
                        <div class="form-group">
                            <label for="description">Description <span style="color:red">*</span></label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $training->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="fee">Fee <span style="color:red">*</span> </label>
                            <input type="number" name="fee" required id="fee" value="{{ $training->fee }}" class="form-control">
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="status">Status</label>
                                <select name="status" id="status" required class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0" @if($training->status == 0) selected @endif>Expired</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h4>Trainer Details</h4>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="trainer_name">Trainer Name</label>
                                <input type="text" name="trainer_name" id="trainer_name" value="{{ $training->trainer_name }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="trainer_image">Trainer Image</label>
                                <input type="file" name="trainer_image" id="trainer_image" class="form-control" onchange="loadTrainerImage(event)" >
                            </div>
                            <div class="col-md-6">
                                <img src="/uploads/{{ $training->trainer_image }}" id="trainer_preview" alt="" style="max-height: 150px">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trainer_description">Trainer Description</label>
                            <textarea name="trainer_description" id="trainer_description" cols="30" required rows="10" class="form-control">{{ $training->trainer_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <center><input type="submit" value="Update" class="btn btn-primary"></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#training').addClass('mm-active')
    $('#viewTraining').addClass('mm-active')
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
    ClassicEditor.create( document.querySelector( '#description' )).catch( error => {
            console.error( error );
        } );
</script>
    
@endsection