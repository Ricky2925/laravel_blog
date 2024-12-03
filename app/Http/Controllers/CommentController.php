<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
class CommentController extends Controller
{
   
    
    public function store(Request $request)
    {
         // 检查用户是否已登录
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to comment.');
        }
        
        // 验证用户提交的数据
        $request->validate([
            'post_id' => 'required|integer|exists:posts,id', // 确保 post_id 是整数且在 posts 表中存在
            'message' => 'required|string|max:1000',
        ]);

        // 存储评论到数据库
        $comment = Comment::create([
            'message' => $request->input('message'),
            'user_id' => auth()->id(), // 假设评论需要关联用户
            'post_id' => $request->input('post_id'), // 替换为实际文章 ID
        ]);
         // 可选择增加评论计数
        $post = $comment->post; // 获取当前评论关联的文章
        $post->increment('comment_count'); // 增加评论数

        // 返回到前端页面
        return redirect()->route('posts.show', $request->input('post_id'))->with('success', 'Comment added successfully!');
    }

    public function show($id)
    {
        // 获取指定文章及其评论
        $post = Post::with('comments.user')->findOrFail($id);

        
        
        return view('posts.show', compact('post'));
    }

    public function destroy(Comment $comment)
    {
        
        // 判断当前用户是否是评论的作者
        if (auth()->id() === $comment->user_id) {
            // 删除评论
            $comment->delete();

            // 返回到文章页面，带上成功信息
            return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully!');
        }elseif(auth()->user()->is_admin == 1){
             // 删除评论
             $comment->delete();

             // 返回到文章页面，带上成功信息
             return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully!');
        }

        // 如果不是评论的作者，返回错误
        return redirect()->route('posts.show', $comment->post_id)->with('error', 'You can only delete your own comments.');
    }
}
