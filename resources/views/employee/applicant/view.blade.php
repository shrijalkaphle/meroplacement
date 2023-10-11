@extends('layout.employee')
@section('title', 'Applicant of ' . $job->title)
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Applicant of {{ $job->title }} </div>
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
                                <th class="text-center">Resume</th>
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
                                                        <img width="80" class="rounded-circle" src="/uploads/{{ $applicant->jobseeker->photo }}" alt="">
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
                                    <td class="text-center">
                                        <a type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm" style="color:white"target="_blank" href="{{ route('jobseeker.view',$applicant->jobseeker->user->id) }}">View</a>
                                    </td>
                                    <td class="text-right">
                                        <select name="status" id="status" onchange="changeStatus({{$applicant->id}})" class="form-control {{$applicant->status}}">
                                            <option value="">None</option>
                                            <option value="sortlisted" @if($applicant->status == 'sortlisted') selected @endif>ShortListed</option>
                                            <option value="interview" @if($applicant->status == 'interview') selected @endif>Interview</option>
                                            <option value="rejected" @if($applicant->status == 'rejected') selected @endif>Rejected</option>
                                            <option value="selected" @if($applicant->status == 'selected') selected @endif>Selected</option>
                                        </select>
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
        function changeStatus(id) {
            var status = $('#status').val()
            var classname = 'form-control ' + status
            $('#status').attr('class', classname)
            $('#loader').removeClass('hidden')
            $.ajax({
                method: 'GET',
                url: '/update-applicant/'+id+'/'+status,
                success: function(res) {
                    console.log(res)
                    $('#loader').addClass('hidden')
                }
            })
        }
    </script>
    <style>
        .sortlisted {
            border-color: #17A2B8 !important;
            color: #17A2B8 !important;
        }
        .interview {
            border-color: #FFC107 !important;
            color: #FFC107 !important;
        }
        .selected {
            border-color: #28A745 !important;
            color: #28A745 !important;
        }
        .rejected {
            border-color: #DC3545 !important;
            color: #DC3545 !important;
        }
    </style>
@endsection