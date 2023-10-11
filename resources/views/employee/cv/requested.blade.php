@extends('layout.employee')
@section('title', 'Requested CV')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Requested CV </div>
                </div>
            </div>
        </div>
        <div class="card card-body table-responsive">
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th class="text-center">Education</th>
                    <th class="text-center">Experience</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Prefered Industry</th>
                    <th class="text-center">Salary Expectation</th>
                    <th class="text-center">Location</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($employee->request as $request)
                        <tr>
                            <th colspan="8" class="text-right">Acess Till : {{ date('M j, Y | H:m:s', strtotime($request->access_till)) }}</th>
                        </tr>
                        @foreach ($request->cvlist as $list)
                            @php $jobseeker = $cvs->find($list->job_seeker_id); @endphp
                            <tr>
                                <td> {{$jobseeker->user->name}} </td>
                                <td class="text-center">
                                    @if($jobseeker->education->isnotEmpty())
                                    @foreach ($jobseeker->education->sortByDesc('qualification_id')->take(1) as $edu)
                                        {{ $edu->qualification->title }} in {{ $edu->program }}
                                    @endforeach
                                @else
                                    N.A.
                                @endif
                                </td>
                                <td class="text-center">
                                    @php 
                                        $expYears = 0; 
                                        foreach ($jobseeker->experience as $exp){
                                            $startDate = \Carbon\Carbon::parse($exp->start_date);
                                            if($exp->end_date){
                                                $endDate = \Carbon\Carbon::parse($exp->end_date);
                                            } else {
                                                $endDate = \Carbon\Carbon::now();
                                            }
                                            $diff = $startDate->diffInYears($endDate);
                                            $expYears = $expYears + $diff;
                                        }
                                    @endphp
                                    @if($expYears == 0)
                                        N.A.
                                    @else
                                        {{ $expYears }} years
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($jobseeker->age())
                                        {{ $jobseeker->age() }} years
                                    @else
                                        N.A.
                                    @endif
                                </td>
                                <td class="text-center">
                                    @php $flag = 0 @endphp
                                    @foreach ($preference as $pref)
                                        @if($pref->job_seeker_id == $jobseeker->id)
                                            @if($pref->industry_id)
                                                {{$pref->industry->title}}
                                                @php $flag = 1 @endphp
                                            @endif
                                        @endif
                                    @endforeach
                                    @if($flag == 0)
                                        N.A.
                                    @endif
                                </td>
                                <td class="text-center">
                                    @php $flag = 0 @endphp
                                    @foreach ($preference as $pref)
                                        @if($pref->job_seeker_id == $jobseeker->id)
                                            @if($pref->expected_salary)
                                                Rs. {{ $pref->expected_salary }}
                                                @php $flag = 1 @endphp
                                            @endif
                                        @endif
                                    @endforeach
                                    @if($flag == 0)
                                        N.A.
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($jobseeker->current_address)
                                        {{ $jobseeker->current_address }}
                                    @else
                                        N.A.
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a target="_blank" href="{{ route('jobseeker.view',$jobseeker->user->id) }}" class="btn btn-success">View</a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#requestedCV').addClass('mm-active')
        
    </script>
@endsection