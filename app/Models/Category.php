<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'slug', 'name'];
    /**
     * posts
     *
     * @return void
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
