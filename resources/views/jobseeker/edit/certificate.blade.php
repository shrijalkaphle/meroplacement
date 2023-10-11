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
                    <a class="list-div " href="{{ route('profile.education.edit') }}">
                        <i class="fas fa-graduation-cap"></i> &nbsp; Education
                    </a>
                    <a class="list-div " href="{{ route('profile.experience.edit') }}" id="experience">
                        <i class="fas fa-building"></i> &nbsp; Experience
                    </a>
                    <a class="list-div active" href="{{ route('profile.training.edit') }}" id="training">
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
                        <div class="row">
                            <div class="col" style="font-weight:600;padding-top:15px">Training/Certificate</div>
                            <div class="col" style="text-align: right">
                                <button class="btn mybtn" style="float: right" data-toggle="modal" data-target="#addEducation"><i class="fas fa-plus-circle"></i> Add</button>
                            </div>
                        </div>
                        <hr>
                        @foreach ($user->jobseeker->certificate as $certificate)
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <span style="font-weight:600">{{ $certificate->title }}</span>
                                    </div>
                                    <div class="col-md-4" style="text-align: right">
                                        <i class="fas fa-edit edit-model" style="cursor: pointer;" type="button" data-toggle="modal" data-all="{{ $certificate }}" data-target="#editEducation"></i> 
                                        | 
                                        <i class="fas fa-trash delete-model" style="cursor: pointer;" type="button" data-toggle="modal" data-id="{{ $certificate->id }}" data-target="#deleteEducation"></i>
                                    </div>
                                </div>
                                <p>{{ $certificate->institute_name }}</p>
                                <p>
                                    {{ date('M j, Y', strtotime($certificate->obtained_date)) }} (<span style="text-transform:capitalize">{{ $certificate->duration }} Months</span>)
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addEducation" tabindex="-1" role="dialog" aria-labelledby="addEducationTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEducationTitle">Add Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('certificate.store') }}" method="POST">
                @csrf
                <input type="hidden" name="job_seeker_id" value="{{ $user->jobseeker->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title <span style="color:red">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="institute_name">Name of Institute <span style="color:red">*</span></label>
                        <input type="text" name="institute_name" id="institute_name" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="duration">Duration(in months) <span style="color:red">*</span></label>
                            <input type="text" name="duration" id="duration" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="obtained_date">Obtained At <span style="color:red">*</span></label>
                            <input type="date" name="obtained_date" id="obtained_date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editEducation" tabindex="-1" role="dialog" aria-labelledby="editEducationTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEducationTitle">Edit Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body edit-body">
                    <div class="form-group">
                        <label for="title">Title <span style="color:red">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="institute_name">Name of Institute <span style="color:red">*</span></label>
                        <input type="text" name="institute_name" id="institute_name" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="duration">Duration(in months) <span style="color:red">*</span></label>
                            <input type="text" name="duration" id="duration" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="obtained_date">Obtained At <span style="color:red">*</span></label>
                            <input type="date" name="obtained_date" id="obtained_date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteEducation" tabindex="-1" role="dialog" aria-labelledby="deleteEducationTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEducationTitle">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p>Are You Sure Want to Delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
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

    $(document).on('click', '.edit-model', function() {
        var all = $(this).data('all')
        $('.edit-body #title').val(all.title)
        $('.edit-body #institute_name').val(all.institute_name)
        $('.edit-body #duration').val(all.duration)
        $('.edit-body #obtained_date').val(all.obtained_date)
        
        var action = '/jobseeker/certificate/'+all.id+'/update'
        $('#editEducation #editForm').attr("action", action)
    })

    $(document).on('click', '.delete-model', function() {
        var id = $(this).data('id')
        
        var action = '/jobseeker/certificate/'+id
        $('#deleteEducation #deleteForm').attr("action", action)
    })
</script>
@endsection