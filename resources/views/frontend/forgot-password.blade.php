@extends('layout.frontend')
@section('title', 'Forgot Password')
@section('body')
	<section id="training" class="section-full">
		<div class="container">
            <div class="form-div card card-body">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-transform: capitalize">
                    <strong> <i class="fas fa-check-circle"></i></strong>
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                @endif
                <form action="{{ route('user.resetmail') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required class="form-control">
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