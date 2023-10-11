<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="/assets/img/admin-favicon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="/assets/jqueryui/jquery-ui.min.css">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="/main.css" rel="stylesheet"></head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        #loader {
            position: fixed;
            height:100vh;
            background: rgba(0, 0, 0, 0.5);
            width: 100vw;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hidden {
            display: none !important
        }
        .fixed-table {
            table-layout: fixed;
            width: 100%
        }
        @media (max-width: 673px) {
            .fixed-table {
                table-layout: auto;
                width: auto
            }
            .btn {
                margin-bottom: 5px
            }
        }
    </style>
<body>
    <div id="loader" class="hidden">
        <img src="/assets/img/loader.gif" style="height:50px">
    </div>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <a href="{{ route('landing') }}"><img src="/uploads/{{ $sitesetting->logo }}" style="height:23px"></a>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left ml-3 ">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <div class="widget-heading">
                                                {{ Session::get('user')['name'] }}
                                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            </div>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('user.changepassword') }}" class="dropdown-item">Change Password</a>
                                            <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                 <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                
    
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu" style="padding-top:20px">
                            
                            @if (Session::get('user')['role'] == 'admin')
                            
                            <li> <a href="{{ route('admin.dashboard') }}" id="dashboard">
                                <i class="metismenu-icon pe-7s-rocket"></i>
                                Dashboard
                            </a> </li>
                            <li> <a href="{{ route('applicant.index') }}" id="applicant">
                                <i class="metismenu-icon material-icons-outlined"> badge </i>
                                Applicants
                            </a> </li>
                            <li>
                                <a href="#" id="job">
                                    <i class="metismenu-icon material-icons-outlined"> work </i>
                                    Jobs
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('job.premium') }}" id="premium">
                                            <i class="metismenu-icon"></i>
                                            Premium Jobs
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('job.active') }}" id="active">
                                            <i class="metismenu-icon"></i>
                                            Active Jobs
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('job.pending') }}" id="pending">
                                            <i class="metismenu-icon"></i>
                                            Pending Approval
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('job.expired') }}" id="expired">
                                            <i class="metismenu-icon"></i>
                                            Expired Jobs
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" id="user">
                                    <i class="metismenu-icon material-icons-outlined"> people </i>
                                    Users
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('user.admin') }}" id="admin">
                                            <i class="metismenu-icon"></i>
                                            Admin
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user.employee') }}" id="employee">
                                            <i class="metismenu-icon"></i>
                                            Clients
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user.jobseeker') }}" id="jobseeker">
                                            <i class="metismenu-icon"></i>
                                            Job Seeker
                                        </a>
                                    </li>
                                </ul>
                            </li>
                                <li> <a href="{{ route('vacancy.index') }}" id="vacancy">
                                <i class="metismenu-icon material-icons-outlined"> article </i>
                                Vacancy Detail
                            </a> </li>
                            
                                <li> <a href="{{ route('task.index') }}" id="task">
                                <i class="metismenu-icon material-icons-outlined"> article </i>
                                Daily Report
                            </a> </li>
                            
                            <li>
                                <a href="#" id="siteinformation">
                                    <i class="metismenu-icon material-icons-outlined"> article </i>
                                    Site Information
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('qualification.index') }}" id="qualification">
                                            <i class="metismenu-icon"></i>
                                            Qualification
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('industry.index') }}" id="industry">
                                            <i class="metismenu-icon"></i>
                                            Indusrty
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('payment.index') }}" id="payment">
                                            <i class="metismenu-icon"></i>
                                            Payment Method
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li> <a href="{{ route('cv.view') }}" id="cv">
                                <i class="metismenu-icon material-icons-outlined"> article </i>
                                Website Resume
                            </a> </li>
                            <li> <a href="{{ route('uploadcv.index') }}" id="uploadcv">
                                <i class="metismenu-icon material-icons-outlined"> folder_open </i>
                                Database Resume
                            </a> </li>
                            <li>
                                <a href="#" id="training">
                                    <i class="metismenu-icon material-icons-outlined"> model_training </i>
                                    Training
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('training.index') }}" id="viewTraining">
                                            <i class="metismenu-icon"></i>
                                            View Training
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('training.view.inquiry') }}" id="enrollmentInquiry">
                                            <i class="metismenu-icon"></i>
                                            Enrollment Inquiry
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" id="other">
                                    <i class="metismenu-icon material-icons-outlined"> article </i>
                                    Others
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('blog.index') }}" id="blog">
                                            <i class="metismenu-icon"></i>
                                            Blogs
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('testimonial.index') }}" id="testimonial">
                                            <i class="metismenu-icon"></i>
                                            Testimonials
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('slider.index') }}" id="slider">
                                            <i class="metismenu-icon"></i>
                                            Landing Slider
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="{{ route('user.jobseeker') }}" id="jobsubscriber">
                                            <i class="metismenu-icon"></i>
                                            Job Subscribers
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            
                               <li> <a href="{{ route('contactForm') }}" id="setting">
                                <i class="metismenu-icon material-icons-outlined"> call </i>
                                Contact Form Message
                            </a> </li>
                            
                            <li> <a href="{{ route('setting.index') }}" id="setting">
                                <i class="metismenu-icon material-icons-outlined"> settings </i>
                                Settings
                            </a> </li>
                            <hr>
                            <li> <a href="{{ route('terms.index') }}" id="terms">
                                <i class="metismenu-icon material-icons-outlined"> gavel </i>
                                Terms and Conditions
                            </a> </li>
                       
                            
                            @endif
                            
                            @if (Session::get('user')['role'] == 'staff')
                            
                               <li> <a href="{{ route('admin.dashboard') }}" id="dashboard">
                                <i class="metismenu-icon pe-7s-rocket"></i>
                                Dashboard
                            </a> </li>
                            
                               <li>
                                <a href="#" id="job">
                                    <i class="metismenu-icon material-icons-outlined"> work </i>
                                    Jobs
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
            
                                    <li>
                                        <a href="{{ route('job.active') }}" id="active">
                                            <i class="metismenu-icon"></i>
                                            Active Jobs
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('job.pending') }}" id="pending">
                                            <i class="metismenu-icon"></i>
                                            Pending Approval
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('job.expired') }}" id="expired">
                                            <i class="metismenu-icon"></i>
                                            Expired Jobs
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                               <li> <a href="{{ route('cv.view') }}" id="cv">
                                <i class="metismenu-icon material-icons-outlined"> article </i>
                                Website Resume
                            </a> </li>
                            <li> <a href="{{ route('uploadcv.index') }}" id="uploadcv">
                                <i class="metismenu-icon material-icons-outlined"> folder_open </i>
                                Database Resume
                            </a> </li>
                            
                            <li> <a href="{{ route('vacancy.index') }}" id="cv">
                                <i class="metismenu-icon material-icons-outlined"> article </i>
                                Vacancy Detail
                            </a> </li>
                            
                               <li> <a href="{{ route('task.index') }}" id="cv">
                                <i class="metismenu-icon material-icons-outlined"> article </i>
                                Daily Report
                            </a> </li>
                            
                            @endif
   
                        </ul>
                    </div>
                </div>
          
            </div>
            @yield('body')    
        </div>
    </div>
</body>
</html>
<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
<script src="/assets/jqueryui/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/assets/scripts/main.js"></script>
<script src="/ckeditor.js"></script>
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
    .widget-content-left img {
        height: 80px;
        width: 80px;
    }
</style>
@yield('script')