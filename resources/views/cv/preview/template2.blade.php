<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mero placement 2</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style type="text/css">
      
  @import url("https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap");

* {
  margin:0;
  padding:0;
  box-sizing:border-box;
  list-style:none;
  font-family:"Montserrat", sans-serif;
}

body {
  
}

.bold {
  font-weight:700;
  font-size:20px;
  text-transform:uppercase;
}

.semi-bold {
  font-weight:500;
  font-size:16px;
}

.resume {
  width:800px;
  height:auto;
  display:flex;
  margin:50px auto;
}

.resume .resume_left {
  width:280px;
  background:#A9A9A9;
}

.resume .resume_left .resume_profile {
  width:100%;
  height:280px;
}

.resume .resume_left .resume_profile img {
  width:100%;
  height:100%;
}

.resume .resume_left .resume_content {
  padding:0 25px;
}

.resume .title {
  margin-bottom:20px;
}

.resume .resume_left .bold {
  color:#000;
}

.resume .resume_left .regular {
  color:#000;
}

.resume .resume_item {
  padding:25px 0;
  border-bottom:2px solid #eee;
}

.resume .resume_item1 {
  padding:25px 0;

}

.resume .resume_left .resume_item:last-child,
.resume .resume_right .resume_item:last-child {
  border-bottom:0px;
}

.resume .resume_left ul li {
  display:flex;
  margin-bottom:10px;
  align-items:center;
}

.resume .resume_left ul li:last-child {
  margin-bottom:0;
}



.resume .resume_left ul li .data {
  color:#000;
  font-weight:500;
}

.resume .resume_left .resume_skills ul li {
  display:flex;
  margin-bottom:10px;
  color:#000;
  font-weight:bold;
  font-size:
  justify-content:space-between;
  align-items:center;
}



.resume .resume_left .resume_social .semi-bold {
  color:#fff;
  margin-bottom:3px;
}

.resume .resume_right {
  width:520px;
  background:#fff;
  padding:25px;
}

.resume .resume_right .bold {
  color:#000;
}


.resume .resume_right .resume_work ul,
.resume .resume_right .resume_education ul {
  padding-left:40px;
  overflow:hidden;
}

.resume .resume_right ul li {
  position:relative;
}

.resume .resume_right ul li .date {
  font-size:16px;
  font-weight:500;
  margin-bottom:15px;
}

.resume .resume_right ul li .info {
  margin-bottom:20px;
}

.resume .resume_right ul li:last-child .info {
  margin-bottom:0;
}

.resume .resume_right .resume_work ul li:before,
.resume .resume_right .resume_education ul li:before {
  content:"";position:absolute;top:5px;left:-25px;width:4px;height:4px;
  border-radius:50%;
  border:2px solid #000;
}

  </style>


</head>
<body style="background:#696969;font-size:14px;line-height:22px;color:#555555;">
  <div style="position:fixed;top:20px;width:50%;right:0;text-align:center">
		<form action="/request/cv" method="post">
			@csrf
			<input type="hidden" name="job_seeker_id" value="{{ $user->jobseeker->id }}">
			<input type="hidden" name="template" value="{{ $template }}">
			<button type="submit" style="color:white;background:#17A2B8;padding:10px 20px;border:0;border-radius:20px;cursor: pointer;"><i class="fas fa-paper-plane"></i> Request</button>
		</form>
	</div>
<div class="resume">
   <div class="resume_left">
     <div class="resume_profile">
       <img src="/uploads/{{ $user->jobseeker->photo }}" alt="profile_pic">
     </div>
     <div class="resume_content">
       <div class="resume_item1 resume_info">
         <div class="title">
           <p class="bold">{{ $user->name }}</p>
         </div>
         <ul>
           <li>
      
             <div class="data">
                <b>Address:</b><br/>
                {{ $user->jobseeker->current_address }}
             </div>
           </li>
           <li>
   
             <div class="data">
              <b>Contact Number:</b><br />
              {{ $user->number }}
             </div>
           </li>
           <li>
        
             <div class="data">
              <b>Email:</b><br />
              {{ $user->email }}
             </div>
           </li>
           <li>
    
  
           </li>
         </ul>
       </div>
       <div class="resume_item1 resume_skills">
         <div class="title">
           <p class="bold">skill's</p>
         </div>
         <ul>
           @php
            $skills = explode(',', $user->jobseeker->preference->skills);
            foreach($skills as $skill) {
              echo '<li> <div class="data"> ' . $skill . ' </div> </li>';
            }
           @endphp
           
         </ul>
       </div>
       <div class="resume_item1 resume_skills">
         <div class="title">
           <p class="bold">Language</p>
         </div>
         <ul>
           @php
            $languages = explode(',', $user->jobseeker->preference->languages);
            foreach($languages as $language) {
              echo '<li> <div class="data"> ' . $language . ' </div> </li>';
            }
           @endphp
           
         </ul>
       </div>
     </div>
  </div>
  <div class="resume_right">
    <div class="resume_item resume_about">
        <div class="title">
           <p class="bold">About us</p>
         </div>
        <p>
          {!! $user->jobseeker->aboutme !!}
        </p>
    </div>
    <div class="resume_item resume_work">
        <div class="title">
           <p class="bold">Work Experience</p>
         </div>
        <ul>
          @foreach($user->jobseeker->experience as $experience)
            <li>
                <div class="date">
                  {{ date('Y',strtotime($experience->start_date)) }} - 
                  @if($experience->end_date)
                    {{ date('Y',strtotime($experience->end_date)) }}
                  @else
                    PRESENT
                  @endif
                </div> 
                <div class="info">
                  <p class="semi-bold">{{ $experience->position }} | <span style="text-transform:capitalize">{{ $experience->position_level }}</span> Level</p> 
                  <p>{{ $experience->organization_name }} @if($experience->organization_industry) ({{ $experience->organization_industry->title }}) @endif</p>
                  <br>
                  <p>{!! $experience->responsibilities !!}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="resume_item resume_education">
      <div class="title">
        <p class="bold">Education</p>
      </div>
      <ul>
        @foreach($user->jobseeker->education as $education)
            <li>
                <div class="date">
                  {{ date('Y',strtotime($education->start_date)) }} - 
                  @if($education->end_date)
                    {{ date('Y',strtotime($education->end_date)) }}
                  @else
                    PRESENT
                  @endif
                </div> 
                <div class="info">
                     <p class="semi-bold">{{$education->qualification->title}} in {{$education->program}}</p> 
                    <p>{{ $education->institute_name }} | {{ $education->board }}</p>
                </div>
            </li>
          @endforeach
        </ul>
    </div>

  </div>
</div>

</body>
</html>