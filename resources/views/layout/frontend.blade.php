<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/uploads/{{ $sitesetting->favicon }}">
    <!-- Author Meta -->
    <meta name="author" content="AI-INTERF">
    <!-- Meta Title -->
    <meta name="title" content="{{ $sitesetting->meta_title }}">
    <!-- Meta Description -->
    <meta name="description" content="{{ $sitesetting->meta_description }}">
    <!-- Meta Keyword -->
    <meta name="keywords" content="{{ $sitesetting->meta_keyword }}">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>@yield('title')</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--
        CSS
        ============================================= -->
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/css/bootstrap.css">
        <link rel="stylesheet" href="/assets/css/nice-select.css">					
        <link rel="stylesheet" href="/assets/css/animate.min.css">
        <link rel="stylesheet" href="/assets/css/owl.carousel.css">
        <link rel="stylesheet" href="/assets/css/main.css">
        <link rel="stylesheet" href="/assets/splide/dist/css/splide.min.css">
        <script src="/assets/splide/dist/js/splide.min.js"></script>
         <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <style>
            #loading {
                position: fixed;
                overflow: hidden;
                height: 100%;
                width: 100%;
                z-index: 100000;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column
            }
            .loader {
                border: 10px solid #f3f3f3;
                border-radius: 50%;
                border-top: 10px solid #3498db;
                width: 60px;
                height: 60px;
                -webkit-animation: spin 2s linear infinite; /* Safari */
                animation: spin 2s linear infinite;
            }

                /* Safari */
            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            .hidden {
                display: none !important
            }
        </style>
    </head>
    <body>

    <!-- Messenger Chat plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "105842548504752");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v13.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    
    
        <div id="loading" class="hidden">
            <center><div class="loader"></div></center>
        </div>
        <header id="header">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                  <div id="logo">
                    <a href="/"><img src="/uploads/{{ $sitesetting->logo }}" alt="" title=""/></a>
                  </div>
                  <nav id="nav-menu-container">
                    <ul class="nav-menu">
                      <li class="menu-active"><a href="/">Home</a></li>
                      <li><a href="/about">About Us</a></li>
                      <li><a href="/trainings">Training</a></li>
                      <li><a href="/blogs">Blog</a></li>
                      <li><a href="/contact">Contact</a></li>
                      <li><a href="#">Resume</a>
                        <ul class="sub-list">
                            <li><a class="link-blue" href="#" type="button" data-toggle="modal" data-target="#uploadCV">Upload Resume <span style="display:block;font-size:12px;font-weight:400">For <b>JOB RECOMENDATION</b></span> </a></li>
                            <li><a class="link-blue" href="{{ route('profile') }}">Create Resume<span style="display:block;font-size:12px;font-weight:400">Login as a <b>JOBSEEKER</b></span> </a></li>
                            <li><a class="link-blue" href="{{ route('employee.cv.view') }}">View Resume <span style="display:block;font-size:12px;font-weight:400">Login as an <b>Client</b></span> </a></li>
                        </ul>
                      </li>
                      @if(Session::has('user'))
                        @if(Session::get('user')['role'] == 'admin')
                            <li><a class="ticker-btn" href="{{ route('admin.dashboard') }}"><span>Dashboard</span></a></li>
                        @elseif(Session::get('user')['role'] == 'employee')
                        <li><a class="ticker-btn" href="{{ route('employee.dashboard') }}"><span>Dashboard</span></a></li>
                        @else
                            <li><a class="ticker-btn" href="{{ route('jobseeker.dashboard') }}"><span>Dashboard</span></a></li>
                        @endif
                        <li><a class="ticker-btn" href="{{ route('logout') }}"><span>Logout</span></a></li>
                      @else
                        <li><a class="ticker-btn" href="{{ route('register') }}"><span>Sign Up</span></a></li>
                        <li><a class="ticker-btn" href="{{ route('login') }}"><span>Login</span></a></li>
                      @endif			          				          
                    </ul>
                  </nav>		    		
                </div>
            </div>
        </header>
        <div id="maincontent">
            @yield('body')
        </div>
        <div class="modal fade" id="uploadCV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQualificationTitle">Upload CV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('cv.upload.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input type="text" name="name" required id="name" class="form-control">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email">Email*</label>
                                <input type="email" name="email" required id="email" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="number">Number*</label>
                                <input type="number" name="number" required id="number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address*</label>
                            <input type="text" name="address" required id="address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="education">Education*</label>
                            <input type="text" name="education" required id="education" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="cv">CV/Resume*</label>
                            <input type="file" name="cv" required id="cv" class="form-control">
                        </div>
                    </div>
                    
                                                </br>
                            
                                <div class="g-recaptcha pl-3" data-sitekey="{{config('services.recaptcha.key')}}"></div>
                                    @if(Session::has('captcha'))
                        
                                      <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{ Session::get('captcha') }}</p>
                              
                                       
                                    @endif
                                    
                                    </br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        
        @if(!Session::has('user'))
            <section class="callto-action-area section-gap">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="menu-content col-lg-9">
                            <div class="title text-center">
                                <h1 class="mb-10 text-white">Join us today without any hesitation</h1>
                                <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                <a class="primary-btn" href="{{ route('register') }}">I am a Candidate</a>
                                <a class="primary-btn" href="{{ route('register') }}">We are an Employer</a>
                            </div>
                        </div>
                    </div>	
                </div>	
            </section>
        @endif
        
        <!-- start footer Area -->		
        <footer class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3  col-md-12 text-center text-lg-left">
                        <div class="single-footer-widget">
                            <h6>About us</h6>
                            <p class="text-white">{{ $sitesetting->footer_about }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 text-center text-lg-left">
                        <div class="single-footer-widget">
                            <h6>Job Seekers</h6>
                            <ul class="footer-nav text-left ml-4 ml-lg-0">
                                <li><a href="{{ route('register') }}"><i class="fa fa-angle-double-right"></i> Register</a></li>
                                <li><a href="{{ route('login') }}"><i class="fa fa-angle-double-right"></i> Login</a></li>
                                <li><a href="/trainings"><i class="fa fa-angle-double-right"></i> Training</a></li>
                                <li><a href="{{ route('profile') }}"><i class="fa fa-angle-double-right"></i> Create CV</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 text-center text-lg-left">
                        <div class="single-footer-widget">
                            <h6>Employers</h6>
                            <ul class="footer-nav text-left ml-4 ml-lg-0">
                                <li><a href="{{ route('register') }}"><i class="fa fa-angle-double-right"></i> Register</a></li>
                                <li><a href="{{ route('login') }}"><i class="fa fa-angle-double-right"></i> Login</a></li>
                                <li><a href="/trainings"><i class="fa fa-angle-double-right"></i> Training</a></li>
                                <li><a href="{{ route('employee.jobpost.create') }}"><i class="fa fa-angle-double-right"></i> Post a Job</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 text-center text-lg-left">
                        <div class="single-footer-widget">
                            <h6>Contact Us</h6>
                            <ul class="footer-nav">
                                <li><a href="#"><i class="fa fa-location-arrow"></i> {{ $sitesetting->address }}</a></li>
                                <li><a href="tel:{{ $sitesetting->number }}"><i class="fa fa-phone"></i> {{ $sitesetting->number }}</a></li>
                                <li><a href="mailto:{{ $sitesetting->email }}"><i class="fa fa-envelope-square"></i> {{ $sitesetting->email }}</a></li>
                            </ul>
                        </div>
                        
                        <div class="footer-social text-center text-lg-left">
                            @if($sitesetting->facebook)
                                <a href="{{ $sitesetting->facebook }}" target="_blank" class='facebook'><i class="fa fa-facebook"></i></a>
                            @endif
                            @if($sitesetting->youtube)
                            <a href="{{ $sitesetting->youtube }}" target="_blank" class='youtube'><i class="fa fa-youtube"></i></a>
                            @endif
                            @if($sitesetting->instagram)
                            <a href="{{ $sitesetting->instagram }}" target="_blank" class='instagram'><i class="fa fa-instagram"></i></a>
                            @endif
                            @if($sitesetting->linkedin)
                            <a href="{{ $sitesetting->linkedin }}" target="_blank" class='linkedin'><i class="fa fa-linkedin"></i></a>
                            @endif
                        
                        </div>
                        <br>
                        <span id="siteseal">
                            <script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=osM06UoTgUSi0Oyy6CyinmlTnPRmW0IXEX3ofAmg70dh8J7gqkdrzedQHIC5"></script>
                        </span>
                    </div>
                </div>

                <div class="row footer-bottom d-flex justify-content-between text-center text-lg-left">
                        <p class="col-lg-3 col-sm-12 footer-text m-0 text-white order-2 order-lg-1">
                      
                        Designed & Developed | by <a href="https://ai-interf.com/" target="_blank">AI-Interf</a>
                    </p>
                    
                    <p class="col-lg-8 col-sm-12 footer-text m-0 text-white text-center text-lg-right order-1 order-lg-2">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                        All rights reserved | Meroplacement PLACEMENT & HR CAPITAL PVT LTD</a>
                    </p>
                    
                
  
                </div>
            </div>
        </footer>
        <!-- End footer Area -->		
        <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
        <script src="/assets/js/vendor/jquery-2.2.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="/assets/js/vendor/bootstrap.min.js"></script>			
          <script src="/assets/js/easing.min.js"></script>			
        <script src="/assets/js/superfish.min.js"></script>	
        <script src="/assets/js/jquery.magnific-popup.min.js"></script>
        <script src="/assets/splide/dist/js/splide.min.js"></script>
        <script src="/assets/js/jquery.sticky.js"></script>
        <script src="/assets/js/jquery.nice-select.min.js"></script>			
        <script src="/assets/js/main.js"></script>
        <script src="/ckeditor.js"></script>
    </body>
</html>
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
        
    }
    .footer-nav {
        list-style-type:none;
        margin-left: -20px
    }
    .link-blue:hover {
        color:#24346C !important;
    }
    

    
    @media(max-width: 662px) {
        .sub-list {
            display: block !important;
        }
        .ticker-btn {
            margin-top:20px;
        }
        #header {
            height:70px;
        }
        #maincontent {
            margin-top:70px !important;
        }
    }
</style>
@yield('script')

