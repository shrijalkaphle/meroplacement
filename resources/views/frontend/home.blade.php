@extends('layout.frontend')
@section('title', 'Mero Placement')
@section('body')  

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v13.0" nonce="E2BExJ3J"></script>

<!--job->company->user->name-->
    <section id="intro">
        <div class="splide splide-slider">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($sliders as $slide)
                    <li class="splide__slide">
                        <img src="/uploads/{{$slide->photo}}">
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div id="content">
            <div class="form-div not-mobile">
                <form action="{{ route('search') }}" method="post" autocomplete="off" class="serach-form-area">
                    @csrf
                    <div class="row justify-content-center form-wrap">
                        <div class="col-lg-9 form-cols">
                            <input type="text" autocomplete="off" class="form-control" name="search" placeholder="what are you looking for?">
                        </div>
                        <div class="col-lg-3 form-cols">
                            <button type="submit" class="btn btn-info">
                                <span class="lnr lnr-magnifier"></span> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="form-div mobile"> 
                <form action="{{ route('search') }}" method="post" autocomplete="off" class="serach-form-area">
                    @csrf
   
                    <div class="row form-wrap">
                        <div class="input-group" style="width:100%;padding-top:10px; padding-bottom:10px">
                            <input type="text" autocomplete="off" class="form-control cstmInput" name="search" placeholder="what are you looking for?">
                            <button class="btn btn-success cstmInput" style="width:10%">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
    
    <section class="post-area section-gap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <b><span>Recent Job Posts</span></b>
                        </div>
                        <div class="card-body">
                            <div class="row" style="margin: -10px">
                                @foreach ($jobs as $job)
                                    <div class="col-md-4 border-right border-top border-left border-bottom">
                                        <div class="job-card">
                                            <div class="media">
                                                <div class="img">
                                                    <img src="/uploads/{{ $job->logo }}" class="rounded-circle" style="height:60px;width:60px">
                                                </div>
                                                <div class="info">
                                                    <a href="{{ route('job.view', $job->slug) }}" class='d-inline-block text-truncate' style="color: #000; max-width: 150px; font-size: 14px">{{ $job->title }} </a> <br>
                                                    <a href="{{ route('company.joblist', $job->company->slug) }}" class='d-inline-block text-truncate' style="color: #03a9f4;max-width: 150px; font-size: 12px">{{ $job->location }}</a> <br>
                                                        
                                                    <span style="max-width: 150px; font-size: 12px" class='d-inline-block text-truncate text-danger'><i class="fa fa-clock-o"></i>
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
                                                <i class="fas fa-share-alt text-success share-modal" id="share" data-slug="{{ $job->slug }}" data-toggle="modal" data-target="#shareModel"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <b><span>Premium Jobs</span></b>
                        </div>
                        @if(Session::has('applysuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-transform: capitalize">
                                <strong> <i class="fas fa-check-circle"></i></strong>
                                {{ Session::get('applysuccess') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(Session::has('applyerror'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-transform: capitalize">
                                <strong> <i class="fas fa-times-circle"></i></strong>
                                {{ Session::get('applyerror') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="splide splide-premium">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($premiumJobs as $job)
                                        <li class="splide__slide">
                                            <div class="single-rated">
                                                <h4>{{ $job->title }}</h4>
                                                @if($job->industry)
                                                <h6>{{ $job->industry->title }}</h6>
                                                @endif
                                                <p class="address">
                                                    <i class="fas fa-map-marker-alt"></i> {{ $job->address }}
                                                </p>
                                              
                                                <img src='/uploads/{{ $job->logo }}' width='100%' height='200px'>
                                          
                                                <button type="button" class="btns text-uppercase apply-modal mt-3" data-id="{{ $job->id }}" data-toggle="modal" data-target="#premiumApply">Apply job</button>
                                            </div>
                                            <div id="status{{$job->id}}"></div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div style="height:25px"></div>
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
                    
                    <div style="height:25px"></div>
                    <div class="card">
                        <div class="card-header">
                            <b><span>Facebook Page</span></b>
                        </div>
                        <div class="card-body">
                            <div class="fb-page" data-href="https://www.facebook.com/meroplacements/?ref=pages_you_manage" data-tabs="timeline" data-width="235px" data-height="" data-small-header="false" data-adapt-container-width="true" 
                            data-hide-cover="true" data-show-facepile="true"> <blockquote cite="https://www.facebook.com/meroplacements/?ref=pages_you_manage" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/meroplacements/?ref=pages_you_manage">Mero Placement</a></blockquote></div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- End post Area -->
    
    <div class="modal fade" id="shareModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="row text-center p-5 h1">
                    <div class="col">
                        <a type="button" class="facebook-btn" style="cursor:pointer"><i class="fab fa-facebook"></i></a>
                    </div>
                    <div class="col">
                        <a type="button" class="twitter-btn" style="cursor:pointer"><i class="fab fa-twitter"></i></a>
                    </div>
                    <div class="col">
                        <a type="button" class="linkedin-btn" style="cursor:pointer"><i class="fab fa-linkedin share-icon"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="premiumApply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apply For Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('apply.premium') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body apply-body">
                        <input type="hidden" name="premium_job_id" id="id">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input type="text" name="name" required id="name" value="{{ old('name') }}" class="form-control">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email">Email*</label>
                                <input type="email" name="email" required id="email" value="{{ old('email') }}"  class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="mobile">Mobile*</label>
                                <input type="number" name="mobile" required id="mobile" value="{{ old('mobile') }}"  class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address*</label>
                            <input type="text" name="address" required id="address" value="{{ old('address') }}"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="education">Education*</label>
                            <input type="text" name="education" required id="education" value="{{ old('education') }}"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="resume">Resume(in PDF)*</label>
                            <input type="file" name="resume" required id="resume" value="{{ old('resume') }}"  class="form-control">
                        </div>
                    </div>
                    
                       </br>
                            
                                <div class="g-recaptcha pl-3" data-sitekey="{{config('services.recaptcha.key')}}"></div>
                                    @if(Session::has('success'))
                        
                                      <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{ Session::get('success') }}</p>
                              
                                       
                                    @endif
                                    
                                    </br>
                                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Apply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Start Training Area -->
      <section class="training section-gap" id='training'>
    
    <div class="container">
         <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-10">
                    <div class="title text-center">
                        <h1 class="mb-10">Featured Training</h1>
                    </div>
                </div>
            </div>
    </div>


    <div class="site-section training-single mb-5">
        <div class="container">
            <div class="splide splide-training">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($trainings as $training)
                            <li class="splide__slide" >
                                <div class="training-list">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <center><img src="/uploads/{{$training->image}}" alt="Image" class="img-fluid"></center>
                                        </div>
                                        <div class="col-md-6 my-3 my-lg-0">
                                            <h3 class='text-center text-lg-left'><a href="{{ route('training.view',$training->slug) }}">{{$training->title}}</a></h3>
                                            <p class="date">{{ date('M j, Y', strtotime($training->start_date)) }}</p>
                                            <p class="description">{!! strip_tags($training->description) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <a class="text-uppercase loadmore-btn mx-auto d-block" href="/trainings">Load More Trainings</a>
    </div>
</section>


    <!-- Start feature-cat Area -->
    <section class="feature-cat-area " id="category">
 
            <div class="title text-center">
                <h1 class="mb-10">Feaured Companies</h1>
                <!--<p>Who are in extremely love with eco friendly system.</p>-->
            </div>
            <div class="splide splide-industry">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($employees as $e)
                        @if($e->company->logo)
                            <li class="splide__slide">
                                <div class="single-rated">
                                    <img class="rounded-circle" src="/uploads/{{$e->company->logo}}" style="height:100px; width:100px">
                                </div>
                            </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
   
    </section>
    @csrf
@endsection

@section('script')
    <script>
        var slide = new Splide( '.splide-slider', {
            type: 'loop',
            arrows: false,
            pagination: false,
            autoplay: true,
            interval: 3000,
            rewind: true,
            perPage: 1,
        } )
        slide.mount()
        var premium = new Splide( '.splide-premium', {
            type: 'loop',
            arrows: false,
            autoplay: true,
            interval: 5000,
            rewind: true
        } )
        premium.mount()
        

        var training = new Splide( '.splide-training', {
            arrows: false,
            autoplay: true,
            interval: 5000,
            rewind: true,
            perPage: 1
        } )
        training.mount()

        var industry = new Splide( '.splide-industry', {
            type: 'loop',
            arrows: false,
            pagination: false,
            autoplay: true,
            interval: 1000,
            rewind: true,
            perPage: 10,
            perMove: 1,
            focus: 'center',
        } )
        industry.mount()
        $(document).on("click", ".apply-modal", function() {
            var id = $(this).data('id')
            $('.apply-body #id').val(id)
        })
        $(document).on("click", ".share-modal", function() {
            var slug = $(this).data('slug')
            window.url = window.location.origin + '/job-view/' + slug
        })
        $('#loadmore').on('click',() => {
            $('.moreIndustry').css('display','block')
            $('#loadmore').css('display','none')
        })
        const facebookbtn = document.querySelector('.facebook-btn')
        const twitterbtn = document.querySelector('.twitter-btn')
        const linkedinbtn = document.querySelector('.linkedin-btn')
        let features = 'menubar=no,location=no,resizable=no,scrollbars=yes,status=no,height=500,width=500'
        let posturl = ''
        let posttitle = encodeURI('Hi everyone, please check this out: ')
        function init() {
            posturl = window.url
        }
        facebookbtn.addEventListener('click', (ev) => {
            init()
            let facebooklink = `https://www.facebook.com/sharer.php?u=${posturl}`
            window.open(facebooklink, '_blank', features)
        })
        twitterbtn.addEventListener('click', (ev) => {
            init()
            let twitterlink = `https://twitter.com/share?url=${posturl}&text=${posttitle}`
            window.open(twitterlink, '_blank', features)
        })
        linkedinbtn.addEventListener('click', (ev) => {
            init()
            let linkedinlink = `https://www.linkedin.com/shareArticle?url=${posturl}&title=${posttitle}`
            window.open(linkedinlink, '_blank', features)
        })
    </script>
    

    <style>
        #intro {
            height: 65vh !important;
            position: relative;
        }
        
        #intro #content {
            position: absolute;
            top: 0;
            height: 100%;
            width: 100%;
        }
        .form-div {
            width: 100%;
            position: absolute;
            bottom: 10px;
        }
        .form-div form {
            margin: auto;
            width: 50%;
        }
         .splide__slide {
            padding-bottom: 50px !important;
            padding-top: 0 !important;
        }
        .splide-slider .splide__slide img {
            height: 70vh;
            width: 100%;
            /*object-fit: cover;*/
        }
        .splide__slide {
            padding: 50px 0
        }
        .splide__pagination__page {
            background: black;
            border-radius: 0;
        }
        .splide__pagination__page.is-active {
            background: #00428a !important;
        }
        
         .btns {
            border:0;
            color:#00428a !important;
            cursor: pointer;
            background: transparent;
            outline: none
        }
        .training-list img {
            width: 90%;
            max-height: 280px
        }
        
        .training-list a{
            color: #00428a;    
        }
        
        
        .post-area .info a, .post-area .info span{
            margin: -8px 0;
            padding: -8px 0;
        }
        
        
        .description {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 8; /* number of lines to show */
            -webkit-box-orient: vertical;
        }
        .card {
            border-radius: 0px
        }
        
        .post-area .card-header{
            background: #00428a;
            
        }
        
        .post-area .card-header span{
            font-weight:500;
            color: #fff;
        }
        .post-area {
            padding-top:0px;
            margin-top:-25px
        }
        .job-card {
            border: 0px;
            padding: 10px 1px;
            font-size: 14px;
            color: black;
            font-weight: 500;
            overflow: hidden;
        }
        .media .info {
            margin-left: 10px;
        }
        
        .row .col-md-4:nth-of-type(odd) {
			background: #F5F5F5
		}
        .single-rated {
            padding: 20px;
        }
        .job-section {
            width:70%;
            margin:auto
        }
        .training {
            background:#F7F7F7;
            color:black"
        }
        #category {
            padding-top: 25px
        }
        .mobile {
            display:none;
            width: 100%;
            bottom: -50px;
        }
        .mobile .form-wrap {
            width: 100% !important;
            padding:2px 5px;
        }
        .cstmInput{
            border-radius: 0px !important;
            height: 40px !important;
        }
        .mobile .form-wrap .btn-success{
            background-color: #dc3545;
            border-color: #dc3545;
        }
        ul {
            list-style-type:none;
            padding-left: 10px;
            color: black
        }
        .btn-link {
            border: 0px;
            color: #DC3545;
        }
        .moreIndustry {
            display: none
        }
        #share {
            cursor:pointer;
            margin-left: auto;
            order: 2;
        }
        .h1 a:hover {
            transform: scale(1.3);
            transition: 0.5s;
        }
        .fa-facebook {
            color: #3b5998;
        }
        .fa-twitter {
            color: #00acee
        }
        .fa-linkedin {
            color: #0e76a8;
        }
        @media(max-width: 600px) {
            #category {
                display: none
            }
            .job-section {
                width: 95%;
            }
            .form-div form {
                width: 100%
            }
            .splide-slider .splide__slide img {
                height: 23vh;
            }
            .training-list a{
                align-item: center;
                margin-top: 5px;
            }
            #intro {
                height:25vh !important;
            }
            .post-area {
                margin:0px;
                top-padding:10px
            }
            .post-area .container-fluid {
                padding:20px;
            }
            .mobile {
                display:block;
            }
            .not-mobile {
                display:none;
            }
        }
    </style>
@endsection