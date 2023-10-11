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
                    <a class="list-div active" href="{{ route('profile.experience.edit') }}" id="experience">
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
                        <div class="row">
                            <div class="col" style="font-weight:600;padding-top:15px">Work Experience</div>
                            <div class="col" style="text-align: right">
                                <button class="btn mybtn" style="float: right" data-toggle="modal" data-target="#addExperience"><i class="fas fa-plus-circle"></i> Add</button>
                            </div>
                        </div>
                        <hr>
                        @foreach ($user->jobseeker->experience as $experience)
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <span style="font-weight:600">{{ $experience->position }}</span> (<span style="text-transform:capitalize">{{ $experience->position_level }}</span> Level)
                                    </div>
                                    <div class="col-md-4" style="text-align: right">
                                        <i class="fas fa-edit edit-model" style="cursor: pointer;" type="button" data-toggle="modal" data-all="{{ $experience }}" data-target="#editExperience"></i> 
                                        | 
                                        <i class="fas fa-trash delete-model" style="cursor: pointer;" type="button" data-toggle="modal" data-id="{{ $experience->id }}" data-target="#deleteExperience"></i>
                                    </div>
                                </div>
                                <p>{{ $experience->organization_name }} ({{ $experience->organization_industry->title }})</p>
                                <p>
                                    {{ date('M j, Y', strtotime($experience->start_date)) }} - 
                                    @if($experience->end_date)
                                        {{ date('M j, Y', strtotime($experience->end_date)) }}
                                    @else
                                        Present
                                    @endif
                                </p>
                                <p>{{ $experience->organization_location }}</p>
                                <br>
                                <p>{!! $experience->responsibilities !!}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addExperience" tabindex="-1" role="dialog" aria-labelledby="addExperienceTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExperienceTitle">Add Work Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('experience.store') }}" method="POST">
                @csrf
                <input type="hidden" name="job_seeker_id" value="{{ $user->jobseeker->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="organization_name">Organization Name <span style="color:red">*</span></label>
                        <input type="text" name="organization_name" id="organization_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="organization_nature">Organization Nature <span style="color:red">*</span></label>
                        <select name="organization_nature" id="organization_nature" class="form-control" required>
                            @foreach ($industries as $i)
                                <option value="{{ $i->id }}">{{ $i->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="organization_location">Organization Location <span style="color:red">*</span></label>
                        <input type="text" name="organization_location" id="organization_location" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="position">Position <span style="color:red">*</span></label>
                            <input type="text" name="position" id="position" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="position_level">Position Level<span style="color:red">*</span></label>
                            <select name="position_level" id="position_level" class="form-control" required>
                                <option value="top">Top Level</option>
                                <option value="senior">Senior Level</option>
                                <option value="mid">Mid Level</option>
                                <option value="entry">Entry Level</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="start_date">Started Date <span style="color:red">*</span></label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date">End Date <span style="color:red">*</span></label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                            <input type="checkbox" id="currently_working"> Currently Working
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="responsibilities">Duties & Responsibilities <span style="color:red">*</span></label>
                        <textarea name="responsibilities" id="responsibilities" cols="30" rows="10"></textarea>
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

<div class="modal fade" id="editExperience" tabindex="-1" role="dialog" aria-labelledby="addExperienceTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExperienceTitle">Edit Work Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body edit-body">
                    <div class="form-group">
                        <label for="organization_name">Organization Name <span style="color:red">*</span></label>
                        <input type="text" name="organization_name" id="organization_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="organization_nature">Organization Nature <span style="color:red">*</span></label>
                        <select name="organization_nature" id="organization_nature" class="form-control" required>
                            @foreach ($industries as $i)
                                <option value="{{ $i->id }}">{{ $i->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="organization_location">Organization Location <span style="color:red">*</span></label>
                        <input type="text" name="organization_location" id="organization_location" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="position">Position <span style="color:red">*</span></label>
                            <input type="text" name="position" id="position" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="position_level">Position Level<span style="color:red">*</span></label>
                            <select name="position_level" id="position_level" class="form-control" required>
                                <option value="top">Top Level</option>
                                <option value="senior">Senior Level</option>
                                <option value="mid">Mid Level</option>
                                <option value="entry">Entry Level</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="start_date">Started Date <span style="color:red">*</span></label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date">End Date <span style="color:red">*</span></label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                            <input type="checkbox" id="currently_working"> Currently Working
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="responsibilities">Duties & Responsibilities <span style="color:red">*</span></label>
                        <textarea name="responsibilities" id="responsibilities" cols="30" rows="10"></textarea>
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

<div class="modal fade" id="deleteExperience" tabindex="-1" role="dialog" aria-labelledby="addExperienceTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExperienceTitle">Confirm Delete</h5>
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
        $('.edit-body #organization_name').val(all.organization_name)
        $('.edit-body #organization_nature').val(all.organization_nature)
        $('.edit-body #organization_location').val(all.organization_location)
        $('.edit-body #position').val(all.position)
        $('.edit-body #position_level').val(all.position_level)
        $('.edit-body #start_date').val(all.start_date)
        if(all.end_date)
            $('.edit-body #end_date').val(all.end_date)
        else
            $('.edit-body #currently_working').attr('checked', true)
            $('.edit-body #end_date').attr('disabled', true)
            $('.edit-body #end_date').attr('required', false)
        const domEditableElement = document.querySelector( '.edit-body .ck-editor__editable' )
        const editorInstance = domEditableElement.ckeditorInstance
        editorInstance.setData(all.responsibilities)

        var action = '/jobseeker/experience/'+all.id+'/update'
        $('#editExperience #editForm').attr("action", action)
    })
    $(document).on('click', '.delete-model', function() {
        var id = $(this).data('id')
        
        var action = '/jobseeker/experience/'+id
        $('#deleteExperience #deleteForm').attr("action", action)
    })
    $(document).on('change', '.edit-body #currently_working', function() {
        if(this.checked) {
            $('.edit-body #end_date').attr('disabled', true)
            $('.edit-body #end_date').attr('required', false)
        } else {
            $('.edit-body #end_date').attr('disabled', false)
            $('.edit-body #end_date').attr('required', true)
        }
    })
    $(document).on('change', '#currently_working', function() {
        if(this.checked) {
            $('#end_date').attr('disabled', true)
            $('#end_date').attr('required', false)
        } else {
            $('#end_date').attr('disabled', false)
            $('#end_date').attr('required', true)
        }
    })
    ClassicEditor.create( document.querySelector( '#responsibilities' )).catch( error => {
        console.error( error );
    } );
    ClassicEditor.create( document.querySelector( '.edit-body #responsibilities' )).catch( error => {
        console.error( error );
    } );
</script>
@endsection