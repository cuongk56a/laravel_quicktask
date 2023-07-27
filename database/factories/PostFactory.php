<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

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

    protected $model = Post::class;
    
    public function definition(): array
    {
        return [
            'title'=>$this->faker->sentence,
            'body'=>$this->faker->sentence,
            'created_at'=>now(),
            'updated_at'=>now(),
            'user_id'=> '0',
            // => function(){
            //     return factory(App\User::class) -> create() -> id;
            // },
        ];
    }
}
