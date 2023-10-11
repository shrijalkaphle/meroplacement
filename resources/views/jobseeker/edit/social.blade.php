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
                    <a class="list-div" href="{{ route('profile.reference.edit') }}">
                        <i class="fas fa-user"></i> &nbsp; Reference
                    </a>
                    <a class="list-div active" href="{{ route('profile.social.edit') }}" id="social">
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
                        <form action="{{ route('profile.social.update', $user->social->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="facebook" class="col-sm-3 col-form-label">Facebook</label>
                                <div class="col-sm-9">
                                    <input type="url" name="facebook" class="form-control" id="facebook" value="{{ $user->social->facebook }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="twitter" class="col-sm-3 col-form-label">Twitter</label>
                                <div class="col-sm-9">
                                    <input type="url" name="twitter" class="form-control" id="twitter" value="{{ $user->social->twitter }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="linkedin" class="col-sm-3 col-form-label">Linkedin</label>
                                <div class="col-sm-9">
                                    <input type="url" name="linkedin" class="form-control" id="linkedin" value="{{ $user->social->linkedin }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instagram" class="col-sm-3 col-form-label">Instagram</label>
                                <div class="col-sm-9">
                                    <input type="url" name="instagram" class="form-control" id="instagram" value="{{ $user->social->instagram }}">
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