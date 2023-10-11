@extends('layout.frontend')
@section('title', 'Job Search')
@section('body')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('search') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                          <input type="text" name="search" class="form-control" value="{{ $search }}" required>
                        </div>
                        <div class="col-2">
                          <input type="submit" class="btn btn-primary" value="Search">
                        </div>
                      </div>
                </form>
                <div class="card card-body">
                    <h4>Total Jobs Found : {{ $jobs->count() }}</h4>
                    @foreach ($jobs as $job)
                        <div class="card card-body shadow-lg">
                            <div class="d-flex flex-row">
                                <img src="/uploads/{{ $job->company->logo }}" alt="" class="company-logo rounded-circle" style="max-height:60px;max-width:60px">
                                <div class="job-descpt">
                                    <h4><a href="{{ route('job.view', $job->slug) }}" style="color: #000">{{ $job->title }}</a></h4>
                                    <a href="{{ route('company.joblist', $job->company->slug) }}"><h6 style="color: #002B5C">{{ $job->company->user->name }}</h6></a>
                                    <span style="color: #f3754b"><i class="fa fa-clock-o"></i>
                                    @php
                                        $dline = new DateTime($job->deadline);
                                        $diff = $dline->diff(new DateTime());
                                        if($diff->m != 0) {
                                            echo $diff->m . " Months ";
                                        }
                                        if ($diff->d != 0) {
                                            echo $diff->d . " Days ";
                                        }
                                        if($diff->m == 0) {
                                            echo $diff->h . " Hours ";
                                        }
                                        echo " Left";
                                    @endphp
                                    </span>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($job->description), 140) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-body">
                    <h4>Jobs By Industry</h4>
                    <br>
                    <ul>
                        @foreach ($industries->take(7) as $industry)
                            <li class="d-flex flex-row justify-content-between">
                                <div><a href="{{ route('industry.joblist', $industry->slug) }}">{{ \Illuminate\Support\Str::limit($industry->title, 30) }}</a></div>
                                <div>{{$industry->job_count}}</div>
                            </li>
                        @endforeach
                        <span class="moreIndustry">
                            @php $slice = $industries->slice(7) @endphp
                            @foreach ($slice as $industry)
                            <li class="d-flex flex-row justify-content-between">
                                <div><a href="{{ route('industry.joblist', $industry->slug) }}">{{ \Illuminate\Support\Str::limit($industry->title, 30) }}</a></div>
                                <div>{{$industry->job_count}}</div>
                            </li>
                        @endforeach
                        </span>
                        <li>
                            <button class="btn-link" id="loadmore">Load More...</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <style>
        .body-content {
            margin: 150px 0
        }
        .card {
            margin-top: 50px
        }
        .company-logo {
            width: 15%;
            height: auto;
        }
        .job-descpt {
            padding-left: 10%;
        }
        ul {
            list-style-type:none;
            padding-left: 10px;
            color: black
        }
        .btn-link {
            border: 0px
        }
        .moreIndustry {
            display: none
        }
    </style>
    <script>
        $('#loadmore').on('click',() => {
            $('.moreIndustry').css('display','block')
            $('#loadmore').css('display','none')
        })
    </script>
@endsection