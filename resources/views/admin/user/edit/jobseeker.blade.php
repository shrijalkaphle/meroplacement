@extends('layout.admin')
@section('title', 'Create JobSeeker | Admin Pannel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Create New JobSeeker </div>
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
                <div class="main-card mb-3 py-3 card card-body">
                    <form action="{{ route('user.jobseeker.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div id="basic">
                            <div class="form-group">
                                <label for="name">Name <span style="color:red">*</span></label>
                                <input type="text" name="name" required class="form-control" value="{{ $user->name }}">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="email">Email <span style="color:red">*</span></label>
                                    <input type="email" name="email" required class="form-control" value="{{ $user->email }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="number">Number <span style="color:red">*</span></label>
                                    <input type="number" name="number" required class="form-control" value="{{ $user->number }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span style="color:red">*</span></label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="gender">Gender <span style="color:red">*</span></label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="male">Male</option>
                                        <option value="female"@if($user->jobseeker->gender == 'female') selected @endif>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="dob">Date of Birth <span style="color:red">*</span></label>
                                    <input type="date" name="dob" required class="form-control"  value="{{ $user->jobseeker->dob }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="website">Website</label>
                                    <input type="text" name="website" class="form-control"  value="{{ $user->jobseeker->website }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="nationality">Nationality <span style="color:red">*</span></label>
                                    <input type="text" name="nationality" required class="form-control"  value="{{ $user->jobseeker->nationality }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="current_address">Current Address <span style="color:red">*</span></label>
                                    <input type="text" name="current_address" required class="form-control"  value="{{ $user->jobseeker->current_address }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="permanent_address">Permanent Address</label>
                                    <input type="text" name="permanent_address" class="form-control"  value="{{ $user->jobseeker->permanent_address }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="photo">Photo</label>
                                    <input type="file" name="photo" onchange="LoadImage(event)" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <img src="/uploads/{{ $user->jobseeker->photo }}" id="preview" style="max-height:150px">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="aboutme">About Me <span style="color:red">*</span></label>
                                <textarea name="aboutme" id="aboutme" cols="30" rows="10">{{ $user->jobseeker->aboutme }}</textarea>
                            </div>
                            <hr>
                            <h3>Job Seeker Preference</h3>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="industry_id">Industry <span style="color:red">*</span></label>
                                    <select name="industry_id" required class="form-control">
                                        @foreach ($industries as $i)
                                            <option value="{{ $i->id }}">{{ $i->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="specialization">Specialization <span style="color:red">*</span></label>
                                    <input type="text" name="specialization" required class="form-control"  value="{{ $user->jobseeker->preference->specialization }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="location">Location <span style="color:red">*</span></label>
                                    <input type="text" name="location" required class="form-control"  value="{{ $user->jobseeker->preference->location }}">
                                </div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="current_company">Current Company <span style="color:red">*</span></label>
                                    <input type="text" name="current_company" class="form-control" required  value="{{ $user->jobseeker->preference->current_company }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="current_position">Current Position <span style="color:red">*</span></label>
                                    <input type="text" name="current_position" required class="form-control"  value="{{ $user->jobseeker->preference->current_position }}">
                                </div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="current_salary">Current Salary(NPR.)</label>
                                    <input type="text" name="current_salary" class="form-control"  value="{{ $user->jobseeker->preference->current_salary }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="expected_salary">Expected Salary(NPR.) <span style="color:red">*</span></label>
                                    <input type="text" name="expected_salary" required class="form-control"  value="{{ $user->jobseeker->preference->expected_salary }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <center>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    <script>
        $('#user').addClass('mm-active')
        $('#jobseeker').addClass('mm-active')
        ClassicEditor.create( document.querySelector( '#aboutme' ) ).catch( error => {
            console.error( error );
        } );
        var LoadImage = function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection