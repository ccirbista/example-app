<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();dropping the tables is not necessary if we perform the migrate:fresh and db:seed together because it fresh drops all the records in the database
        // Category::truncate();
        // Post::truncate();

        $user = User::factory()->create([  //for seeding specific data instead of fake data
            'name' => 'Shishir Bista'
        ]);



        Post::factory(5)->create([
            'user_id' => $user->id
        ]);

    //    $user = User::factory()->create(); hardcoding the database seeding operation

    //    $personal = Category::create([
    //                 'name' => 'Personal',
    //                 'slug' => 'personal'
    //                 ]);
    //    $family = Category::create([
    //     'name' => 'Family',
    //     'slug' => 'family'
    //     ]);
    //     $work = Category::create([
    //         'name' => 'Work',
    //         'slug' => 'work'
    //     ]);

    //     Post::create([
    //         'user_id' => $user->id,
    //         'category_id' => $family->id,
    //         'title' => 'My family Post',
    //         'slug' => 'my-family-post',
    //         'body' => '<p>This is the body of the post</p>',
    //         'excerpt' => '<p>This is the excerpt...</p>'

    //     ]);

    //     Post::create([
    //         'user_id' => $user->id,
    //         'category_id' => $work->id,
    //         'title' => 'My Work Post',
    //         'slug' => 'my-work-post',
    //         'body' => '<p>This is the body of the post</p>',
    //         'excerpt' => '<p>This is the excerpt...</p>'

    //     ]);
    }
}
