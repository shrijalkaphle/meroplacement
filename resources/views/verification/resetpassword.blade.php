@extends('layout.frontend')
@section('title', 'Reset Password')
@section('body')
	<section id="training" class="section-full">
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
                    <strong> <i class="fas fa-check-circle"></i></strong>
                    {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="form-div card card-body">
                <form action="{{ route('user.password.reset') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" name="password" id="password" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" name="cpassword" id="cpassword" required class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
	</section>
@endsection

@section('script')
	<style>
		.nav-menu li a{
			color: black
		}
        .form-div {
            width: 50%;
            margin:auto;
        }
        @media(max-width: 600px) {
            .form-div {
                width: 95%;
            }
        }
	</style>
@endsection