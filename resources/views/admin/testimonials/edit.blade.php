@extends('layout.admin')
@section('title', 'Edit Testimonial | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> {{ $testimonial->title }} </div>
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
                    <form action="{{ route('testimonial.update', $testimonial->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" name="title" required value="{{ $testimonial->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" name="position" required value="{{ $testimonial->position }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="cover">Image</label>
                            <input type="file" name="cover" id="cover" onchange="loadImage(event)" class="form-control">
                        </div>
                        <img src="/uploads/{{ $testimonial->image }}" id="preview" alt="" style="max-height: 150px">
                        <div class="form-group">
                            <label for="content">Content <span style="color:red">*</span></label>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control" required>{{ $testimonial->description }}</textarea>
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
    $('#other').addClass('mm-active')
    $('#testimonial').addClass('mm-active')
    var loadImage = function(event) {
        var output = document.getElementById('preview');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
    
@endsection