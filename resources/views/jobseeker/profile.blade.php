@extends('layout.frontend')
@section('title', $user->name)
@section('body')
    <div class="container" id="profile">
        <div class="card card-body" style="text-align:right">
            <div>
                <button class="btn mybtn" id="editprofile">edit profile</button>
                <button class="btn mybtn" type="button" data-toggle="modal" data-target="#downloadCV">download Cv</button>
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
        <div class="modal fade" id="downloadCV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/cv/preview" method="post">
                @csrf
                <div class="modal-body">
                    <input type="radio" name="template" id="free" value="0" checked>
                    <label for="free"> Free Template </label>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="radio" name="template" id="template1" value="1">
                            <label for="template1">
                                Template 1 <span class="badge badge-danger">Paid</span> <br>
                                <img src="/assets/img/template1.png" style="width:95%">
                            </label>
                        </div>
                        <div class="col-md-4">
                            <input type="radio" name="template" id="template2" value="2">
                            <label for="template2">
                                Template 2 <span class="badge badge-danger">Paid</span> <br>
                                <img src="/assets/img/template2.png" style="width:95%">
                            </label>
                        </div>
                        <div class="col-md-4">
                            <input type="radio" name="template" id="template3" value="3">
                            <label for="template3">
                                Template 3 <span class="badge badge-danger">Paid</span> <br>
                                <img src="/assets/img/template3.png" style="width:95%">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('paymentmethod') }}" target="_blank">Payment Methods</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Next</button>
                </div>
                </form>
                </div>
            </div>
        </div>
        <div class="card card-body">
            <div id="profile-detail" class="profile-detail">
                <div class="row">
                    <div class="col-md-3">
                        <center>
                            @if($user->jobseeker->photo)
                                <img src="/uploads/{{ $user->jobseeker->photo }}" class="rounded-circle" height="200px">
                            @else
                                <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" class="rounded-circle" height="200px">
                            @endif   
                        </center>
                    </div>
                    <div class="col-md-4" style="padding-top:25px">
                        <p class="heading">{{ $user->name }}</p>
                        <br>
                        <p>Address: {{ $user->jobseeker->current_address }}</p>
                        <p>Phone no: <a href="tel:{{ $user->number }}">{{ $user->number }}</a></p>
                        <p>Email: <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                        <p>Date of Birth: {{ date('M j, Y', strtotime($user->jobseeker->dob)) }}</p>
                    </div>
                    <div class="col-md-5" style="padding-top:25px">
                        <h6>About Me</h6>
                        {!! $user->jobseeker->aboutme !!}
                        
                    </div>
                </div>
            </div>
            <hr>
            {{-- <h4><i class="fas fa-list"></i>&nbsp; About Us</h4>
            <div class="profile-content">
                {!! $user->jobseeker->aboutme !!}
            </div> --}}
            <h4><i class="fas fa-address-card"></i>&nbsp; Personal Information</h4>
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <p>Gender : <span style="text-transform:capitalize">{{ $user->jobseeker->gender }}</span></p>
                        <p>Nationality : {{ $user->jobseeker->nationality }}</p>
                        <p>Current Address : {{ $user->jobseeker->current_address }}</p>
                        <p>Permanent Address : {{ $user->jobseeker->permanent_address }}</p>
                        @if($user->jobseeker->website)
                            <p>Website : <a href="{{ $user->jobseeker->website }}" target="_blank" rel="noopener noreferrer">{{ $user->jobseeker->website }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
            <h4><i class="fas fa-graduation-cap"></i>&nbsp; Education</h4>
            <div class="profile-content">
                @foreach ($user->jobseeker->education as $education)
                    <div class="row">
                        <div class="col-md-4">
                            {{ date('M j, Y', strtotime($education->start_date)) }} - 
                            @if($education->end_date)
                                {{ date('M j, Y', strtotime($education->end_date)) }}
                            @else
                                Present
                            @endif
                        </div>
                        <div class="col-md-8">
                            <span style="font-weight:600">{{ $education->qualification->title }} in {{ $education->program }}</span>
                            <br>
                            <p>{{ $education->institute_name }} ({{ $education->board }})</p>
                            <br>
                        </div>
                    </div>
                @endforeach
            </div>
            <h4><i class="fas fa-building"></i>&nbsp; Experience</h4>
            <div class="profile-content">
                @foreach ($user->jobseeker->experience as $experience)
                    <div class="row">
                        <div class="col-md-4">
                            {{ date('M j, Y', strtotime($experience->start_date)) }} - 
                            @if($experience->end_date)
                                {{ date('M j, Y', strtotime($experience->end_date)) }}
                            @else
                                Present
                            @endif
                        </div>
                        <div class="col-md-8">
                            <span style="font-weight:600">{{ $experience->position }}</span> (<span style="text-transform:capitalize">{{ $experience->position_level }}</span> Level)
                            <br>
                            <p>{{ $experience->organization_name }} ({{ $experience->organization_industry->title }})</p>
                            <p>{{ $experience->organization_location }}</p>
                            <p>{!! $experience->responsibilities !!}</p>
                            <br>
                        </div>
                    </div>
                @endforeach
            </div>
            <h4><i class="fas fa-certificate"></i>&nbsp; Training/Certificates</h4>
            <div class="profile-content">
                @foreach ($user->jobseeker->certificate as $certificate)
                    <div class="row">
                        <div class="col-md-4">
                            {{ date('M j, Y', strtotime($certificate->obtained_date)) }} ({{ $certificate->duration }})
                        </div>
                        <div class="col-md-8">
                            <span style="font-weight:600">{{ $certificate->title }}</span>
                            <br>
                            <p>{{ $certificate->institute_name }}</p>
                            <br>
                        </div>
                    </div>
                @endforeach
            </div>
            <h4><i class="fas fa-asterisk"></i>&nbsp; Job Preference</h4>
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <p>
                            Job Industry : 
                            <span style="text-transform:capitalize;font-weight:500">
                                @if($user->jobseeker->preference->industry_id)
                                    {{ $user->jobseeker->preference->industry->title }}
                                @else
                                    N.A.
                                @endif
                            </span>
                        </p>
                        <p>Looking For :  <span style="text-transform:capitalize">{{ $user->jobseeker->preference->looking_for }}<span> Level</p>
                        <p>Specialization :
                            @php
                                $array = explode(',',$user->jobseeker->preference->specialization);
                                foreach ($array as $ary) {
                                    echo '<span class="badge badge-info" style="margin-left:3px">' . $ary . '</span>';
                                }
                            
                            @endphp
                        </p>
                        <p>Skills : 
                            @php
                                $array = explode(',',$user->jobseeker->preference->skills);
                                foreach ($array as $ary) {
                                    echo '<span class="badge badge-info" style="margin-left:3px">' . $ary . '</span>';
                                }
                            
                            @endphp
                        </p>
                        <p>Languages : 
                            @php
                                $array = explode(',',$user->jobseeker->preference->languages);
                                foreach ($array as $ary) {
                                    echo '<span class="badge badge-info" style="margin-left:3px">' . $ary . '</span>';
                                }
                            
                            @endphp
                        </p>
                        <p>Job Location :
                            @php
                                $array = explode(',',$user->jobseeker->preference->location);
                                foreach ($array as $ary) {
                                    echo '<span class="badge badge-info" style="margin-left:3px">' . $ary . '</span>';
                                }
                            
                            @endphp
                        </p>
                        
                        @if($user->jobseeker->preference->current_company)
                            <p>Current Company : <span style="font-weight: 500">{{ $user->jobseeker->preference->current_company }}</span></p>
                        @endif
                        
                        @if($user->jobseeker->preference->current_position)
                            <p>Current position : <span style="font-weight: 500">{{ $user->jobseeker->preference->current_position }}</span></p>
                        @endif
                        
                        @if($user->jobseeker->preference->expected_salary)
                        <p>Expected  : <span style="font-weight: 500">Rs. {{ $user->jobseeker->preference->expected_salary }}</span></p>
                        @endif
                        
                        @if($user->jobseeker->preference->current_salary)
                            <p>Current Salary : <span style="font-weight: 500">Rs. {{ $user->jobseeker->preference->current_salary }}</span></p>
                        @endif
                    </div>
                </div>
            </div>
            <h4><i class="fas fa-user"></i>&nbsp; Reference</h4>
            @if($user->jobseeker->reference)
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <p>Name : {{ $user->jobseeker->reference->name }}</p>
                            <p>Position :  {{ $user->jobseeker->reference->position }}</p>
                            <p>Organization Name :  {{ $user->jobseeker->reference->organization_name }}</p>
                            
                            @if($user->jobseeker->reference->email)
                                <p>Email :  {{ $user->jobseeker->reference->email }}</p>
                            @endif
                            <p>Contact : 
                                <a href="tel:{{ $user->jobseeker->reference->contact_mobile }}">{{ $user->jobseeker->reference->contact_mobile }}</a> (Mobile)
                                @if($user->jobseeker->reference->contact_home)
                                | 
                                <a href="tel:{{ $user->jobseeker->reference->contact_home }}">{{ $user->jobseeker->reference->contact_home }}</a> (Home)
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="spacer"></div>
            @endif
            <h4><i class="fas fa-share-alt"></i>&nbsp; Social Account</h4>
            @if($user->social)
                <div class="profile-content">
                    @if($user->social->facebook)
                    <a href="{{ $user->social->facebook }}" target="_blank" style="font-size: 30px"><i class="fab fa-facebook-square"></i></a>
                    @endif
                    @if($user->social->twitter)
                    &nbsp;
                    <a href="{{ $user->social->twitter }}" target="_blank" style="font-size: 30px"><i class="fab fa-twitter-square"></i></a>
                    @endif
                    @if($user->social->instagram)
                    &nbsp;
                    <a href="{{ $user->social->instagram }}" target="_blank" style="font-size: 30px"><i class="fab fa-instagram-square"></i></a>
                    @endif
                    @if($user->social->linkedin)
                    &nbsp;
                    <a href="{{ $user->social->linkedin }}" target="_blank" style="font-size: 30px"><i class="fab fa-linkedin"></i></a>
                    @endif
                </div>
            @else
                <div class="spacer"></div>
            @endif
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
            padding-top: 100px
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
        .card {
            margin:10px;
        }
        .spacer {
            height:50px
        }
    </style>

    <script>
        $('#editprofile').on('click', ()=> {
            window.location.href="{{ route('profile.basic.edit') }}"
        })
    </script>
@endsection