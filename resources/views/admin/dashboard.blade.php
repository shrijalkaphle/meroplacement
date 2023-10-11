@extends('layout.admin')
@section('title', 'Admin Panel')
@section('body')

<div class="app-main__outer">
    <div class="app-main__inner">
          <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Dashboard </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('job.pending') }}" type="button" class="btn-shadow mr-3 btn btn-dark">
                        <i class="fa fa-plus"></i> Pending Approval
                    </a>
                </div>
            </div>
        </div>
 
                        <!--<a href="{{ route('job.pending') }}" id="pending">-->
                        <!--                    <i class="metismenu-icon ml-5 pl-5"></i>-->
                        <!--                    Pending Approval-->
                        <!--                </a>-->
      
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
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Jobs</div>
                            <div class="widget-subheading">Total Job posted</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ $totalJob }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">JobSeekers</div>
                            <div class="widget-subheading">Active jobseekers</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ $totalJobseeker }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Employee</div>
                            <div class="widget-subheading">Active employee</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ $totalEmployee }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            
               <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Active Jobs</div>
                            <div class="widget-subheading">Active Jobs</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ $active }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            
               <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Expired Jobs</div>
                            <div class="widget-subheading">Expired Jobs</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ $expired }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            
               <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Pending Jobs</div>
                            <div class="widget-subheading">Pending Jobs</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ $pending }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-premium-dark">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Products Sold</div>
                            <div class="widget-subheading">Revenue streams</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning"><span>$14M</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Session::get('user')['role'] == 'admin')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>JobSeeker CV Download Request</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th></th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Template ID</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($cvrequest->sortByDesc('id')->take(4) as $req)
                                    <tr>
                                        <td>#</td>
                                        <td class="text-center">{{ $req->jobseeker->user->name }}</td>
                                        <td class="text-center">{{ $req->template }}</td>
                                        <td class="text-right">
                                            <a href="/cv/preview/{{ $req->jobseeker->user->id }}/{{ $req->template }}" target="_blank" class="btn btn-primary">View</a>
                                            <a href="/cv/deliver/{{ $req->id }}" class="btn btn-success">Send</a>
                                            <a href="/cv/delete/{{ $req->id }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-right p-3">
                        <a class="btn btn-primary" href="{{ route('cvdownloadrequest.all') }}">View All...</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>CV Access Request</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th></th>
                                    <th>Name</th>
                                    <th class="text-center">Number of CV</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($cvaccess->sortByDesc('id')->take(4) as $cv)
                                    <tr>
                                        <td>#</td>
                                        <td>{{ $cv->company->user->name }}</td>
                                        <td class="text-center">{{ $cv->cvlist->count() }}</td>
                                        <td class="text-right">
                                            <a href="/cv/access/list/{{$cv->id}}" target="_blank" class="btn btn-primary">View</a>
                                            <a href="/cv/access/grant/{{$cv->id}}" class="btn btn-success">Send</a>
                                            <a href="/cv/access/delete/{{ $cv->id }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-right p-3">
                        <a class="btn btn-primary" href="{{ route('cvaccessrequest.all') }}">View All...</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="spacer"></div>
        <div class="row vacancy">
            <div class="col-md-12">
                <center>
        <h2>Vacancy List</h2>
    </center>
    <div class="accordion" id="accordionExample">
        @foreach($vacancy as $v)
        <div class="card">
            <div class="card-header d-flex justify-content-between" data-toggle="collapse" data-target="#collapseOne{{$v->id}}" aria-expanded="true">     
                <span class="title"># {{$v->title}} By {{$v->author}} </span>
                <button type="button" id="PopoverCustomT-1" onclick="redirectEdit({{ $v->id }})" class="btn btn-primary btn-sm">Edit</button>
                <!--<span class="accicon"><i class="fas fa-angle-down rotate-icon text-tight"></i></span>-->
            </div>
            <div id="collapseOne{{$v->id}}" class="collapse show" data-parent="#accordionExample">
                <div class="card-body">
                    {!! $v->content !!}
                </div>
            </div>
        </div>
        @endforeach

 
    </div>
            </div>
        </div>
        <div class="spacer"></div>

    </div>
</div>
@endsection

@section('script')
    <script>
        $('#dashboard').addClass('mm-active')
    </script>
    
       <script>
        $('#other').addClass('mm-active')
        $('#blog').addClass('mm-active')
        function redirectEdit(id) {
            window.location.href = '/vacancy/'+id+'/edit'
        }
 

        ClassicEditor.create( document.querySelector( '#content' )).catch( error => {
            console.error( error );
        } );
    </script>
    
    <style>
        .card-link {
            text-align: right
        }
        .spacer {
            height:20px
        }
        
        .dash a{
            text-decoration: none;
            background-color: ;
        }
        
       .vacancy .card-header .title {
    font-size: 17px;
    color: #000;
}
.vacancy .card-header .accicon {
  float: right;
  font-size: 20px;  
  width: 1.2em;
}
.vacancy .card-header{
  cursor: pointer;
  border-bottom: none;
}
.vacancy .card{
  border: 1px solid #ddd;
}
.vacancy .card-body{
  border-top: 1px solid #ddd;
}
.vacancy .card-header:not(.collapsed) .rotate-icon {
  transform: rotate(180deg);
}

.vacanct .btn{
    font-size: 20px;
    padding: 5px;
}
    </style>
@endsection