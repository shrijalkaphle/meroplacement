@extends('layout.frontend')
@section('title', 'Blog Home')
@section('body')
	

<!-- Start blog-posts Area -->

<div class="blog-wrapper section-padding-80">
<div class="container">
<div class="row">
    
    @foreach ($blogs as $blog)
    <div class="col-12 col-lg-6 mt-5">
        <div class="single-blog-area mb-50">
            <img src="uploads/{{ $blog->cover }}" alt="">
            <!-- Post Title -->
            <div class="post-title">
                <a href="{{ route('blog.view', $blog->slug) }}">{{ $blog->title }}</a>

                <div class="mb-15 d-flex top">
                        <a href="#">{{ date('M j, Y', strtotime($blog->created_at)) }}</a>
                        <span class="line">|</span>
                        <a href="#">By {{ $blog->author }}</a>
                    </div>
            </div>
            <!-- Hover Content -->
            <div class="hover-content">
                <!-- Post Title -->
                <div class="hover-post-title">
                    <a href="{{ route('blog.view', $blog->slug) }}">{{ $blog->title }}</a>
                </div>
                <p class="description">{{ strip_tags($blog->content) }}</p>
                <a href="{{ route('blog.view', $blog->slug) }}">Continue reading <i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
</div>
@endsection

@section('script')
    <style>
        .description {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 9; /* number of lines to show */
            -webkit-box-orient: vertical;
        }
        .post-title {
            width: 100% !important
        }
    </style>
@endsection