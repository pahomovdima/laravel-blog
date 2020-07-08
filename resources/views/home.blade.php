@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @foreach ($posts as $post)
                    <div class="post-preview">
                        <a href="{{ route('blog.posts.show', $post->slug) }}">
                            <h2 class="post-title">
                                {{ $post->title }}
                            </h2>
                            <h3 class="post-subtitle">
                                {{ $post->slug }}
                            </h3>
                        </a>
                        <p class="post-meta">Posted by
                            <a href="#">Start Bootstrap</a>
                            on {{ $post->published_at }}
                        </p>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
@endsection
