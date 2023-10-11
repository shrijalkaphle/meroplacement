@extends('layout.admin')
@section('title', 'Premium Jobs | Admin Pannel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Premium Jobs </div>
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
                <div class="main-card mb-3 py-3 card">
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Job Title</th>
                                <th class="text-center">Deadline</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Industry</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $job)
                                    <tr>
                                        <td> {{ $job->title }} </td>
                                        <td class="text-center">
                                            <div class="badge badge-warning">{{ $job->deadline }}</div>
                                        </td>
                                        <td class="text-center">{{ $job->company->user->name }}</td>
                                        <td class="text-center">@if($job->industry) {{ $job->industry->title }} @endif</td>
                                        <td class="text-center">
                                            <button type="button" id="PopoverCustomT-1" onclick="redirectApplicant({{ $job->id }})" class="btn btn-info btn-sm">View</button>
                                            <button type="button" id="PopoverCustomT-1" onclick="redirectEdit({{ $job->id }})" class="btn btn-primary btn-sm">Edit</button>
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $job->id }}" data-toggle="modal" data-target="#deleteJob">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
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
                    <h5 class="modal-title" id="addJobTitle">Add Premium Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('job.premium.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" required id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select name="company_id" id="company_id" class="form-control" required>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                         <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" name="logo" required id="" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="industry_id">Job Industry</label>
                            <select name="industry_id" id="" class="form-control" required>
                                @foreach ($industries as $industry)
                                    <option value="{{ $industry->id }}">{{ $industry->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deadline">Job Deadline</label>
                            <input type="date" name="deadline" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Job Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description(max. 250 characters)</label>
                            <textarea name="description" id="description" cols="30" rows="10" required class="form-control" maxlength="250"></textarea>
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
        $('#premium').addClass('mm-active')
        function redirectEdit(id) {
            window.location.href = '/job/premium/'+id+'/edit'
        }
        function redirectApplicant(id) {
            window.location.href = '/job/premium/'+id+'/applicant'
        }
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            $('.delete-body #job_id').val(id)
            var action = '/job/premium/'+id
            $('#deleteJob #deleteForm').attr("action", action)
        })
    </script>
@endsection