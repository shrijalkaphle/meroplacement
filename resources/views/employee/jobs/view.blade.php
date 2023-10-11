@extends('layout.employee')
@section('title', 'All Jobs')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> My Jobs </div>
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
        <div class="container card card-body">
            <h4>Active Jobs</h4>
            @foreach ($jobs->where('status', 'active') as $job)
                <div class="job">
                    <div class="row">
                        <div class="col" style="font-weight: 600">{{ $job->title }}</div>
                        <div class="col" style="text-align: right">
                            <button class="btn btn-primary" onclick="editJob({{$job->id}})">Edit</button>
                            <button class="btn btn-danger delete-modal" data-id="{{ $job->id }}" data-toggle="modal" data-target="#deleteJob">Delete</button>
                            <i class="fas fa-chevron-down" onclick="showDetail({{$job->id}})"></i>
                        </div>
                    </div>
                </div>
                <div class="job-detail" id="detail-{{$job->id}}" style="display: none">
                    <table class="table table-borderless" style="width:100%">
                        <tr>
                            <td>Nature Of Job</td>
                            <td>:</td>
                            <td>{{ $job->nature }}</td>
                        </tr>
                        <tr>
                            <td>Job Location</td>
                            <td>:</td>
                            <td>{{ $job->location }}</td>
                        </tr>
                        <tr>
                            <td>Salary Provided</td>
                            <td>:</td>
                            <td>{{ $job->salary }}</td>
                        </tr>
                        <tr>
                            <td>Deadline</td>
                            <td>:</td>
                            <td>{{ $job->deadline }}</td>
                        </tr>
                        <tr>
                            <td>Job Description</td>
                            <td>:</td>
                            <td>{!! $job->description !!}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
        <div class="container card card-body">
            <h4>Pending Jobs</h4>
            @foreach ($jobs->where('status', 'pending') as $job)
                <div class="job">
                    <div class="row">
                        <div class="col" style="font-weight: 600">{{ $job->title }}</div>
                        <div class="col" style="text-align: right">
                            <button class="btn btn-primary" onclick="editJob({{$job->id}})">Edit</button>
                            <button class="btn btn-danger delete-modal" data-id="{{ $job->id }}" data-toggle="modal" data-target="#deleteJob">Delete</button>
                            <i class="fas fa-chevron-down" onclick="showDetail({{$job->id}})"></i>
                        </div>
                    </div>
                </div>
                <div class="job-detail" id="detail-{{$job->id}}" style="display: none">
                    <table class="table table-borderless" style="width:100%">
                        <tr>
                            <td>Nature Of Job</td>
                            <td>:</td>
                            <td>{{ $job->nature }}</td>
                        </tr>
                        <tr>
                            <td>Job Location</td>
                            <td>:</td>
                            <td>{{ $job->location }}</td>
                        </tr>
                        <tr>
                            <td>Salary Provided</td>
                            <td>:</td>
                            <td>{{ $job->salary }}</td>
                        </tr>
                        <tr>
                            <td>Deadline</td>
                            <td>:</td>
                            <td>{{ $job->deadline }}</td>
                        </tr>
                        <tr>
                            <td>Job Description</td>
                            <td>:</td>
                            <td>{!! $job->description !!}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
        <div class="container card card-body">
            <h4>Expired Jobs</h4>
            @foreach ($jobs->where('status', 'expired') as $job)
                <div class="job">
                    <div class="row">
                        <div class="col" style="font-weight: 600">{{ $job->title }}</div>
                        <div class="col" style="text-align: right">
                            <button class="btn btn-info repost-modal" data-id="{{ $job->id }}" data-toggle="modal" data-target="#repostJob">Repost</button>
                            <button class="btn btn-danger delete-modal exp-del" data-id="{{ $job->id }}" data-toggle="modal" data-target="#deleteJob">Delete</button>
                            <i class="fas fa-chevron-down" onclick="showDetail({{$job->id}})"></i>
                        </div>
                    </div>
                </div>
                <div class="job-detail" id="detail-{{$job->id}}" style="display: none">
                    <table class="table table-borderless" style="width:100%">
                        <tr>
                            <td>Nature Of Job</td>
                            <td>:</td>
                            <td>{{ $job->nature }}</td>
                        </tr>
                        <tr>
                            <td>Job Location</td>
                            <td>:</td>
                            <td>{{ $job->location }}</td>
                        </tr>
                        <tr>
                            <td>Salary Provided</td>
                            <td>:</td>
                            <td>{{ $job->salary }}</td>
                        </tr>
                        <tr>
                            <td>Deadline</td>
                            <td>:</td>
                            <td>{{ $job->deadline }}</td>
                        </tr>
                        <tr>
                            <td>Job Description</td>
                            <td>:</td>
                            <td>{!! $job->description !!}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('script')
    <div class="modal fade" id="repostJob" tabindex="-1" role="dialog" aria-labelledby="Repost Job" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteJobTitle"><i class="fas fa-info-circle" style="color:#31A66A"></i> Confirm Repost</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="repostForm" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body delete-body">
                        <div id="val"></div>
                        <div class="form-group">
                            <label for="deadline">Deadline*</label>
                            <input type="date" name="deadline" id="deadline" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-success">Repost</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="deleteJob" tabindex="-1" role="dialog" aria-labelledby="Delete Job" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteJobTitle"><i class="fas fa-info-circle" style="color:red"></i> Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="deleteForm" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body delete-body">
                        <input type="hidden" name="job_id" id="job_id">
                        <p>Are You Sure Want to Delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#managejob').addClass('mm-active')
        function showDetail(id) {
            $('#detail-'+id).slideToggle()
        }
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            var action = '/employee/job/'+id
            $('#deleteJob #deleteForm').attr("action", action)
        })
        $(document).on("click", ".repost-modal", function() {
            var id = $(this).data('id')
            var action = '/employee/job/repost/'+id
            $('#repostJob #repostForm').attr("action", action)
        })
        function editJob(id) {
            window.location.href = '/employee/job/'+id+'/edit'
        }
    </script>

    <style>
        .card {
            margin-bottom: 10px
        }
        .job,.job-detail {
            border: 1px solid #e1e1e1;
            padding: 20px;
            color: black;
        }
        tr {
            border-bottom: 1px solid #e1e1e1;
        }
        .exp-del {
            bottom-margin:20px
        }
    </style>
@endsection