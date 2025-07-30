<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Publication;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Comment;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $category = Category::factory(4)->create();
        $publication= Publication::factory(4)->create([
           'category_id' =>  Category::inRandomOrder()->first()->id
        ]);
        $question = Question::factory(8)->create([
            'category_id' => function(){
                return Category::inRandomOrder()->first()->id;
            } ,
            'user_id' => function(){
                return  User::inRandomOrder()->first()->id;
            }
        ]);
        $answer = Answer::factory(8)->create([
            'category_id' => fn() => Category::inRandomOrder()->first()->id,
            'user_id' => fn() => User::inRandomOrder()->first()->id,
        ]);
        Comment::factory(20)->create([
            'user_id' => fn() => User::inRandomOrder()->first()->id,
            'commentable_id' => fn() => $answer->random()->id,
            'commentable_type' => fn() => Answer::class
        ]);
        Comment::factory(20)->create([
            'user_id' => fn() => User::inRandomOrder()->first()->id,
            'commentable_id' => fn() => $question->random()->id,
            'commentable_type' => fn() => Question::class
        ]);
        Comment::factory(20)->create([
            'user_id' => fn() => User::inRandomOrder()->first()->id,
            'commentable_id' => fn() => $publication->random()->id,
            'commentable_type' => fn() => Publication::class
        ]);
    }
}
