@extends('layout.admin')
@section('title', 'Site Information')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Site Setting </div>
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
            <form action="{{ route('setting.update',$sitesetting->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="about">About Page <span style="color:red">*</span></label>
                    <textarea name="about" id="about" cols="30" rows="10" class="form-control">{{ $sitesetting->about }}</textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label for="footer_about">About Footer <i>(max:250)</i> <span style="color:red">*</span></label>
                    <textarea name="footer_about" id="footer_about" cols="30" rows="10" class="form-control" maxlength="250">{{ $sitesetting->footer_about }}</textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label for="meta_title">Meta Title <span style="color:red">*</span></label>
                    <input type="text" name="meta_title" id="meta_title" required value="{{ $sitesetting->meta_title }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="meta_keyword">Meta Keyword <span style="color:red">*</span></label>
                    <input type="text" name="meta_keyword" id="meta_keyword" value="{{ $sitesetting->meta_keyword }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description <span style="color:red">*</span></label>
                    <textarea name="meta_description" id="meta_description" cols="30" rows="10" required class="form-control">{{ $sitesetting->meta_description }}</textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label for="email">Email <span style="color:red">*</span></label>
                    <input type="email" name="email" id="email" required value="{{ $sitesetting->email }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="number">Number <span style="color:red">*</span></label>
                    <input type="text" name="number" id="number" value="{{ $sitesetting->number }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address <span style="color:red">*</span></label>
                    <input type="text" name="address" id="address" value="{{ $sitesetting->address }}" required class="form-control">
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-md-6">
                        <img src="/uploads/{{ $sitesetting->training_banner }}" id="training_banner_preview" style="max-height:150px;margin-top:20px">
                    </div>
                    <div class="col-md-6">
                        <label for="training_banner">Training Banner <span style="color:red">*</span></label>
                        <input type="file" name="training_banner" id="training_banner" onchange="Loadtrainingbanner(event)" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <img src="/uploads/{{ $sitesetting->favicon }}" id="favicon_preview" style="max-height:150px;margin-top:20px">
                    </div>
                    <div class="col-md-6">
                        <label for="favicon">FavIcon <span style="color:red">*</span></label>
                        <input type="file" name="favicon" id="favicon" onchange="LoadFavicon(event)" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <img src="/uploads/{{ $sitesetting->logo }}" alt="" id="logo_preview" style="max-height:150px;margin-top:20px;max-width:100%">
                    </div>
                    <div class="col-md-6">
                        <label for="logo">Site Logo <span style="color:red">*</span></label>
                        <input type="file" name="logo" id="logo" onchange="LoadLogo(event)" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="url" name="facebook" id="facebook" value="{{ $sitesetting->facebook }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="url" name="instagram" id="instagram" value="{{ $sitesetting->instagram }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="linkedin">Linkedin</label>
                    <input type="url" name="linkedin" id="linkedin" value="{{ $sitesetting->linkedin }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="twitter">Youtube</label>
                    <input type="url" name="youtube" id="youtube" value="{{ $sitesetting->youtube }}" class="form-control">
                </div>
                <hr>
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
        $('#setting').addClass('mm-active')
        var Loadtrainingbanner = function(event) {
            var output = document.getElementById('training_banner_preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var LoadFavicon = function(event) {
            var output = document.getElementById('favicon_preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var LoadLogo = function(event) {
            var output = document.getElementById('logo_preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        ClassicEditor.create( document.querySelector( '#about' )).catch( error => {
            console.error( error );
        } );
    </script>

    <style>
        .app-main__inner .container {
            padding: 20px
        }
    </style>
@endsection