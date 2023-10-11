@extends('layout.admin')
@section('title', 'Active Jobs | Admin Pannel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Active Jobs </div>
                </div>
                <div class="page-title-actions">
                    <button type="button" class="btn-shadow mr-3 btn btn-dark" data-toggle="modal" data-target="#addJob">
                        <i class="fas fa-plus"></i> Add New Job
                    </button>
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
        <div class="row">
            <div class="col-md-12">
                <div class="text-right" style="height: 40px">
                    <input type="search" name="search" id="search" class="form-control" style="width:25%;float:right" placeholder="Search" oninput="searchJob(this.value)">
                </div>
                <br>
                <div class="main-card mb-3 py-3 card">
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Nature</th>
                                <th class="text-center">Vacancy No.</th>
                                <th class="text-center">Deadline</th>
                                <th class="text-center">Location</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Industry</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody id="allResult">
                                @foreach ($jobs as $job)
                                    <tr>
                                        <td> {{ $job->title }} </td>
                                        <td class="text-center">{{ $job->nature }}</td>
                                        <td class="text-center">{{ $job->vacancyno }}</td>
                                        <td class="text-center">
                                            <div class="badge badge-warning">{{ $job->deadline }}</div>
                                        </td>
                                        <td class="text-center">{{ $job->location }}</td>
                                        <td class="text-center">{{ $job->company->user->name }}</td>
                                        <td class="text-center">@if($job->industry) {{ $job->industry->title }} @endif</td>
                                        <td class="text-center">
                                            <button type="button" id="PopoverCustomT-1" onclick="redirectEdit({{ $job->id }})" class="btn btn-primary btn-sm">Edit</button>
                                            @if (Session::get('user')['role'] == 'admin')
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $job->id }}" data-toggle="modal" data-target="#deleteJob">Delete</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody id="searchResult"></tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer" id="paginate">
                        {{ $jobs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <div class="modal fade" id="addJob" tabindex="-1" role="dialog" aria-labelledby="Add Job" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJobTitle">Add Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('job.active.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" required id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" name="logo" required id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select name="company_id" id="" class="form-control" required>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class='col-md-6'>
                                    <label for="industry_id">Job Industry</label>
                            <select name="industry_id" id="" class="form-control" required>
                                @foreach ($industries as $industry)
                                    <option value="{{ $industry->id }}">{{ $industry->title }}</option>
                                @endforeach
                            </select>
                                
                            </div>
                            
                            <div class='col-md-6'>
                                 <label for="nature">Education Requirement</label>
                                <input type="text" name="education" class="form-control" required>
                                
                            </div>
                        
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="nature">Job Type</label>
                                <input type="text" name="nature" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="location">Job Location</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="vacancyno">Number of Vacancy</label>
                                <input type="text" name="vacancyno" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="salary">Salary</label>
                                <input type="text" name="salary" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="deadline">Job Deadline</label>
                                <input type="date" name="deadline" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Add</button>
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
        $('#job').addClass('mm-active')
        $('#active').addClass('mm-active')
        ClassicEditor.create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            }
        );
        function redirectEdit(id) {
            window.location.href = '/job/active/'+id+'/edit'
        }
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            $('.delete-body #job_id').val(id)
            var action = '/job/active/'+id
            $('#deleteJob #deleteForm').attr("action", action)
        })
        function searchJob(query) {
            if (query.length > 2) {
                $('#loader').removeClass('hidden')
                $.ajax({
                    method: 'GET',
                    url: '/search-job/'+query,
                    data: {query: query},
                    dataType: "json",
                    beforeSend:function(){
                        $('#allResult').addClass('hidden')
                        $('#paginate').addClass('hidden')
                        $('#searchResult').removeClass('hidden')
                    },
                    success: function(res) {
                        console.log(res)
                        $('#loader').addClass('hidden')
                        html = ''
                        $.each(res.data, function(index,job) {
                            html = html + '<tr><td>' + job.title + '</td><td class="text-center">' + job.nature + '</td><td class="text-center">' + job.vacancyno + '</td>'
                            html = html + '<td class="text-center"><div class="badge badge-warning">' + job.deadline + '</div></td><td class="text-center">' + job.location + '</td>'
                            html = html + '<td class="text-center">' + job.company.user.name + '</td><td class="text-center">' + job.industry.title + '</td><td class="text-center">'
                            html = html + '<button type="button" id="PopoverCustomT-1" onclick="redirectEdit(' + job.id + ')" class="btn btn-primary btn-sm">Edit</button>'
                            html = html + '<button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="' + job.id + '" data-toggle="modal" data-target="#deleteJob">Delete</button>'
                            html = html + '</td></tr>'
                        })
                        $('#searchResult').html(html)
                    },
                })
            }else {
                $('#allResult').removeClass('hidden')
                $('#searchResult').addClass('hidden')
                $('#loader').addClass('hidden')
            }
        }
    </script>
@endsection 