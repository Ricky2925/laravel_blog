<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'post_id', 'message'];// Define the fields that can be mass-assigned
    // Define that a comment belongs to a specific post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Define that a comment belongs to a specific user (if a user table exists)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
