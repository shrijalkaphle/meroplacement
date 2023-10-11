@extends('layout.frontend')
@section('title', 'CV Template')
@section('body')
    <div class="container" id="profile">
        <div class="card">
            <div class="card-body">
                Free Template
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        Template 1
                        Template 2
                        Template 3
                    </div>
                    <div class="col-md-6">
                        Preview <br>
                        <iframe src="/cv/preview/0" style="width:500px;height:500px;" title="description"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <style>
        body {
            background: #F8F9FA;
        }
        #profile {
            color: black;
            font-size: 16px;
            padding-top: 100px
        }
        .nav-menu li a {
            color: black
        }
        .header-scrolled .nav-menu li a {
            color: white !important
        }
        .col-md-8 .heading {
            display: block;
            color: black !important;
            font-weight: 700;
            font-size: 18px;
        }
        #profile p {
            margin:0
        }
        h4 {
            border-bottom: 1px solid #e9ecef;
            width: 100%
        }
        .profile-content {
            padding: 20px;
            margin-bottom: 20px
        }
        .mybtn {
            background: #49E4FA;
            padding: 5px 25px;
            text-transform: uppercase;
            color: white;
            border-radius: 0
        }
        .mybtn:hover {
            background: transparent;
            color: #49E4FA;
            border: 1px solid #49E4FA;
        }
        .card {
            margin:10px;
        }
    </style>
@endsection