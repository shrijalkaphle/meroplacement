@extends('layout.admin')
@section('title', 'Applicant List | Admin Pannel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Applicant List of {{ $job->title }} </div>
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
                                <th>Name</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($job->applicant as $applicant)
                                    <tr>
                                        <th>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                             @if($applicant->jobseeker->photo)
                                                                <img width="80" class="rounded-circle" src="/uploads/{{ $applicant->jobseeker->photo }}" alt="">
                                                            @else
                                                                <img width="80" class="rounded-circle" src="/uploads/user.png" alt="">
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $applicant->jobseeker->user->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="text-center">{{ $applicant->jobseeker->current_address }}</td>
                                        <td class="text-center">{{ $applicant->jobseeker->user->email }}</td>
                                        <td class="text-center">{{ $applicant->status }}</td>
                                        <td class="text-center">
                                            <a type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm" style="color:white"target="_blank" href=" {{ route('jobseeker.view',$applicant->jobseeker->user->id) }}">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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