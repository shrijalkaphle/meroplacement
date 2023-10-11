<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="author" content="AI-INTERF">
    <meta name="title" content="{{ $sitesetting->meta_title }}">
    <meta name="description" content="{{ $sitesetting->meta_description }}">
    <meta name="keywords" content="{{ $sitesetting->meta_keyword }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="/uploads/{{ $sitesetting->favicon }}">
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
    <link href="/main.css" rel="stylesheet">
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
    </style>
</head>
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
                            <li> <a href="{{ route('employee.dashboard') }}" id="dashboard">
                                <i class="metismenu-icon pe-7s-rocket"></i>
                                Dashboard
                            </a> </li>
                            <li> <a href="{{ route('employee.jobpost.create') }}" id="postjob">
                                <i class="metismenu-icon material-icons-outlined"> work </i>
                                Post Job
                            </a> </li>
                            <li> <a href="{{ route('employee.jobpost.view') }}" id="managejob">
                                <i class="metismenu-icon material-icons-outlined"> work </i>
                                Manage Jobs
                            </a> </li>
                            <li> <a href="{{ route('employee.applicant') }}" id="applicant">
                                <i class="metismenu-icon material-icons-outlined"> badge </i>
                                Applicants
                            </a> </li>
                            <hr>
                            <li> <a href="{{ route('employee.cv.view') }}" id="searchCV">
                                <i class="metismenu-icon material-icons-outlined"> article </i>
                                Search CV
                            </a> </li>
                            <li> <a href="{{ route('employee.cv.requested') }}" id="requestedCV">
                                <i class="metismenu-icon material-icons-outlined"> article </i>
                                Requested CV
                            </a> </li>
                            <li> <a href="{{ route('paymentmethod') }}" target="_blank">
                                <i class="metismenu-icon material-icons-outlined"> payments </i>
                                Payment Methods
                            </a> </li>
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
</style>
@yield('script')