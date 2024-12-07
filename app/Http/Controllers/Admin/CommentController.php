<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment; 
class CommentController extends Controller
{
    
    public function index()
    {
        // Display all comments, including related user and post information
        $comments = Comment::with('user', 'post')->get();
      
         // Return the view and pass the comments data to the view
        return view('admin.comments.index', compact('comments'));
    }

    
    public function destroy(Comment $comment)
    {
        // Get the post associated with the comment
        $post = $comment->post;
    
        // Delete a comment
        $comment->delete();
    
        // Decrease the comment count on the related post by 1
        $post->decrement('comment_count');
    
        // Redirect back to the comment list with a success message
        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully.');
    }

     // Show the edit form for a comment
     public function edit($id)
     {
         // Get the specified comment
         $comment = Comment::findOrFail($id);
 
         // Return the edit view and pass the comment data
         return view('admin.comments.edit', compact('comment'));
     }
     // Update a comment
    public function update(Request $request, $id)
    {
        // Validate the form data
        $validated = $request->validate([
            'message' => 'required|string|min:1|max:500',  // Validation rule for comment content
        ]);

        // Get the specified comment
        $comment = Comment::findOrFail($id);

        // Update the comment message
        $comment->message = $validated['message'];

        // Save the updated comment
        $comment->save();

        // Redirect back to the comment list with a success message
        return redirect()->route('admin.comments.index')->with('success', 'Comment updated successfully.');
    }
}
