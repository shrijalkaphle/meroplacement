<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    </style>
</head>
<body>
<div class="card card-body">
    <div id="profile-detail">
        <table style="table-layout:fixed;width: 100%;">
            <tr>
                <td style="width:30%">
                    @if($user->jobseeker->photo)
                        <center> <img src="https://meroplacement.com/uploads/{{ $user->jobseeker->photo }}" class="rounded-circle" height="200px"> </center>
                    @else
                        <center> <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" class="rounded-circle" height="200px"> </center>
                    @endif
                </td>
                <td style="width:60%">
                    <h3>{{ $user->name }}</h3>
                    <p>Address: {{ $user->jobseeker->current_address }}</p>
                    <p>Phone no: <a href="tel:{{ $user->number }}">{{ $user->number }}</a></p>
                    <p>Email: <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                    <p>Date of Birth: {{ date('M j, Y', strtotime($user->jobseeker->dob)) }}</p>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <h2>About Us</h2>
    <div class="profile-content">
        {!! $user->jobseeker->aboutme !!}
    </div>
    <hr>
    <h2>Personal Information</h2>
        <div class="profile-content">
            <table style="table-layout:fixed;width: 100%;">
                <tr>
                    <td style="width:25%">Gender</td>
                    <td style="width:5%">:</td>
                    <td style="width:60%;"><span style="text-transform:capitalize">{{ $user->jobseeker->gender }}</span></td>
                </tr>
                <tr>
                    <td style="width:25%">Nationality</td>
                    <td style="width:5%">:</td>
                    <td style="width:60%">{{ $user->jobseeker->nationality }}</td>
                </tr>
                <tr>
                    <td style="width:25%">Current Address</td>
                    <td style="width:5%">:</td>
                    <td style="width:60%">{{ $user->jobseeker->current_address }}</td>
                </tr>
                <tr>
                    <td style="width:25%">Permanent Address</td>
                    <td style="width:5%">:</td>
                    <td style="width:60%;">{{ $user->jobseeker->permanent_address }}</td>
                </tr>
                @if($user->jobseeker->website)
                <tr>
                    <td style="width:25%">Website</td>
                    <td style="width:5%">:</td>
                    <td style="width:60%"><a href="{{ $user->jobseeker->website }}" target="_blank" rel="noopener noreferrer">{{ $user->jobseeker->website }}</a></td>
                </tr>
                @endif
            </table>
        </div>
        <hr>
        <h2>Education</h2>
            <div class="profile-content">
                <table style="table-layout:fixed;width: 100%;">
                @foreach ($user->jobseeker->education as $education)
                    <tr>
                        <td style="width:30%; vertical-align:top">
                            {{ date('M j, Y', strtotime($education->start_date)) }} - 
                            @if($education->end_date)
                                {{ date('M j, Y', strtotime($education->end_date)) }}
                            @else
                                Present
                            @endif
                        </td>
                        <td style="width:60%">
                            <span style="font-weight:600">{{ $education->qualification->title }} in {{ $education->program }}</span>
                            <br>
                            <p>{{ $education->institute_name }} ({{ $education->board }})</p>
                            <br>
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
            <hr>
            <h2>Experience</h2>
            <div class="profile-content">
                <table style="table-layout:fixed;width: 100%;">
                @foreach ($user->jobseeker->experience as $experience)
                    <tr>
                        <td style="width:30%; vertical-align:top">
                            {{ date('M j, Y', strtotime($experience->start_date)) }} - 
                            @if($experience->end_date)
                                {{ date('M j, Y', strtotime($experience->end_date)) }}
                            @else
                                Present
                            @endif
                        </td>
                        <td style="width:60%">
                            <span style="font-weight:600">{{ $experience->position }}</span> (<span style="text-transform:capitalize">{{ $experience->position_level }}</span> Level)
                            <br>
                            <p>{{ $experience->organization_name }} @if($experience->organization_industry) ({{ $experience->organization_industry->title }}) @endif</p>
                            <p>{{ $experience->organization_location }}</p>
                            <p>{!! $experience->responsibilities !!}</p>
                            <br>
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
            <hr>
            <h2>Training/Certificates</h2>
            <div class="profile-content">
                <table style="table-layout:fixed;width: 100%;">
                @foreach ($user->jobseeker->certificate as $certificate)
                    <tr>
                        <td style="width:30%; vertical-align:top">
                            {{ date('M j, Y', strtotime($certificate->obtained_date)) }} ({{ $certificate->duration }})
                        </td>
                        <td style="width:60%">
                            <span style="font-weight:600">{{ $certificate->title }}</span>
                            <br>
                            <p>{{ $certificate->institute_name }}</p>
                            <br>
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
            <hr>
            <h2>Job Preference</h2>
            <div class="profile-content">
                <table style="table-layout:fixed;width: 100%;">
                    <tr>
                        <td style="width:25%">Job Category</td>
                        <td style="width:5%">:</td>
                        <td style="width:60%;">
                            <span style="text-transform:capitalize;font-weight:500">
                                @if($user->jobseeker->preference->industry)
                                    {{ $user->jobseeker->preference->industry->title }}
                                @else
                                    N.A.
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:25%">Looking For</td>
                        <td style="width:5%">:</td>
                        <td style="width:60%">@if($user->jobseeker->preference->looking_for) <span style="text-transform:capitalize">{{ $user->jobseeker->preference->looking_for }}<span> Level @else N.A. @endif</td>
                    </tr>
                    <tr>
                        <td style="width:25%">Specialization</td>
                        <td style="width:5%">:</td>
                        <td style="width:60%">
                            @php
                                $array = explode(',',$user->jobseeker->preference->specialization);
                                $str = null;
                                foreach ($array as $ary) {
                                    $str = $str . '<b>' . $ary . '</b>,';
                                }
                                echo substr($str, 0, -1);
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td style="width:25%">Skills</td>
                        <td style="width:5%">:</td>
                        <td style="width:60%;">
                            @php
                                $array = explode(',',$user->jobseeker->preference->skills);
                                $str = null;
                                foreach ($array as $ary) {
                                    $str = $str . '<b>' . $ary . '</b>,';
                                }
                                echo substr($str, 0, -1);
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td style="width:25%">Language</td>
                        <td style="width:5%">:</td>
                        <td style="width:60%;">
                            @php
                                $array = explode(',',$user->jobseeker->preference->languages);
                                $str = null;
                                foreach ($array as $ary) {
                                    $str = $str . '<b>' . $ary . '</b>,';
                                }
                                echo substr($str, 0, -1);
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td style="width:25%">Job Location</td>
                        <td style="width:5%">:</td>
                        <td style="width:60%;">
                            @php
                                $array = explode(',',$user->jobseeker->preference->location);
                                $str = null;
                                foreach ($array as $ary) {
                                    $str = $str . '<b>' . $ary . '</b>,';
                                }
                                echo substr($str, 0, -1);
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td style="width:25%">Expected Salary</td>
                        <td style="width:5%">:</td>
                        <td style="width:60%;"><span style="font-weight: 500">@if($user->jobseeker->preference->expected_salary) Rs. {{ $user->jobseeker->preference->expected_salary }} @else N.A. @endif</span></td>
                    </tr>
                    @if($user->jobseeker->preference->current_salary)
                    <tr>
                        <td style="width:25%">Current Salary</td>
                        <td style="width:5%">:</td>
                        <td style="width:60%"><span style="font-weight: 500">Rs. {{ $user->jobseeker->preference->current_salary }}</span></td>
                    </tr>
                    @endif
                </table>
            </div>
            <hr>
            @if($user->jobseeker->reference)
                <h2>Reference</h2>
                <div class="profile-content">
                    <table style="table-layout:fixed;width: 100%;">
                        <tr>
                            <td style="width:25%">Name</td>
                            <td style="width:5%">:</td>
                            <td style="width:60%;">{{ $user->jobseeker->reference->name }}</td>
                        </tr>
                        <tr>
                            <td style="width:25%">Position</td>
                            <td style="width:5%">:</td>
                            <td style="width:60%">{{ $user->jobseeker->reference->position }}</td>
                        </tr>
                        <tr>
                            <td style="width:25%">Organization Name</td>
                            <td style="width:5%">:</td>
                            <td style="width:60%">{{ $user->jobseeker->reference->organization_name }}</td>
                        </tr>
                        @if($user->jobseeker->reference->email)
                        <tr>
                            <td style="width:25%">Email</td>
                            <td style="width:5%">:</td>
                            <td style="width:60%"><a href="mailto:{{ $user->jobseeker->reference->email }}">{{ $user->jobseeker->reference->email }}</a></td>
                        </tr>
                        @endif
                        <tr>
                            <td style="width:25%">Contact</td>
                            <td style="width:5%">:</td>
                            <td style="width:60%">
                                <a href="tel:{{ $user->jobseeker->reference->contact_mobile }}">{{ $user->jobseeker->reference->contact_mobile }}</a> (Mobile)
                                @if($user->jobseeker->reference->contact_home)
                                | 
                                <a href="tel:{{ $user->jobseeker->reference->contact_home }}">{{ $user->jobseeker->reference->contact_home }}</a> (Home)
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
            @endif
            @if($user->social)
                <h2>Social Account</h2>
                <div class="profile-content">
                    @if($user->social->facebook)
                    <a href="{{ $user->social->facebook }}" target="_blank" >{{ $user->social->facebook }}</a> <br>
                    @endif
                    @if($user->social->twitter)
                    <a href="{{ $user->social->twitter }}" target="_blank">{{ $user->social->twitter }}</a><br>
                    @endif
                    @if($user->social->instagram)
                    <a href="{{ $user->social->instagram }}" target="_blank">{{ $user->social->instagram }}</a><br>
                    @endif
                    @if($user->social->linkedin)
                    <a href="{{ $user->social->linkedin }}" target="_blank">{{ $user->social->linkedin }}</a> <br>
                    @endif
                </div>
            @endif
        </div>
        <br><br>
        <img src="https://meroplacement.com/uploads/{{$sitesetting->logo}}" style="width:30%;float:right">
</body>
</html>