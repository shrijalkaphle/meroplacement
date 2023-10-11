@extends('layout.frontend')
@section('title', 'Mero Placement')
@section('body')
<!-- End banner Area -->	



<section class="login-area">	
  <div class="container px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-transform: capitalize">
            <strong> <i class="fas fa-check-circle"></i></strong>
            {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="/assets/img/about.jpg" class="image"> </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                    <form action="{{ route('check_user') }}" method="post" class="loginform">
                        @csrf
                        <div class="row px-3"> 
                            <label class="mb-1"><h6 class="mb-0 text-sm">Email Address</h6></label> 
                            <input class="mb-4  @error('email') is-invalid @enderror" type="email" name="email" placeholder="Enter a valid email address" value="{{ old('email') }}" required> 
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                            <input type="password" id="password" name="password" placeholder="Enter password" class="@error('password') is-invalid @enderror" required> 
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- <div class="custom-control custom-checkbox custom-control-inline"> 
                            <input id="showpassword" type="checkbox" class="custom-control-input" onchange="showPassword()"> 
                            <label for="showpassword" class="custom-control-label text-sm">View Password</label> 
                        </div>  --}}
                        <div class="row px-3 mb-4"><div class="custom-control custom-checkbox custom-control-inline"> 
                            {{-- <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> 
                            <label for="chk1" class="custom-control-label text-sm">Remember me</label>  --}}
                            <input id="showpassword" type="checkbox" class="custom-control-input" onchange="showPassword()"> 
                            <label for="showpassword" class="custom-control-label text-sm">View Password</label> 
                        </div> 
                            <a href="{{route('forgotpassword')}}" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                        </div>
                        <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Login</button> </div>
                        <div class="row mb-4 px-3"> <small class="font-weight-bold">Don't have an account? <a href="{{ route('register') }}">Register</a></small> </div>
                    </form>
                    <div class="row px-3 mb-4">
                        <div class="line"></div> <small class="or text-center">Or</small>
                        <div class="line"></div>
                        </div>

                        <!--<div class="row mb-4 px-3">-->
                        <!--    <h6 class="mb-0 mr-4 mt-2">Sign in with</h6>-->
                        <!--    <div class="facebook text-center mr-3">-->
                        <!--        <a class="social" href="{{ route('login.social','facebook') }}"><div class="fa fa-facebook"></div></a>-->
                        <!--    </div>-->
                        <!--    <div class="google text-center mr-3">-->
                        <!--        <a class="social" href="{{ route('login.social','google') }}"><div class="fa fa-google"></div></a>-->
                        <!--    </div>-->
                        <!--    <div class="linkedin text-center mr-3">-->
                        <!--        <a class="social" href="{{ route('login.social','linkedin') }}"><div class="fa fa-linkedin"></div></a>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
    <style>
        .is-invalid {
            border-color: red !important;
        }
        .invalid-feedback {
            color: red;
            display: block;
        }
        .social {
            color:white !important;
        }
    </style>
    <script>
        function showPassword() {
            if($('#showpassword').is(":checked"))
                $('#password').prop({type:"text"})
            else
                $('#password').prop({type:"password"})
        }
    </script>
@endsection