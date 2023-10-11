@extends('layout.frontend')
@section('title', 'JobSeeker Dashboard')
@section('body')
    <div class="container-fluid" id="profile">
        <div class="row">
            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-body">
                        <h4>CV Download Request</h4>
                        <hr>
                        @if($recomended->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <tr>
                                    <th></th>
                                    <th class="text-center">Template</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Date</th>
                                    <th></th>
                                </tr>
                                <tbody>
                                    @foreach ($user->jobseeker->cvrequest->sortByDesc('id')->take(3) as $request)
                                        <tr>
                                            <th>#</th>
                                            <td class="text-center">{{ $request->template }}</td>
                                            <td class="text-center">{{ $request->type }}</td>
                                            <td class="text-center">{{ date('M j, Y', strtotime($request->created_at)) }}</td>
                                            <td class="text-right">
                                                <a href="/uploads/{{ $request->file }}" download><i class="fas fa-download"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <h5>No CV available for download</h5>
                        @endif
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <h4>Recomended Jobs</h4>
                        <hr>
                        @if($recomended->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <tr>
                                    <th>Title</th>
                                    <th class="text-center">Company</th>
                                    <th class="text-center">Industry</th>
                                    <th></th>
                                </tr>
                                <tbody>
                                    @foreach ($recomended->shuffle() as $job)
                                        <tr>
                                            <td>{{ $job->title }}</td>
                                            <td class="text-center">{{ $job->company->user->name }}</td>
                                            <td class="text-center">{{ $job->industry->title }}</td>
                                            <td class="text-right"><a href="{{ route('job.view', $job->slug) }}">View</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <h5>No Recommended Jobs Available</h5>
                        @endif
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <h4>Applied Jobs</h4>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-stripless">
                                <thead>
                                    <th>Title</th>
                                    <th class="text-center">Company</th>
                                    <th class="text-center">Industry</th>
                                    <th class="text-center">Applied On</th>
                                    <th class="text-center">Status</th>
                                </thead>
                                <tbody>
                                    @foreach ($user->jobseeker->apply as $apply)
                                        <tr>
                                            <td>{{ $apply->jobpost->title }}</td>
                                            <td class="text-center">{{ $apply->jobpost->company->user->name }}</td>
                                            <td class="text-center">{{ $apply->jobpost->industry->title }}</td>
                                            <td class="text-center">{{ date('M j, Y',strtotime($apply->created_at)) }}</td>
                                            <td class="text-center">{{ $apply->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="spacer"></div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h4>About Me</h4>
                        <hr>
                        <a href="{{ route('profile') }}"><i class="fa-solid fa-user pr-3"></i>Profile</a>
                        <a href="{{ route('user.changepassword') }}"><i class="fa-solid fa-key pr-3"></i>Change Password</a>
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
            padding-top: 100px
        }
        .nav-menu li a {
            color: black
        }
        .header-scrolled .nav-menu li a {
            color: white !important
        }
        .card {
            margin:10px;
        }
        
        .card h4{
            font-size: 30px;    
        }
        
        .card a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #000;
            font-size: 25px;
            font-weight: bold;
            padding: 14px 0;
        }
        
        .card a:hover{
            color: #00428a;
        }
        
        .table {
            margin-top: 20px
        }
        .spacer {
            height: 50px;
        }
        
  
    </style>

    <script>
        $('#editprofile').on('click', ()=> {
            window.location.href="{{ route('profile.basic.edit') }}"
        })
    </script>
@endsection