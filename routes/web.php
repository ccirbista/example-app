<?php

use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Models\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {

    
    
    return view('posts', [
        'posts' => Post::allPosts()
    ]);
});

Route::get('posts/{post}', function($slug){ //find a post by its slug and pass it to a view called post


    $post = Post::findPost($slug);
    return view('post', [
        "post" => $post
    ]);

    
})->where('post', '[A-z_\-]+');

Route::get('/students', function(){ //route to go to student's list
    $students = Post::allStudents();
    ddd($students);
    return view('students', [
        'students' => $students
    ]);
});

Route::get('students/{student}', function($slug){//route to go to individual student's detail
    
    return view('student', [
        'student' => Post::findStudent($slug)//inlining the route to make the code cleaner
    ]);
})->where('post', '[A-z_\-]+');