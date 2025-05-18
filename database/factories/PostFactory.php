<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date=fake()->date('Y-m-d h:m:s');
        return [
            'title'=>fake()->sentence(3),
            'desc'=>fake()->sentence(5),
            'comment_able'=>rand(0,1),
            'number_of_views'=>rand(0,100),
            'status'=>rand(0,1),
            'category_id'=>Category::inRandomOrder()->first()->id,
            'user_id'=>User::inRandomOrder()->first()->id,
            'created_at'=>$date,
            'updated_at'=>$date,
        ];
    }
}
