@extends('layout.frontend')
@section('title', $user->name . ' | Edit')
@section('body')
<div class="container" id="profile">
    <div class="card">
        <div class="card-header" style="text-align: right">
            <button class="btn mybtn" id="view_profile">View Profile</button>
        </div>
        <div class="card-body" style="padding:0;padding-left:15px">
            <div class="row">
                <div class="col-md-3">
                    <a class="list-div active" href="{{ route('profile.basic.edit') }}" id="basic">
                        <i class="fas fa-address-card"></i> &nbsp; Basic Information
                    </a>
                    <a class="list-div" href="{{ route('profile.preference.edit') }}">
                        <i class="fas fa-asterisk"></i> &nbsp; Preference
                    </a>
                    <a class="list-div" href="{{ route('profile.education.edit') }}">
                        <i class="fas fa-graduation-cap"></i> &nbsp; Education
                    </a>
                    <a class="list-div " href="{{ route('profile.experience.edit') }}" id="experience">
                        <i class="fas fa-building"></i> &nbsp; Experience
                    </a>
                    <a class="list-div " href="{{ route('profile.training.edit') }}" id="training">
                        <i class="fas fa-certificate"></i> &nbsp; Training/Certificate
                    </a>
                    <a class="list-div " href="{{ route('profile.reference.edit') }}" id="reference">
                        <i class="fas fa-user"></i> &nbsp; Reference
                    </a>
                    <a class="list-div " href="{{ route('profile.social.edit') }}" id="social">
                        <i class="fas fa-share-alt"></i> &nbsp; Social Account
                    </a>
                </div>
                <div class="col-md-9" style="padding:20px">
                    <div id="basic-content">
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
                        <form action="{{ route('profile.basic.update', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="photo" class="col-sm-3 col-form-label">Profile</label>
                                <div class="col-sm-9">
                                    <input type="file" name="photo" class="form-control" id="photo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="col-sm-3 col-form-label">Gender <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <select name="gender" id="gender" required class="form-control">
                                        <option value="male">Male</option>
                                        <option value="female" @if($user->jobseeker->gender == 'female') selected @endif>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="col-sm-3 col-form-label">Date of Birth <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="dob" id="dob" value="{{ $user->jobseeker->dob }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nationality" class="col-sm-3 col-form-label">Nationality <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nationality" id="jobseeker" value="{{ $user->jobseeker->nationality }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="current_address" class="col-sm-3 col-form-label">Current Address <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="current_address" id="current_address" value="{{ $user->jobseeker->current_address }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="permanent_address" class="col-sm-3 col-form-label">Permanent Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="permanent_address" id="permanent_address" value="{{ $user->jobseeker->permanent_address }}">
                                    <input type="checkbox" id="same_address"> Same as Current Address
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="number" class="col-sm-3 col-form-label">Contact Number <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="number" id="number" value="{{ $user->number }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="aboutme" class="col-sm-3 col-form-label">About Me <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <textarea name="aboutme" id="aboutme" cols="30" rows="10">{{ $user->jobseeker->aboutme }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <center>
                                    <input type="submit" value="Update" class="btn btn-success">
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<style>
    body {
        background: #F8F9FA;
    }
    #profile {
        color: black;
        font-size: 16px;
        padding-top: 100px;
        padding-bottom: 100px;
    }
    .nav-menu li a {
        color: black
    }
    .header-scrolled .nav-menu li a {
        color: white !important
    }
    .col-md-8 .heading {
        display: block;
        color: black !important;
        font-weight: 700;
        font-size: 18px;
    }
    #profile p {
        margin:0
    }
    h4 {
        border-bottom: 1px solid #e9ecef;
        width: 100%
    }
    .profile-content {
        padding: 20px;
        margin-bottom: 20px
    }
    .mybtn {
        background: #49E4FA;
        padding: 5px 25px;
        text-transform: uppercase;
        color: white;
        border-radius: 0
    }
    .mybtn:hover {
        background: transparent;
        color: #49E4FA;
        border: 1px solid #49E4FA;
    }
    .col-md-4 {
        padding: 0
    }
    .list-div {
        color: black;
        display: block;
        padding: 20px;
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    .list-div:hover {
        color: black;
    }
    .list-div.active {
        background: #F8F9FA;
        color: #49E4FA;
    }
    label {
        text-align: right
    }
</style>

<script>
    $('#view_profile').on('click', ()=> {
        window.location.href="{{ route('profile') }}"
    })
    $(document).on('change', '#same_address', function() {
        if(this.checked) {
            $('#permanent_address').val($('#current_address').val())
        }
    })
    $('#permanent_address').on('keypress', ()=> {
        $("#same_address").prop('checked', false); 
    })
    ClassicEditor.create( document.querySelector( '#aboutme' )).catch( error => {
        console.error( error );
    } );
</script>
@endsection