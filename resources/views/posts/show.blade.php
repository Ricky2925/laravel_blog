@extends('layouts.app') <!-- 这里是布局文件的引用 -->

@section('content')

    <div class="widewrapper main">
        <div class="container">
            <div class="row">
                <div class="col-md-8 blog-main">
                    <article class="blog-post">
                        <header>
                           
                            <div class="lead-image">
                                <img src="{{ asset('storage/' . $post->img) }}" alt="" class="img-responsive">   
                            </div>
                        </header>
                        <div class="body">
                            <h1>{{ $post->title }}</h1>
                            <div class="meta">
                                <i class="fa fa-user"></i> {{ $post->author }} <i class="fa fa-calendar"></i>{{ $post->published_at }}<i class="fa fa-comments"></i><span class="data"><a href="#comments">{{$post->comment_count}} Comments</a></span>
                            </div>
                            {!! $post->content !!}
                           

                        </div>
                    </article>

                    <!-- <aside class="social-icons clearfix">
                        <h3>Share on </h3> 
                        <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-google"></i></a>
                    </aside> -->

                    <aside class="comments" id="comments">
                        <hr>

                        <h2><i class="fa fa-comments"></i> {{$post->comment_count}}Comments</h2>

                       

                       

                        <section class="comments">
                            <h2>Comments</h2>

                            <!-- 循环显示评论 -->
                            @foreach($post->comments as $comment)
                                <article class="comment">
                                    <header class="clearfix">
                                        <!-- 用户头像 -->
                                        <!-- <img src="{{ $comment->user->avatar ?? asset('img/avatar.png') }}" alt="{{ $comment->user->name ?? 'Anonymous' }}" class="avatar"> -->
                                        
                                        <div class="meta">
                                            <!-- 用户名称 -->
                                            <h3>
                                                <a href="#">{{ $comment->user->name ?? 'Anonymous' }}</a>
                                            </h3>
                                            
                                            <!-- 评论日期 -->
                                            <span class="date">
                                                {{ $comment->created_at->format('d F Y') }}
                                            </span>
                                            
                                            <span class="separator"> - </span>

                                            <!-- 判断当前用户是否是评论的作者或管理员 -->
                                            @if(auth()->check() && (auth()->id() === $comment->user_id || auth()->user()->is_admin == 1))
                                                <a href="{{ route('comments.destroy', $comment->id) }}" class="reply-link" onclick="event.preventDefault(); document.getElementById('delete-comment-{{ $comment->id }}').submit();">Delete</a>                
                                                <form id="delete-comment-{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endif
                                        </div>
                                    </header>

                                    <!-- 评论正文 -->
                                    <div class="body">
                                        {{ $comment->message }}
                                    </div>
                                </article>
                            @endforeach
                        </section>




                        <aside class="create-comment" id="create-comment">
                            <hr>    

                            <h2><i class="fa fa-pencil"></i> Add Comment</h2>

                            @if(auth()->check())
                                <form action="{{ route('comments.store') }}" method="POST" accept-charset="utf-8">
                                    @csrf
                                    <!-- 传递文章 ID -->
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <textarea rows="10" name="message" id="comment-body" placeholder="Your Message" class="form-control input-lg"></textarea>

                                    <div class="buttons clearfix">
                                        <button type="submit" class="btn btn-xlarge btn-clean-one">Submit</button>
                                    </div>
                                </form>
                            @else
                                <p>You need to <a href="{{ route('login') }}">login</a> to leave a comment.</p>
                            @endif
                        </aside>

                </div>
                 <!-- 引入公共的侧边栏 -->
                @include('layouts.sidebar', ['featuredPosts' => $featuredPosts])
            </div>
        </div>
    </div>
@endsection