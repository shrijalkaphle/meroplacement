@extends('layout.admin')
@section('title', 'Edit Blog | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> {{ $blog->title }} </div>
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
                    <form action="{{ route('blog.update', $blog->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" required value="{{ $blog->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" required value="{{ $blog->author }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" name="tags" required value="{{ $blog->tags }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="cover">Image</label>
                            <input type="file" name="cover" id="cover" onchange="loadImage(event)" class="form-control">
                        </div>
                        <img src="/uploads/{{ $blog->cover }}" id="preview" alt="" style="max-height: 150px">
                        <div class="form-group">
                            <label for="content">Content <span style="color:red">*</span></label>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $blog->content }}</textarea>
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
    $('#blog').addClass('mm-active')
    var loadImage = function(event) {
        var output = document.getElementById('preview');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
    ClassicEditor.create( document.querySelector( '#content' )).catch( error => {
            console.error( error );
        } );
</script>
    
@endsection