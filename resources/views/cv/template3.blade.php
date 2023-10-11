<!DOCTYPE html>
<html>
<head>
	<title>Mero placement 3</title>
	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style type="text/css">

	body{
	margin: 0px;
	padding: 0px;
	background-image: radial-gradient(#c7c7c7 25%, #c7c7c7 74%);
	height: 100vh;
	font-family: system-ui;

}
.clearfix{
	clear: both;
}
.main{
	height: 1150px;
	width: 800px;
	background-color: white;
	box-shadow: 5px 7px 15px 5px #b9b6b6;
	margin: 20px auto;

}

.top-section{
	background-color:#151b29;
	text-align: center;
	padding: 20px;
}
.profile{
	width: 150px;
	border-radius: 50%;
}
.p1{
	color: white;
	font-size: 40px;
	font-weight: bold;
	margin: 0px;
	margin-top: 10px;
}
.p1 span{
	font-weight: 100;
	color: #c7c7c7;
}
.p2{
	font-size: 20px;
	color: #c7c7c7;
	margin: 0px;
	margin-top: 10px;
}
.col-div-4{
	width: 35%;
	float: left;

}
.col-div-8{
	width: 62%;
	float: left;
}
.line{
	border-left: 2px solid #000;
  height: 800px;
  width: 2%;
  margin-top: 30px;
  float:left;
}
.content-box{
	padding: 20px;
}
.head{
	font-size: 18px;
	text-transform: uppercase;
	font-weight: 600;
	background-color: lightgrey;
	border-bottom: 2px solid grey;
}
.p3{
	color: #7b7b7b;
	margin-bottom: -5px;
}
.language.p3 {
	text-transform:uppercase
}
.fa{
	color: #151b29;
}
.skills{
	margin-left: -20px;
	    margin-bottom: 0px;
}
.skills li{
	padding: 5px;
	text-transform:uppercase
}
.skills li span{
	color: #7b7b7b;
}
.p-4{
	font-size: 14px;
	color: #7b7b7b;
}

.date{
	float: right;
}
	
</style>


</head>
<body>

	<div class="main">
		<div class="top-section">
			<img src="/uploads/{{ $user->jobseeker->photo }}" class="profile" />
			<p class="p1">{{ $user->name }}</p>
		</div>
		<div class="clearfix"></div>

		<div class="col-div-4">
			<div class="content-box" style="padding-left: 40px;">

				
			<p class="head">Contact</p>
			<p class="p3"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;&nbsp;{{ $user->number }}</p>
			<p class="p3"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;&nbsp;{{ $user->email }}</p>
			<p class="p3"><i class="fa fa-home" aria-hidden="true"></i> &nbsp;&nbsp;{{ $user->jobseeker->current_address }}</p>
			

			<br/>
			<p class="head">my skills</p>
			<ul class="skills">
				@php
					$skills = explode(',', $user->jobseeker->preference->skills);
					foreach($skills as $skill) {
						echo "<li><span>" . $skill . "</span></li>";
					}
				@endphp
			</ul>

			<br/>
			<p class="head">CERTIFICATE</p>
			@foreach($user->jobseeker->certificate as $certificate)
				<p class="p3">{{ $certificate->title }}</p>
			@endforeach
			<br/>

			<p class="head">Languages</p>
			@php
            $languages = explode(',', $user->jobseeker->preference->languages);
            foreach($languages as $language) {
              echo '<p class="p3 language">' . $language . '</p>';
            }
           @endphp
		</div>
		</div>
		<div class="line"></div>
		<div class="col-div-8">
			<div class="content-box">
			<p class="head">profile</p>
			<p class="p3" style="font-size: 14px;">{!! $user->jobseeker->aboutme !!}</p>
			<br/>
			<p class="head">EXPERIENCE</p>
			@foreach($user->jobseeker->experience as $experience)
			<p>
				{{ $experience->position }} | <span style="text-transform:capitalize">{{ $experience->position_level }}</span> Level
				<span class='date'>
				({{ date('Y',strtotime($experience->start_date)) }} - 
                  @if($experience->end_date)
                    {{ date('Y',strtotime($experience->end_date)) }})
                  @else
                    Present)
                  @endif
				</span>
				<br>
				<small>{{ $experience->organization_name }} | {{ $experience->organization_location }}</small>
			</p>
			<p class="p-4">
			{!! $experience->responsibilities !!}
			@endforeach
			<br/>

			<p class="head">Education</p>
			@foreach($user->jobseeker->education as $education)
				<p class="p-4" >
					{{ $education->qualification->title }} in {{ $education->program }}
					<span class='date'>
						({{ date('Y',strtotime($education->start_date)) }} - 
						@if($education->end_date)
							{{ date('Y',strtotime($education->end_date)) }})
						@else
							Present)
						@endif
					</span></p>
			@endforeach
			</div>
		</div>

		<div class="clearfix"></div>

	</div>
		<br/>
</body>
</html>