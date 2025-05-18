<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['user_id', 'category_id', 'status', 'comment_able', 'slug', 'desc', 'title', 'number_of_views'];

    /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
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
    /**
     * comment
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    /**
     * image
     *
     * @return void
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'post_id');
    }
    /**
     * sluggable
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    // scope filter
    /**
     * scopeActive
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
