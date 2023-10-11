@extends('layout.frontend')
@section('title', 'Mero Placement')
@section('body')
<!-- End banner Area -->
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
        </div>
<section class="login-area">
    <div class="container px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card0 border-0 card-body">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                            <img src="/assets/img/about.jpg" class="image" />
                        </div>
                    </div>
                </div>
  
                <div class="col-lg-6">
                    <div class="tab">
                        <div class="tab-inner">
                            <button class="tablinks" onclick="openCity(event, 'jobseeker')" id="defaultOpen"> Job Seeker </button>
                        </div>
                        <div class="tab-inner">
                            <button class="tablinks" onclick="openCity(event, 'employee')"> Employer </button>
                        </div>
                    </div>
  
                    <div class="card2 card border-0 px-4 tabcontent" id="jobseeker">
                        <form action="{{ route('create_user') }}" method="post">
                            @csrf
                            <input type="hidden" name="role" value="jobseeker">
                            <div class="row px-3">
                                <label class="mb-1"> <h6 class="mb-0 text-sm">Name</h6> </label>
                                <input class="mb-4" type="text" name="name" placeholder="Enter Name" required/>
                            </div>
    
                            <div class="row px-3">
                                <label class="mb-1"> <h6 class="mb-0 text-sm">Email Address</h6> </label>
                                <input class="mb-4" type="text" name="email" placeholder="Enter a valid email address"required />
                            </div>
                            <div class="row px-3">
                                <label class="mb-1"> <h6 class="mb-0 text-sm">Contact Number</h6> </label>
                                <input class="mb-4" type="text" name="number" placeholder="Enter Phone Number" required/>
                            </div>
                            <div class="row px-3">
                                <label class="mb-1"> <h6 class="mb-0 text-sm">Password</h6> </label>
                                <input type="password" name="password" placeholder="Enter password" required/>
                            </div>
                            <div class="row px-3">
                                <label class="mb-1"> <h6 class="mb-0 text-sm">Confirm Password</h6> </label>
                                <input type="password" name="cpassword" placeholder="Password Confirmation" required/>
                            </div>
                            
                             </br>
                            
                                <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}"></div>
                                    @if(Session::has('success'))
                        
                                      <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{ Session::get('success') }}</p>
                              
                                       
                                    @endif
                                    
                                    </br>
                                    
                            <div class="row px-3 mb-4">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input id="chk1" type="checkbox" class="custom-control-input" required/>
                                    <label for="chk1" class="custom-control-label text-sm">
                                        I Agreed To The <a href="{{ route('termscondition') }}" target="_blank">Terms And Conditions</a> Governing The Use Of
                                        Jobportal.</label>
                                </div>
                            </div>
                            <div class="row mb-3 px-3">
                                <button type="submit" class="btn btn-blue text-center">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
            
                    <div class="card2 card border-0 px-4 py-5 tabcontent" id="employee">
                        <form action="{{ route('create_user') }}" method="post">
                            @csrf
                            <input type="hidden" name="role" value="employee">
                            <div class="row px-3">
                                <label class="mb-1"> <h6 class="mb-0 text-sm">Organization/Company Name</h6> </label>
                                <input class="mb-4" type="text" name="name" placeholder="Enter Company Name" required/>
                            </div>
    
                            <div class="row px-3">
                                <label class="mb-1"> <h6 class="mb-0 text-sm">Select Organization Industry Type</h6> </label>
                                <select name="industry_id" class="mb-4 form-control" required/>
                                    @foreach ($industries as $industry)
                                        <option value="{{ $industry->id }}">{{ $industry->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                
                            <div class="row px-3">
                                <label class="mb-1"> <h6 class="mb-0 text-sm">Email Address</h6> </label>
                                <input class="mb-4" type="text" name="email" placeholder="Enter Email" required/>
                            </div>
                
                            <div class="row px-3">
                                <label class="mb-1"> <h6 class="mb-0 text-sm">Contact Number</h6> </label>
                                <input class="mb-4" type="text" name="number" placeholder="Enter Phone Number" required/>
                            </div>
                            
                            <div class="row px-3">
                                <label for="photo">Logo <span style="color:red">*</span></label>
                                    <input type="file" name="photo" required/>
                            </div>
                            
                
                            <div class="row px-3">
                                <label class="mb-1"> <h6 class="mb-0 text-sm">Password</h6> </label>
                                <input type="password" name="password" placeholder="Enter password" required/>
                            </div>
                            <div class="row px-3">
                                <label class="mb-1"> <h6 class="mb-0 text-sm">Confirm Password</h6> </label>
                                <input type="password" name="cpassword" placeholder="Password Confirmation" required/>
                            </div>
                            
                            </br>
                            
                                <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}"></div>
                                    @if(Session::has('success'))
                        
                                      <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{ Session::get('success') }}</p>
                              
                                       
                                    @endif
                                    
                                    </br>
                
                            <div class="row px-3 mb-4">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input id="chk2" type="checkbox" class="custom-control-input" required/>
                                    <label for="chk2" class="custom-control-label text-sm">
                                        I Agreed To The Terms And Conditions Governing The Use Of
                                        Jobportal.</label>
                                </div>
                            </div>
                            <div class="row mb-3 px-3">
                                <button type="submit" class="btn btn-blue text-center">
                                Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
    
@endsection