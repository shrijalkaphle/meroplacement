@extends('layout.frontend')
@section('title', 'JobSeeker Dashboard')
@section('body')
    <div class="container" id="profile">
        <div id="change-password">
            <h4>Change Password</h4>
            <hr>
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-transform: capitalize">
                    <strong> <i class="fas fa-check-circle"></i></strong>
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-transform: capitalize">
                    <strong> <i class="fas fa-check-circle"></i> </strong>
                    {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ route('user.updatepassword',Session::get('user')['userid']) }}" method="POST">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="oldpassword">Old Password</label>
                    <input type="password" name="oldpassword" id="oldpassword" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="newpassword">New Password</label>
                    <input type="password" name="newpassword" id="newpassword" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cnewpassword">Confirm Password</label>
                    <input type="password" name="cnewpassword" id="cnewpassword" class="form-control" required>
                </div>
                <center>
                    <input type="submit" value="Update" class="btn btn-primary">
                </center>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <style>
        #change-password {
            width:60%;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid gray;
            border-radius: 20px
        }
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
        .card {
            margin:10px;
        }
        .card a {
            display: block;
            margin-top: 10px
        }
        .table {
            margin-top: 20px
        }
        .spacer {
            height: 50px;
        }
    </style>
@endsection