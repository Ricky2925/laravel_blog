<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // Get all posts from the database, ordered by the most recent
        $posts = Post::latest()->get(); // Fetch all posts ordered by the latest date

        // Return the 'welcome' view, passing the posts data
        return view('welcome', compact('posts'));
    }

    public function show(Post $post)
    {
        $featuredPosts = Post::latest()->take(5)->get(); 
        // Return the 'posts.show' view with the post and featured posts data
        return view('posts.show', compact('post','featuredPosts'));
    }
}