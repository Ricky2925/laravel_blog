<aside class="col-md-4 blog-aside">
    <div class="aside-widget">
        <header>
            <h3>Featured Posts</h3>
        </header>
        <div class="body">
            <ul class="clean-list">
                <!-- Using the passed featuredPosts -->
                @foreach($featuredPosts as $featuredPost)
                    <li>
                        <a href="{{ route('posts.show', $featuredPost->id) }}">
                            {{ $featuredPost->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</aside>
