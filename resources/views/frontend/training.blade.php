@extends('layout.frontend')
@section('title', 'Training')
@section('body')
	<section id="training-banner">
		<img src="/uploads/{{ $sitesetting->training_banner }}" width="100%">
	</section>
	<section id="training" class="section-full" style="padding-top:20px">
		<div class="container">
		    <center><h2>Trainings We Provide</h2></center>
		    <br><br>
			<div class="row">
				@foreach ($trainings as $training)
					<div class="col-md-3">
						<div class="card training-card">
							<div class="card-header"></div>
							<div class="card-body">
								<div class="image">
									<img src="/uploads/{{ $training->image }}" class="training-image" width="80px">
								</div>
								<div class="title">{{ $training->title }}</div>

								<span class="start-date"><i class="fas fa-calendar-day"></i> <strong>Starts: </strong>{{ date('M j, Y', strtotime($training->start_date)) }}</span>
								<span class="duration"><i class="fas fa-hourglass-start"></i><strong>Duration: </strong> {{ $training->duration }}</span>
								<button class="btn btn-primary button" onclick="viewTraining('{{$training->slug}}')">View Details</button>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
@endsection

@section('script')
	<style>
		#training-banner {
			max-height:65vh;
			overflow: hidden;
		}
		.training-card {
			width: 250px;
			margin: auto;
			margin-bottom:25px
		}
		.training-card .card-header {
			height: 60px;
		}
		.training-card .card-body {
			position: relative;
			text-align: center;
			padding-top: 50px;
		}
		.training-card .card-body .title {
			font-weight: 700;
			line-height: 16px;
			height: 32px;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			text-overflow: ellipsis;
			color: black
		}
		.start-date {
			display: block;
			padding-top: 50px
		}
		.duration {
			display:block;
		}
		.button {
			margin-top: 20px;
			border-radius: 40px;
			padding: 10px 20px
		}
		.card .image {
			position: absolute;
			top: -40px;
			left:calc(125px - 40px);
			width: 80px;
			height: 80px;
			border-radius: 999px;
			overflow: hidden;
			background: white
		}
		.training-image {
			width: 100%;
			height: 100%;
			object-fit: fill;
		}
		.col-md-3 {
			text-align: center
		}
		.row .col-md-3:nth-of-type(odd) .card .card-header {
			background: #00428a
		}
		.row .col-md-3:nth-of-type(even) .card .card-header {
			background: #dc3545
		}
		.nav-menu li a{
			color: black
		}
		.header-scrolled .nav-menu li a{
			color: white
		}
		.ticker-btn {
			color: white !important
		}
		
		@media (max-width: 673px) {
		    #training-banner {
		    	max-height:80vh;
			
		}
		}
	</style>

	<script>
		function viewTraining(slug) {
			window.location.href = '/training-view/'+slug
		}
	</script>
@endsection