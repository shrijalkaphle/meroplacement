@extends('layout.frontend')
@section('title', 'Contact')
@section('body')

<!-- Start Contact -->
<section id="job-contact">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="job-contact-area">
                <!-- Title -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="job-title">
                            <h2>Hear From Us</h2>
                        </div>
                    </div>
                </div>
                    <!-- Start Contact Content -->
                <div class="job-contact-content">
                    <div class="row">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-transform: capitalize">
                                <strong> <i class="fas fa-check-circle"></i></strong>
                                {{ Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="job-contact-form-area">
                                <div id="form-messages"></div>
                                <form id="ajax-contact" method="post" action="{{ route('contact.submit') }}" class="job-contact-form">
                                    @csrf
                                    <div class="form-group">  
                                        <span class="fa fa-user job-contact-icon"></span>              
                                        <input type="text" class="form-control" placeholder="Name" id="name" name="name" required>
                                    </div>

                                    <div class="form-group">  
                                        <span class="fas fa-at job-contact-icon"></span>              
                                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" required>
                                    </div>

                                    <div class="form-group">  
                                        <span class="fa fa-phone job-contact-icon"></span>              
                                        <input type="text" class="form-control" placeholder="Enter Phone Number" id="phone" name="phone" required>
                                    </div>    

                                    <div class="form-group"> 
                                        <span class="fa fa-folder-open-o job-contact-icon"></span>                
                                        <input type="text" class="form-control" placeholder="Your Subject" id="subject" name="subject" required>
                                    </div>

                                    <div class="form-group">
                                        <span class="fa fa-pencil-square-o job-contact-icon"></span> 
                                        <textarea class="form-control" placeholder="Message" id="message" name="message" maxlength="500" required></textarea>
                                    </div>
                                    
                                     <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}"></div>
                                    @if(Session::has('captcha'))
                        
                                      <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{ Session::get('captcha') }}</p>
                              
                                       
                                    @endif
                                    <br/>
                                    <button type="submit" class="btn btn-info"><span>Send Message</span></button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Contact Content -->
            </div>
        </div>
    </div>
</div>
</section>
<!-- End Contact -->

<!-- Google map -->
<div id="mu-google-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d883.2460517106367!2d85.33463152920201!3d27.686882998925046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb192c364364fd%3A0x270fc3695af427d5!2sMero%20Placement!5e0!3m2!1sen!2snp!4v1651482077566!5m2!1sen!2snp" width="100%" height="400" allowfullscreen></iframe>

</div>


</main>

@endsection