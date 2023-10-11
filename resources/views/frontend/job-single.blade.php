@extends('layout.frontend')
@section('title', $job->title . ' | Mero Placement')
@section('body')
<section class="post-area section-gap">
    <div class="container-fluid">
        <div class="company-details">
            <div class='row'>
                
            <div class="text-center col-md-12">
                <img src="/uploads/{{ $job->company->logo }}" class="company-logo">
            </div>
            <div class="text-left col-md-12 pt-4 headline">
                <div class="company-descpt">
                    <h4 style="color: #fff; font-size: 25px; font-weight: bold;">{{ $job->company->user->name }}</h4>
                    <br>
                    <p style="color: #fff; font-size: 16px">{{ \Illuminate\Support\Str::limit(strip_tags($job->company->description), 240) }}</p>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
          
            
            <div class="col-lg-8 post-list">
                 <h4 style="color: #000; font-size: 25px; font-weight: bold; margin-bottom:10px;">{{ $job->title }}
                  <span style="color:#00428a;font-size:18px;"> ({{ $job->applicant_count }} applicant)</span>
                                        <span style="color:#00428a;font-size:18px;float:right;">{{str_pad(($job->views*2), 4, '0', STR_PAD_LEFT)}} views</span>
                                   </h4>
                <div class="single-post" style="background: #EDEDF2" id="minimal-statistics">
    
                    <div class="row mt-3">
                        
                      <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex">
                              <div class="align-self-center">
                                <i class="fas fa-heading"></i>
                              </div>
                              <div class="text-left ml-2">
                                <h3>Education Requirement</h3>
                                <p class="mb-0">{{ $job->education }}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex">
                              <div class="align-self-center">
                                <i class="fas fa-money-bill-alt"></i>
                              </div>
                              <div class="text-left ml-2">
                                <h3>Offered Salary</h3>
                                <p class="mb-0">{{ $job->salary }}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                           <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex">
                              <div class="align-self-center">
                                <i class="fas fa-map-marker-alt"></i>
                              </div>
                              <div class="text-left ml-2">
                                <h3>Location</h3>
                                <p class="mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($job->location), 80) }}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                       <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex">
                              <div class="align-self-center">
                                <i class="fas fa-sort-numeric-up-alt"></i>
                              </div>
                              <div class="text-left ml-2">
                                <h3>No. of Vacancy</h3>
                                <p class="mb-0">{{ $job->vacancyno }}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                       <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex">
                              <div class="align-self-center">
                                <i class="fas fa-suitcase"></i>
                              </div>
                              <div class="text-left ml-2">
                                <h3>Job Type</h3>
                                <p class="mb-0">{{ $job->nature}}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                       <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex">
                              <div class="align-self-center">
                                <i class="far fa-clock"></i>
                              </div>
                              <div class="text-left ml-2">
                                <h3>Apply Before</h3>
                                <p class="mb-0">{{ $job->deadline }}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      </div>
      

                </div>	
                
                <h4 style="color: #000; font-size: 25px; font-weight: bold; margin-bottom:10px;">Job Description</h4>
                <div class="single-post job-details">
   
                    {!! $job->description !!}
                </div>
                
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-6">
                                @if(Session::has('user'))
                                    <button class="apply-btn" onclick="applyThisJob({{ $job->id }})">Apply</button>
                                @else
                                    <a href='{{ route('login') }}' class="btn btn-primary" disabled>Login To Apply</a>
                                @endif
                            </div>
                            <div class="col-md-6">
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
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div id="status"></div>
                    </div>
                </div>
                <div class="share-btn">
                  <a href="#" class="facebook-btn"><i class="fab fa-facebook"></i></a>
                  <a href="#" class="twitter-btn"><i class="fab fa-twitter"></i></a>
                  <a href="#" class="linkedin-btn"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="col-lg-4">
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
</section>
@csrf
@endsection
@section('script')
    <link rel="stylesheet" href="/social-share.css">
    <script src="/social-share.js"></script>
    <style>
    body{
            background: #EDEDF2;
        
    }
        .post-area {
            padding: 50px 0
        }
        
          .post-area .card-header {
            background-color: #00428a;

        }
        
         .post-area .card-header span {

            color: #fff;
        }
        
        .apply-btn {
            border: 0;
            padding: 10px 20px;
            background: #63E2FA;
            text-transform: uppercase;
            color:white;
        }
        .apply-btn:hover:enabled {
            color: #63E2FA;
            background:white;
            border: 1px solid #63E2FA
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
            margin-bottom: 60px;
            border-radius: 20px;
            border-top: 5px solid #00428a;
        }
        
          .company-details .headline {
            background: #00428a;
            margin-top: 50px;
            padding: 15px 30px;

        }
        
        .single-post .card{
            border-bottom: 4px solid #00428a;
            border-left: 4px solid #00428a;
        }
        
        .single-post h3{
            font-size: 18px;
            font-weight: bold;
        }
        
        .single-post p{
             color: #00428a;
        }
        
        
        .single-post i{
            font-size: 22px;
            color: #00428a;
        }
        
          .single-post .col-lg-4{
            margin-bottom: 10px;
        }
        
        
        
    
        @media (max-width: 673px) {
            
            .container-fluid{
                padding-left: 0 !important; 
                padding-right: 0 !important; 
            }
            
           .company-logo {
                width: 50%;
                height: auto;
            }
            .single-post {
                width:100%;
            }
        }
    </style>

    <script>
        function applyThisJob(id) {
            $('#loading').removeClass('hidden')
            var _token = $('input[name="_token"').val()
            $.ajax({
                url: '/job/apply',
                method: 'post',
                data: {_token:_token, job_post_id: id},
                dataType: 'JSON',
                success: function(data) {
                    console.log(data.status)
                    html = ''
                    if(data.status == 'success') {
                        html = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong><i class="fas fa-check-circle"></i></strong> ' + data.msg + '</div>'
                    } else {
                        html = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong><i class="fas fa-exclamation-circle"></i></strong> ' + data.msg + '</div>'
                    }
                    $('#status').html(html)
                    $('#loading').addClass('hidden')
                }
            })
        }
        $('#loadmore').on('click',() => {
            $('.moreIndustry').css('display','block')
            $('#loadmore').css('display','none')
        })
    </script>
@endsection