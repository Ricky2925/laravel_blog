<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // 引入 Storage 类
class PostController extends Controller
{
    // 显示所有文章
    public function index()
    {
        // 获取所有文章并传递给视图
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }
    // 添加文章
    public function create(){
        return view('admin.posts.create');
    }

   
    // 存储
    public function store(Request $request)
    {
        
        // 表单验证，图片字段是必填的
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 图片是必填的
        ]);
        
        // 保存图片并获取文件路径
        $imagePath = $request->file('img')->store('images', 'public');
    
        // 创建新文章
        $post = new Post();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->author = 'admin';
        $post->img = $imagePath;  
        $post->published_at = now();
        $post->save();
    
        // 返回成功消息并重定向
        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }
    


    // 编辑文章
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }


        public function update(Request $request, Post $post)
        {
            // 验证输入
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 图片验证
            ]);
    
            // 如果有上传新的图片
            if ($request->hasFile('img')) {
                // 删除旧的图片
                if ($post->img && Storage::exists('public/images/' . $post->img)) {
                    Storage::delete('public/images/' . $post->img);
                }
    
                // 上传新图片并获取路径
                $imagePath = $request->file('img')->store('images', 'public');  // 存储在 `storage/app/public/images` 文件夹下
            } else {
                // 如果没有上传新图片，保持原有的图片
                $imagePath = $post->img;
            }
    
            // 更新文章
            $post->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'img' => $imagePath,  // 更新图片路径
            ]);
    
            // 重定向回文章列表页面，并显示成功消息
            return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
        }
   
    
    
    

    // 删除文章
    public function destroy(Post $post)
    {
        // 删除文章
        $post->delete();

        // 重定向回文章列表，并显示成功消息
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}
