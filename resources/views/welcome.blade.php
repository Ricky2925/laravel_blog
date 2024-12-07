@extends('layouts.app') <!-- Reference layout file -->

@section('content')

    <div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-6 col-sm-6">
                            <article class="blog-teaser">
                                <header>
                                    <!-- Displays images of post -->
                                    <img src="{{ asset('storage/' . $post->img) }}" alt="">

                                    <!-- Displays the title of post -->
                                    <h3><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h3>

                                    <!-- Displays the post's publication date and author -->
                                    <span class="meta">{{ $post->published_at->format('d F Y') }}, {{ $post->author }}</span>
                                    <hr>
                                </header>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>

            @include('layouts.sidebar', ['featuredPosts' => $posts])
        </div>
    </div>
</div>
@endsection

