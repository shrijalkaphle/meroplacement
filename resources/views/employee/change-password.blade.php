@extends('layout.employee')
@section('title', 'Change Password')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Change Password </div>
                </div>
            </div>
        </div>
        <div class="container">
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
            <br>
            <form action="{{ route('user.updatepassword', Session::get('user')['userid']) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="old-password">Old Password</label>
                    <input type="password" name="oldpassword" id="oldpassword" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" name="newpassword" id="newpassword" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="cnew-password">Confirm Password</label>
                    <input type="password" name="cnewpassword" id="cnewpassword" onkeyup="checkPassword(this.value)" required autocomplete="off">
                </div>
                <center>
                    <input type="submit" value="Update" class="btn btn-success">
                </center>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function checkPassword(value) {
            var pwd = $('#newpassword').val()
            if(value == pwd) {
                $('#cnewpassword').removeClass('invalid')
            } else{
                $('#cnewpassword').addClass('invalid')
            }
        }
    </script>
    <style>
        .invalid {
            color:red;
            border:1px solid red !important
        }
        input[type='password'] {
            display: block;
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 10px
        }
        input:focus{
            outline: none !important
        }
    </style>
@endsection