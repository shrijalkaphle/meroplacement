@extends('layout.employee')
@section('title', 'Search CV')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Search Resume </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <center><input type="text" name="search" id="search" class="form-control" style="width:50%" placeholder="Search CV" oninput="searchCV(this.value)"></center>
            </div>
            <div class="col-md-6">
                <span class="h4"> ShortListed: <span id="shortlistcount">{{ $mark->count() }}</span> </span>
                <button class="btn btn-primary ml-5" onclick=" window.location.href = 'cv/request' ">Request</button>
            </div>
            
        </div>
        <br>
        <div class="card card-body table-responsive">
            <table class="table">
                <thead>
                    <th>Education</th>
                    <th class="text-center">Experience</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Prefered Industry</th>
                    <th class="text-center">Salary Expectation</th>
                    <th class="text-center">Location</th>
                    <th></th>
                </thead>
                <tbody id="allResult">
                    @foreach ($cvs as $user)
                        <tr>
                            <td>
                                @if($user->jobseeker->education->isnotEmpty())
                                    @foreach ($user->jobseeker->education->sortByDesc('qualification_id')->take(1) as $edu)
                                        {{ $edu->qualification->title }} in {{ $edu->program }}
                                    @endforeach
                                @else
                                    N.A.
                                @endif
                            </td>
                            <td class="text-center">
                                @php 
                                    $expYears = 0; 
                                    foreach ($user->jobseeker->experience as $exp){
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
                                @if($user->jobseeker->age())
                                    {{ $user->jobseeker->age() }} years
                                @else
                                    N.A.
                                @endif
                            </td>
                            <td class="text-center">
                                @php $flag = 0 @endphp
                                @foreach ($preference as $pref)
                                    @if($pref->job_seeker_id == $user->jobseeker->id)
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
                                    @if($pref->job_seeker_id == $user->jobseeker->id)
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
                                @if($user->jobseeker->current_address)
                                    {{ $user->jobseeker->current_address }}
                                @else
                                    N.A.
                                @endif
                            </td>
                            <td class="text-center">
                                <select name="status" id="status_{{$user->jobseeker->id}}" class="form-control @if($user->jobseeker->mark->isnotEmpty()) shortlisted @endif" onchange="markCV(this.value,{{$user->jobseeker->id}})">
                                    <option value="0">None</option>
                                    <option value="1" @if($user->jobseeker->mark->isnotEmpty()) selected @endif>ShortList</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tbody id="searchResult"></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<style>
    .shortlisted {
        border-color: green;
        color: green
    }
</style>
    <script>
        $('#searchCV').addClass('mm-active')
        function markCV(val,id) {
            if(val == 1) {
                $('#status_'+id).addClass('shortlisted')
            } else {
                $('#status_'+id).removeClass('shortlisted')
            }
            $('#loader').removeClass('hidden')
            $.ajax({
                type: "GET",
                url: '/mark-cv/' + id,
                data: {id:id},
                dataType: "json",
                success: function(res) {
                    // console.log(res)
                    $('#shortlistcount').html(res.count)
                    $('#loader').addClass('hidden')
                },
            })
        }
        
        function getAge(dateString) {
            if(dateString) {
                var today = new Date();
                var birthDate = new Date(dateString);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age + ' Years';
            } else {
                return 'N.A.';
            }
        }
        
        function expYears(experience) {
            var expyears = 0
            $.each(experience, function(index,exp) {
                var startDate = new Date(exp.start_date)
                if(exp.end_date) {
                    var endDate = new Date(exp.end_date)
                } else {
                    var endDate = new Date();
                }
                var yr = endDate.getFullYear() - startDate.getFullYear();
                expyears = expyears + yr;
            })
            return expyears + ' Years';
        }
        
        function maxEdu(education) {
            educ = 'N.A.';
            var temp_id = 0;
            $.each(education, function(index,edu) {
            
                if(edu.qualification_id > temp_id) {
                    temp_id = edu.qualification_id
                    educ = edu.qualification.title + ' in ' + edu.program
                }
            })
            return educ;
        }

        function searchCV(query) {
            if (query.length > 3) {
                $('#loader').removeClass('hidden')
                $.ajax({
                    method: 'GET',
                    url: '/search-cv/'+query,
                    beforeSend:function(){
                        $('#allResult').addClass('hidden')
                    },
                    success: function(res) {
                        $('#loader').addClass('hidden')
                        $('#searchResult').removeClass('hidden')
                        console.log(res)
                        html = ''
                        industry = ''
                        salary = ''
                        $.each(res.data, function(index,user) {
                            if(user.jobseeker.preference.industry) {
                                industry = user.jobseeker.preference.industry.title
                            } else {
                                industry = 'N.A.'
                            }
                            if(user.jobseeker.preference.expected_salary) {
                                salary = 'Rs. ' + user.jobseeker.preference.expected_salary
                            } else {
                                salary = 'N.A.'
                            }
                            html = html + '<tr><td>' + maxEdu(user.jobseeker.education) + '</td><td class="text-center">' + expYears(user.jobseeker.experience) + '</td><td class="text-center">' + getAge(user.jobseeker.dob) + '</td>'
                            html = html + '<td class="text-center">' + industry + '</td><td class="text-center">' + salary + '</td><td class="text-center"> '+ user.jobseeker.current_address + '</td><td class="text-center">'
                            html = html + '<select name="status" id="status_'+ user.jobseeker.id + '" class="form-control'
                            if(user.jobseeker.mark){
                                html = html + ' shortlisted'
                            }
                            html = html + '" onchange="markCV(this.value,'+ user.jobseeker.id + '"><option value="0">None</option><option value="1" '
                            if(user.jobseeker.mark){
                                html = html + 'selected '
                            }
                            html = html + '>ShortList</option> </select>'
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