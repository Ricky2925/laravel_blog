<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import the Storage class
class PostController extends Controller
{
    // Display all posts
    public function index()
    {
        // Fetch all posts and pass them to the view
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }
    // Show the form to create a new post
    public function create(){
        return view('admin.posts.create');
    }

   
    // Store a new post
    public function store(Request $request)
    {
        
        // Validate the form data, the image field is required
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is required
        ]);
        
         // Save the image and get the file path
        $imagePath = $request->file('img')->store('images', 'public');
    
        // Create a new post
        $post = new Post();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->author = 'admin';
        $post->img = $imagePath;  
        $post->published_at = now();
        $post->save();
    
        // Return a success message and redirect
        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }
    


    // Show the form to edit a post
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

        // Update an existing post
        public function update(Request $request, Post $post)
        {
            // Validate the input
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 图片验证
            ]);
    
            // If a new image is uploaded
            if ($request->hasFile('img')) {
                // Delete the old image
                if ($post->img && Storage::exists('public/images/' . $post->img)) {
                    Storage::delete('public/images/' . $post->img);
                }
    
                // Upload the new image and get the file path
                $imagePath = $request->file('img')->store('images', 'public');  // 存储在 `storage/app/public/images` 文件夹下
            } else {
                // If no new image is uploaded, keep the existing image
                $imagePath = $post->img;
            }
    
            // Update the post
            $post->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'img' => $imagePath,  // Update image path
            ]);
    
            // Redirect back to the post list and show success message
            return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
        }
   
    
    
    

    // Delete a post
    public function destroy(Post $post)
    {
        // Delete the post
        $post->delete();

        // Redirect back to the post list and show success message
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}
