<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment; 
class CommentController extends Controller
{
    
    public function index()
    {
        // 获取所有评论，包含评论的用户和文章信息
        $comments = Comment::with('user', 'post')->get();
      
        // 返回视图，并将评论数据传递给视图
        return view('admin.comments.index', compact('comments'));
    }

    // 删除评论
    public function destroy(Comment $comment)
    {
        // 获取与该评论相关联的文章
        $post = $comment->post;
    
        // 删除评论
        $comment->delete();
    
        // 更新文章的评论数（减去1）
        $post->decrement('comment_count');
    
        // 重定向回评论列表，并显示成功消息
        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully.');
    }

     // 显示编辑表单
     public function edit($id)
     {
         // 获取指定评论
         $comment = Comment::findOrFail($id);
 
         // 返回编辑视图并传递评论数据
         return view('admin.comments.edit', compact('comment'));
     }
     // 更新评论
    public function update(Request $request, $id)
    {
        // 验证表单数据
        $validated = $request->validate([
            'message' => 'required|string|min:1|max:500',  // 评论内容的验证规则
        ]);

        // 获取指定评论
        $comment = Comment::findOrFail($id);

        // 更新评论内容
        $comment->message = $validated['message'];

        // 保存更新
        $comment->save();

        // 返回到评论列表，并显示更新成功的消息
        return redirect()->route('admin.comments.index')->with('success', 'Comment updated successfully.');
    }
}
