@extends('layout.admin')
@section('title', 'Terms and Condition | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Terms and Condition </div>
                </div>
            </div>
        </div> 
        <div class="container">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-transform: capitalize">
                <strong> <i class="fas fa-check-circle"></i></strong>
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
        @endif
            <form action="{{ route('terms.update',$sitesetting->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="termscondition">Terms and Condition <span style="color:red">*</span></label>
                    <textarea name="termscondition" id="termscondition" cols="30" rows="10" class="form-control">{{ $sitesetting->termscondition }}</textarea>
                </div>
                <center>
                    <input type="submit" value="Update" class="btn btn-success">
                </center>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#terms').addClass('mm-active')
        
        ClassicEditor.create( document.querySelector( '#termscondition' )).catch( error => {
            console.error( error );
        } );
    </script>

    <style>
        .app-main__inner .container {
            padding: 20px
        }
    </style>
@endsection