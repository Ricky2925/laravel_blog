<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $dates = ['published_at'];
    // 你可以在这里定义表名、字段等属性
    protected $fillable = ['title', 'img', 'content', 'author', 'published_at', 'comment_count'];
    // 定义一对多关系：一个文章有多个评论
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
