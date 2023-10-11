<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mero placement 1</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300,400,500,600,700&display=swap');
		* {
			margin:0;
			padding:0;
			box-sizing:border-box;
			font-family:'Poppins', sans-serif;
		}
		body {
			background:#696969;
			padding:50px 0
		}
		.container {
			margin:auto;
			/* position:relative; */
			width:21cm;
		}
		hr { 
			margin-top:-25px; 
		}
		.contact, .contact p {
			margin-bottom:20px;
		}
		.education li{
			list-style:none;
			margin-bottom:5px;
		}
		.education h5{
			color:#03a9f4;
			font-weight:500;
		}
		.education h4:nth-child(2){
			color:#fff;
			font-weight:500;
		}
		.education h4{
			color:#fff;
			font-weight:300;
		}
		.lang .per{
			position:relative;
			width:100%;
			height:6px;
			background:#081921;
			display:block;
			margin-top:5px;
		}
		.lang .per div{
			position:absolute;
			top:0;
			left:0;
			height:100%;
			background:#03a9f4;
		}
		.container .right-side{
			position:relative;
			background:#fff;
			padding:40px;
		}
		.about{
			margin-bottom:50px;
		}
		.about:last-child{
			margin-bottom:0;
		}
		.title1{
			color:#000;
			text-transform:uppercase;
			letter-spacing:1px;
			margin-bottom:30px;
		}
		.title2{
			color:#000;
			text-transform:uppercase;
			letter-spacing:1px;
			margin-bottom:30px;
			font-size:20px;
			font-weight:bold;
		}
		p{
			color:#333;
		}
	</style>
</head>
<body>
	<div style="position:fixed;top:20px;width:50%;right:0;text-align:center">
		<form action="/request/cv" method="post">
			@csrf
			<input type="hidden" name="job_seeker_id" value="{{ $user->jobseeker->id }}">
			<input type="hidden" name="template" value="{{ $template }}">
			<button type="submit" style="color:white;background:#17A2B8;padding:10px 20px;border:0;border-radius:20px;cursor: pointer;"><i class="fas fa-paper-plane"></i> Request</button>
		</form>
	</div>
	<div class="container">
		<div class="right-side">
			<div class="about">
				<h2 class="title1">{{ $user->name }}</h2>
				<div class="contact">
					<p><b>Address:</b> {{ $user->jobseeker->current_address }} </p>
					<p><b>Contact Number:</b> {{ $user->number }} </p>
					<p><b>Email:</b> {{ $user->email }} </p>
				</div>
				<p> {!!$user->jobseeker->aboutme!!} </p>
			</div><!---end profile section ---->
			<div class="about">
				<h2 class="title2">Education</h2>
				<hr>
				<table style="table-layout:fixed;width:100%">
					@foreach($user->jobseeker->education as $education)
					<tr style="">
						<td style="vertical-align:top;width:24%;padding-top:20px !important">
							<h5 style="text-transform:uppercase;color:#000;font-weight:600;">
								{{ date('Y',strtotime($education->start_date)) }} - 
								@if($education->end_date)
									{{ date('Y',strtotime($education->end_date)) }}
								@else
									PRESENT
								@endif
							</h5>
						</td>
						<td style="padding-top:20px">
							<h4 style="text-transform:uppercase;color:#000;font-size:16px;">{{$education->qualification->title}} in {{$education->program}}</h4>
							<h5>{{ $education->institute_name }} | {{ $education->board }}</h5>
							<br>
						</td>
					</tr>
					@endforeach
				</table>
			</div><!----end experience section--->


		<div class="about">
				<h2 class="title2">Experience</h2>
				<hr>
				<table style="table-layout:fixed;width:100%">
					@foreach($user->jobseeker->experience as $experience)
					<tr>
						<td style="vertical-align:top;width:24%;padding-top:20px">
							<h5 style="text-transform:uppercase;color:#000;font-weight:600;">
								{{ date('Y',strtotime($experience->start_date)) }} - 
								@if($experience->end_date)
									{{ date('Y',strtotime($experience->end_date)) }}
								@else
									PRESENT
								@endif
							</h5>
						</td>
						<td style="padding-top:20px">
							<h4 style="text-transform:uppercase;color:#000;font-size:16px;">{{ $experience->position }} | <span style="text-transform:capitalize">{{ $experience->position_level }}</span> Level</h4>
							<h5>{{ $experience->organization_name }} @if($experience->organization_industry) ({{ $experience->organization_industry->title }}) @endif</h5>
							<h5>{{ $experience->organization_location }}</h5>
							<p>{!! $experience->responsibilities !!}</p>
						</td>
					</tr>
					@endforeach
				</table>
			</div><!----end experience section--->


			<div class="about">
				<h2 class="title2">Training/Certificate</h2>
				<hr>
				<table style="table-layout:fixed;width:100%">
					@foreach($user->jobseeker->certificate as $certificate)
					<tr>
						<td style="vertical-align:top;width:24%;padding-top:20px">
							<h5 style="text-transform:uppercase;color:#000;font-weight:600;">
								{{ date('Y',strtotime($certificate->obtained_date)) }} ({{ $certificate->duration }} Months)
							</h5>
						</td>
						<td style="padding-top:20px">
							<h4 style="text-transform:uppercase;color:#000;font-size:16px;">{{ $certificate->title }}</h4>
							<h5>{{ $certificate->institute_name }}</h5>
						</td>
					</tr>
					@endforeach
				</table>
			</div><!----end experience section--->
		</div><!---end right-side---->
	</div>
</body>
</html>