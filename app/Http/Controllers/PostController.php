<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // 从数据库获取所有文章
        $posts = Post::latest()->get(); // 按发布时间倒序获取所有文章

        // 返回视图，并将文章数据传递给视图
        return view('welcome', compact('posts'));
    }

    public function show(Post $post)
    {
        $featuredPosts = Post::latest()->take(5)->get(); 
        // 显示单篇文章的详细信息
        return view('posts.show', compact('post','featuredPosts'));
    }
}