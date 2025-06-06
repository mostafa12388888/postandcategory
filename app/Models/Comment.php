<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $fillable = ['user_id', 'post_id', 'status', 'ip_address', 'comment'];

    /**
     * post
     *
     * @return void
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
