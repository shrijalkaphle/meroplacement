@extends('layout.frontend')
@section('title', $training->title)
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
            <div class="row">
                <div class="col-md-8">
                    <div class="training-header">
                        <div class="content">
                            <div class="container">
                                <div id="image" style="height:350px;overflow:hidden">
                                    <img src="/uploads/{{$training->image}}" style="width:100%">
                                </div>
                                <p><h2>{{ $training->title }}</h2></p>
                                <p class="font-weight-bold text-dark">Starting Date : {{ date('M j, Y', strtotime($training->start_date)) }}</p>
                                <p class="font-weight-bold text-dark">Course Duration : {{ $training->duration }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center border pt-3">
                        <h5><u>Trainer Details</u></h5>
                        <br>
                        <img src="/uploads/{{$training->trainer_image}}" style="height:150px;margin-bottom:15px">
                        <h3>{{$training->trainer_name}}</h3>
                        <p>{{$training->trainer_description}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container training-body">
            {!! $training->description !!}
        </div>

        <div class="container">
            <a class="btn btn-primary" href="/pdf/training/{{$training->slug}}">Download</a>
            <button class="btn btn-primary" style="float:right" data-toggle="modal" data-target="#applyTraining">Enroll</button>
        </div>
	</section>
	<div class="share-btn">
	    <a href="#" class="facebook-btn"><i class="fab fa-facebook"></i></a>
        <a href="#" class="twitter-btn"><i class="fab fa-twitter"></i></a>
        <a href="#" class="linkedin-btn"><i class="fab fa-linkedin"></i></a>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="/social-share.css">
    <script src="/social-share.js"></script>
    <div class="modal fade" id="applyTraining" tabindex="-1" role="dialog" aria-labelledby="applyTrainingTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyTrainingTitle">Apply for: <b>{{$training->title}}</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('training.inquiry') }}" method="post">
                @csrf
                <input type="hidden" name="training_id" value="{{$training->id}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Full Name*</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email">Email*</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="mobile">Mobile*</label>
                                <input type="number" name="mobile" id="mobile" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address*</label>
                            <input type="text" name="address" id="address" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Enroll</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	<style>
        .col-md-6 .row {
            padding-top: 20px;
            font-size: 18px
        }
        h3 {
            color: #000;
        }
		.nav-menu li a{
			color: black
		}
		.ticker-btn {
			color: white !important
		}
        .training-body {
            padding-top:50px;
        }
	</style>
@endsection