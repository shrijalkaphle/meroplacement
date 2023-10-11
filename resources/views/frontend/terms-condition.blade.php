@extends('layout.frontend')
@section('title', 'Terms and Condition')
@section('body')
	<section id="training" class="section-full">
		<div class="container">
            {!! $sitesetting->termscondition !!}
        </div>
	</section>
@endsection

@section('script')
	<style>
		.nav-menu li a{
			color: black
		}
	</style>
@endsection