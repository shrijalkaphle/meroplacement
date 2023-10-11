@extends('layout.employee')
@section('title', 'Job Applicant')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Applicant </div>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 py-3 card ">
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Job Title</th>
                                <th class="text-center">Applicant Count</th>
                                <th class="text-center">Deadline</th>
                                <th class="text-center">Posted On</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $job)
                                    <tr>
                                        <th> {{ $job->title }} </th>
                                        <td class="text-center">{{ $job->applicant_count }}</td>
                                        <td class="text-center">
                                            <div class="badge badge-danger">{{ date('M j, Y',strtotime($job->deadline)) }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-info">{{ date('M j, Y',strtotime($job->created_at)) }}</div>
                                        </td>
                                        <td class="text-center">
                                            <a type="button" id="PopoverCustomT-1" style="color:white" href="{{ route('employee.applicant.show', $job->id) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        {{$jobs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#applicant').addClass('mm-active')
    </script>
@endsection