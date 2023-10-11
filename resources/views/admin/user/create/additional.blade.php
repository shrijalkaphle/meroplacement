@extends('layout.admin')
@section('title', 'Create JobSeeker | Admin Pannel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Create New JobSeeker > Other Information </div>
                </div>
            </div>
        </div>
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
            <div class="col-md-12">
                <div class="main-card mb-3 py-3 card card-body">
                    <form action="{{ route('user.jobseeker.additional.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div id="basic">
                            <div class="row">
                                <div class="col"><h3>Education</h3></div>
                                <div class="col" style="text-align: right">
                                    <button class="btn mybtn" type="button" style="float: right" data-toggle="modal" data-target="#addEducation"><i class="fas fa-plus-circle"></i> Add</button>
                                </div>
                            </div>
                            @foreach ($user->jobseeker->education as $education)
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 style="display: inline">{{ $education->program }}</h5> ({{ $education->qualification->title }})
                                        </div>
                                        <div class="col-md-4" style="text-align: right">
                                            <i class="fas fa-edit education-edit-model" style="cursor: pointer;" type="button" data-toggle="modal" data-all="{{ $education }}" data-target="#editEducation"></i> 
                                            | 
                                            <i class="fas fa-trash education-delete-model" style="cursor: pointer;" type="button" data-toggle="modal" data-id="{{ $education->id }}" data-target="#deleteEducation"></i>
                                        </div>
                                    </div>
                                    <p>{{ $education->institute_name }} (<span style="text-transform:capitalize">{{ $education->board }}</span>)</p>
                                    <p>
                                        {{ date('M j, Y', strtotime($education->start_date)) }} - 
                                        @if($education->end_date)
                                            {{ date('M j, Y', strtotime($education->end_date)) }}
                                        @else
                                            Present
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                            <hr>
                            <div class="row">
                                <div class="col"><h3>Experience</h3></div>
                                <div class="col" style="text-align: right">
                                    <button class="btn mybtn" type="button" style="float: right" data-toggle="modal" data-target="#addEducation"><i class="fas fa-plus-circle"></i> Add</button>
                                </div>
                            </div>
                            @foreach ($user->jobseeker->experience as $experience)
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <span style="font-weight:600">{{ $experience->position }}</span> (<span style="text-transform:capitalize">{{ $experience->position_level }}</span> Level)
                                        </div>
                                        <div class="col-md-4" style="text-align: right">
                                            <i class="fas fa-edit experience-edit-model" style="cursor: pointer;" type="button" data-toggle="modal" data-all="{{ $experience }}" data-target="#editExperience"></i> 
                                            | 
                                            <i class="fas fa-trash experience-delete-model" style="cursor: pointer;" type="button" data-toggle="modal" data-id="{{ $experience->id }}" data-target="#deleteExperience"></i>
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
                            <hr>
                            <div class="row">
                                <div class="col"><h3>Training/Certificate</h3></div>
                                <div class="col" style="text-align: right">
                                    <button class="btn mybtn" type="button" style="float: right" data-toggle="modal" data-target="#addCertificate"><i class="fas fa-plus-circle"></i> Add</button>
                                </div>
                            </div>
                            @foreach ($user->jobseeker->certificate as $certificate)
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <span style="font-weight:600">{{ $certificate->title }}</span>
                                        </div>
                                        <div class="col-md-4" style="text-align: right">
                                            <i class="fas fa-edit certificate-edit-model" style="cursor: pointer;" type="button" data-toggle="modal" data-all="{{ $certificate }}" data-target="#editCertificate"></i> 
                                            | 
                                            <i class="fas fa-trash certificate-delete-model" style="cursor: pointer;" type="button" data-toggle="modal" data-id="{{ $certificate->id }}" data-target="#deleteCertificate"></i>
                                        </div>
                                    </div>
                                    <p>{{ $certificate->institute_name }}</p>
                                    <p>
                                        {{ date('M j, Y', strtotime($certificate->obtained_date)) }} (<span style="text-transform:capitalize">{{ $certificate->duration }}</span>)
                                    </p>
                                </div>
                            @endforeach
                            <hr>
                            <h3>Social Account</h3>
                            <br>
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
                            <hr>
                            <div class="form-group">
                                <center>
                                    <input type="submit" value="Update" class="btn btn-success">
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('admin.user.create.model.experience')
@include('admin.user.create.model.education')
@include('admin.user.create.model.certificate')
    <script>
        $('#user').addClass('mm-active')
        $('#jobseeker').addClass('mm-active')
        
    </script>

    <style>
        .hidden {
            display:none;
        }
    </style>
@endsection