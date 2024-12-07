<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
class CommentController extends Controller
{
   
    
    public function store(Request $request)
    {
         // Check if the user is logged in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to comment.');
        }
        
        // Validate the incoming data
        $request->validate([
            'post_id' => 'required|integer|exists:posts,id', 
            'message' => 'required|string|max:1000',
        ]);

        // Store the comment in the database
        $comment = Comment::create([
            'message' => $request->input('message'),
            'user_id' => auth()->id(), // Associate the comment with the logged-in user
            'post_id' => $request->input('post_id'), // Use the provided post_id for the comment
        ]);
         // Increment the comment count for the related post
        $post = $comment->post; // Get the post associated with the comment
        $post->increment('comment_count'); // Increment the comment_count on the post

         // Redirect back to the post page with a success message
        return redirect()->route('posts.show', $request->input('post_id'))->with('success', 'Comment added successfully!');
    }

    public function show($id)
    {
        // Retrieve the post with its associated comments and the user who made each comment
        $post = Post::with('comments.user')->findOrFail($id);

        
        
        return view('posts.show', compact('post'));
    }

    public function destroy(Comment $comment)
    {
        
        // Check if the logged-in user is the author of the comment
        if (auth()->id() === $comment->user_id) {
            // Delete the comment if the user is the author
            $comment->delete();

            // Redirect back to the post page with a success message
            return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully!');
        }elseif(auth()->user()->is_admin == 1){
             // Delete the comment if the user is an admin
             $comment->delete();

             // Redirect back to the post page with a success message
             return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully!');
        }

         // If the user is not the author and not an admin, show an error
        return redirect()->route('posts.show', $comment->post_id)->with('error', 'You can only delete your own comments.');
    }
}
