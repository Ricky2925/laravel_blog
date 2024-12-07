@extends('layouts.app') <!-- Reference layout -->

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




                    <aside class="comments" id="comments">
                        <hr>

                        <h2><i class="fa fa-comments"></i> {{$post->comment_count}}Comments</h2>

                       

                       

                        <section class="comments">
                            <h2>Comments</h2>

                            <!-- Display comments -->
                            @foreach($post->comments as $comment)
                                <article class="comment">
                                    <header class="clearfix">
                                        
                                        
                                        <div class="meta">
                                            <!-- User name -->
                                            <h3>
                                                <a href="#">{{ $comment->user->name ?? 'Anonymous' }}</a>
                                            </h3>
                                            
                                            <!-- Comment date -->
                                            <span class="date">
                                                {{ $comment->created_at->format('d F Y') }}
                                            </span>
                                            
                                            <span class="separator"> - </span>

                                            <!-- Determine whether the current user is the author or administrator of the comment -->
                                            @if(auth()->check() && (auth()->id() === $comment->user_id || auth()->user()->is_admin == 1))
                                                <a href="{{ route('comments.destroy', $comment->id) }}" class="reply-link" onclick="event.preventDefault(); document.getElementById('delete-comment-{{ $comment->id }}').submit();">Delete</a>                
                                                <form id="delete-comment-{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endif
                                        </div>
                                    </header>

                                    <!-- Comment body -->
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
                                    <!-- Pass Post ID -->
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
                 <!-- Include public sidebar -->
                @include('layouts.sidebar', ['featuredPosts' => $featuredPosts])
            </div>
        </div>
    </div
@endsection