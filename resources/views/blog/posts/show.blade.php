@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="blog_content">
                    <h1 class="post-title">{{ $item->title }}</h1>
                    {{ $item->content_html }}
                </div>

                @if ($comments->count())
                    @include('blog.posts.comments.comments')
                @endif

                @include('blog.posts.comments.comment_form')
            </div>
        </div>
    </div>
@endsection
