@extends('layout.admin')
@section('title', 'Expired Jobs | Admin Pannel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Expired Jobs </div>
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
                            <tbody>
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
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm activate-modal" data-id="{{ $job->id }}" data-toggle="modal" data-target="#repostJob">Repost</button>
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
    <div class="modal fade" id="repostJob" tabindex="-1" role="dialog" aria-labelledby="Activate Job" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activateJobTitle">New Job Deadline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('job.expired.repost') }}" method="post">
                    <div class="modal-body edit-model">
                        @csrf
                        <input type="hidden" id="job_id" name="job_id">
                        <div class="form-group">
                            <label>Deadline<span style="color:red">*</span></label>
                            <input type="date" name="deadline" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-success">Re-post</button>
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
        $('#pending').addClass('mm-active')
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
            var action = '/job/pending/'+id
            $('#deleteJob #deleteForm').attr("action", action)
        })
        $('.activate-modal').on('click',() => {
            var id = $('.activate-modal').data('id')
            $('.edit-model #job_id').val(id)
        })
    </script>
@endsection