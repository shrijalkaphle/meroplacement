@extends('layout.frontend')
@section('title', $name . ' | Edit')
@section('body')
<div class="container" id="profile">
    <div class="card">
        <div class="card-header" style="text-align: right">
            <button class="btn mybtn" id="view_profile">View Profile</button>
        </div>
        <div class="card-body" style="padding:0;padding-left:15px">
            <div class="row">
                <div class="col-md-3">
                    <a class="list-div" href="{{ route('profile.basic.edit') }}" id="basic">
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
                    <a class="list-div active" href="{{ route('profile.reference.edit') }}">
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
                        <form action="{{ route('profile.reference.update', $reference->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $reference->name }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="position" class="col-sm-3 col-form-label">Position <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="position" class="form-control" id="position" value="{{ $reference->position }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="organization_name" class="col-sm-3 col-form-label">Organization Name <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="organization_name" id="organization_name" value="{{ $reference->organization_name }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="email" value="{{ $reference->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contact_mobile" class="col-sm-3 col-form-label">Contact Mobile <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="contact_mobile" id="contact_mobile" value="{{ $reference->contact_mobile }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contact_home" class="col-sm-3 col-form-label">Contact Home</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contact_home" id="contact_home" value="{{ $reference->contact_home }}">
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
</script>
@endsection