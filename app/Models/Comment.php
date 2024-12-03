<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'post_id', 'message'];
    // 定义评论属于某一篇文章
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // 定义评论属于某一位用户（如果有用户表）
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
