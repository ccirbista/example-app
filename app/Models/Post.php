<?php

namespace App\Models;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post{

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function findPost($slug)
    {

        $post = static::allPosts()->firstWhere('slug', $slug);

        if(! $post){
            throw new ModelNotFoundException();
        }

        return $post;


    }
    public static function findStudent($slug)
    {

        if(! file_exists($path = resource_path("students/{$slug}.html"))){ //if the path does not exist redirect to home page
            throw new ModelNotFoundException();
        
        }

        return cache()->remember("students.{$slug}",5 , function() use ($path){ //the student is cached for 5 seconds
        
        return file_get_contents($path);
        });


    }

    public static function allPosts()
    {

        return cache()->rememberForever('posts.all', function(){
            $files = File::files(resource_path("posts"));
    
            return $posts = collect($files)
                    ->map(function($item){
                        $document = YamlFrontMatter::parseFile($item);
                        return new Post(
                            $document->title,
                            $document->excerpt,
                            $document->date,
                            $document->body(),
                            $document->slug
                        );
                    })->sortByDesc('date');
            
        });
        
    }

    public static function allStudents()
    {
        return File::files(resource_path("students/"));
    }
    
}