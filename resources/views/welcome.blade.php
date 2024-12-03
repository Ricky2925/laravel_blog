@extends('layouts.app') <!-- 这里是布局文件的引用 -->

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
                                    <!-- 显示文章的图片 -->
                                    <img src="{{ asset('storage/' . $post->img) }}" alt="">

                                    <!-- 显示文章标题 -->
                                    <h3><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h3>

                                    <!-- 显示文章的发布日期和作者 -->
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

