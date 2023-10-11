@extends('layout.frontend')
@section('title', 'Jobs posted by ' . $company->user->name)
@section('body')

<div class="body-content">
    <div class="container">
        
             <div class="company-details row">
                <div class="row">
                    <div class="text-center col-md-12">
                        <img src="/uploads/{{ $company->logo }}" class="company-logo">
                    </div>
                    <div class="text-left col-md-12 pt-4 headline">
                        <div class="company-descpt">
                            <h4 style="color: #fff; font-size: 25px; font-weight: bold;">{{ $company->user->name }}</h4>
                            <br>
                            <p style="color: #fff; font-size: 16px">{{ \Illuminate\Support\Str::limit(strip_tags($company->description), 240) }}</p>
                        </div>
                    </div>
                </div>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class='card'>
                
                <div class="card-header">
                    <b><span>Total Jobs Found : {{ $company->jobpost->count() }}</</span></b>
                </div>
                        
                <div class="card-body">
                    @foreach ($company->jobpost->where('status','=','active') as $job)
                        <div class="card card-body shadow-lg">
                            <div class="d-flex flex-row">
                                <img src="/uploads/{{ $job->logo }}" alt="" class="company-logo rounded-circle" style="height:70px;width:70px">
                                <div class="job-descpt">
                                    <h4><a href="{{ route('job.view', $job->slug) }}" style="color: #000">{{ $job->title }}</a></h4>
                                    <h6 style="color: #002B5C">{{ $job->company->user->name }}</h6>
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
                                    <!--<p>{{ \Illuminate\Support\Str::limit(strip_tags($job->description), 140) }}</p>-->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
            <div class="col-md-4">
                  <div class="card">
                        <div class="card-header">
                            <b><span>Jobs By Industry</span></b>
                        </div>
                        <div class="card-body">
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
</div>

@endsection

@section('script')
    <style>
      body{
            background: #EDEDF2;
        
    }
        .body-content {
            margin: 150px 0
        }
        .card {
            margin-top: 10px
        }
        
        .card-header {
            background-color: #00428a;

        }
        
        .card-header span {

            color: #fff;
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
        
         .company-logo {
            width: 30%;
            height: 170px;
        }
        .company-details {
            background: #fff;
            margin-bottom: 30px;
            border-radius: 20px;
            border-top: 5px solid #00428a;
        }
        
          .company-details .headline {
            background: #00428a;
            margin-top: 50px;
            padding: 15px 30px;

        }
        
        @media (max-width: 673px) {
           .company-logo {
                width: 50%;
                height: auto;
            }
    </style>
    <script>
        $('#loadmore').on('click',() => {
            $('.moreIndustry').css('display','block')
            $('#loadmore').css('display','none')
        })
    </script>
@endsection