@extends('layout.frontend')
@section('title', 'Blog Home')
@section('body')
	

<!-- Start blog-posts Area -->

    <div class="blog-wrapper section-padding-80">
        <div class="container">
             <h1 class="text-white">
                            {{ $blog->title }}			
                        </h1>
                        <small>By {{ $blog->author }}</small>
            {!! $blog->content !!}
            <hr>
            <b>Tags:</b> {{ $blog->tags }}
        </div>
    </div>
    <div class="share-btn">
	    <a href="#" class="facebook-btn"><i class="fab fa-facebook"></i></a>
        <a href="#" class="twitter-btn"><i class="fab fa-twitter"></i></a>
        <a href="#" class="linkedin-btn"><i class="fab fa-linkedin"></i></a>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="/social-share.css">
    <script src="/social-share.js"></script>
    <style>
        .blog-wrapper .container {
            padding: 100px 20px
        }
        small {
            color: white;
            font-size: 16px;
            text-decoration: underline
        }
    </style>
@endsection