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
                    <a class="list-div active" href="{{ route('profile.preference.edit') }}">
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
                        <form action="{{ route('profile.preference.update', $user->jobseeker->preference->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="industry_id" class="col-sm-3 col-form-label">Job Category <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <select name="industry_id" id="industry_id" class="form-control" required>
                                        @foreach ($industries as $i)
                                            <option value="{{ $i->id }}" @if($i->id == $user->jobseeker->preference->industry_id) selected @endif>{{ $i->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="looking_for" class="col-sm-3 col-form-label">Looking For <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <select name="looking_for" id="looking_for" class="form-control" required>
                                        <option value="top" @if($user->jobseeker->preference->looking_for == 'top') selected @endif>Top Level</option>
                                        <option value="senior" @if($user->jobseeker->preference->looking_for == 'senior') selected @endif>Senior Level</option>
                                        <option value="mid" @if($user->jobseeker->preference->looking_for == 'mid') selected @endif>Mid Level</option>
                                        <option value="entry" @if($user->jobseeker->preference->looking_for == 'entry') selected @endif>Entry Level</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specialization" class="col-sm-3 col-form-label">Specialization <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="specialization" class="form-control" id="specialization" value="{{ $user->jobseeker->preference->specialization }}" required>
                                    <small style="color:gray">Seperate by comma (,)</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="skills" class="col-sm-3 col-form-label">Skills <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="skills" class="form-control" id="skills" value="{{ $user->jobseeker->preference->skills }}" required>
                                    <small style="color:gray">Seperate by comma (,)</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="languages" class="col-sm-3 col-form-label">Languages <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="languages" class="form-control" id="languages" value="{{ $user->jobseeker->preference->languages }}" required>
                                    <small style="color:gray">Seperate by comma (,)</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location" class="col-sm-3 col-form-label">Location <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="location" id="location" value="{{ $user->jobseeker->preference->location }}" required>
                                </div>
                            </div>
                            
                                        
                            <div class="row form-group">
                                     <label for="current_company" class="col-sm-3 col-form-label">Current Company <span style="color:red">*</span></label>
                                <div class="col-md-9">
                               
                                    <input type="text" name="current_company" class="form-control" required  value="{{ $user->jobseeker->preference->current_company }}">
                                </div>
                            
                            </div>
                            
                               <div class="row form-group">
                                 <label for="current_position" class="col-sm-3 col-form-label">Current Position <span style="color:red">*</span></label>
                                <div class="col-md-9">
                                   
                                    
                                    <input type="text" name="current_position" required class="form-control"  value="{{ $user->jobseeker->preference->current_position }}">
                                </div>
                            </div>
                            
                            
                            <div class="form-group row">
                                <label for="expected_salary" class="col-sm-3 col-form-label">Expected Salary (Rs.) <span style="color:red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="expected_salary" id="expected_salary" value="{{ $user->jobseeker->preference->expected_salary }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="current_salary" class="col-sm-3 col-form-label">Current Salary (Rs.)</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="current_salary" id="current_salary" value="{{ $user->jobseeker->preference->current_salary }}">
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