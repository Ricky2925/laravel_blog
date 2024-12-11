<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $dates = ['published_at'];// Define the fields that should be treated as date instances
    // Define table names, fields, and other attributes here
    protected $fillable = ['title', 'img', 'content', 'author', 'published_at', 'comment_count'];
    // Define a one-to-many relationship: a post can have multiple comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
