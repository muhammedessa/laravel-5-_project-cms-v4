<?php

namespace App\Http\Controllers;
use\App\Setting;
use\App\Post;
use\App\Tag;
use\App\Category;
use Illuminate\Http\Request;

class siteUIcontroller extends Controller
{



    



    public function index()
    {
        return view('index')->with('blog_name' , Setting::first()->blog_name)
                            ->with('categories' , Category::take(5)->get() ) 
                            ->with('tags' , Tag::take(12)->get() ) 
                            ->with('first_post' , Post::orderBy('created_at','desc')->first())
                            ->with('second_post' , Post::orderBy('created_at','desc')->skip(1)->take(1)->get()->first())
                            ->with('third_post' , Post::orderBy('created_at','desc')->skip(2)->take(1)->get()->first()) 
                            ->with('fourth_post' , Post::orderBy('created_at','desc')->skip(3)->take(1)->get()->first())
                            ->with('ruby_on_rails',  Category::find(2) )
                            ->with('laravel',  Category::find(1) )
                            ->with('settings',  Setting::first() )
                            ->with('django_python',  Category::find(4) ) 
                             ;

    }



    public function showPost($slug)
    {

        $post      = Post::where('slug' , $slug)->first();
        $next_page = Post::where('id' , '>' ,$post->id)->min('id');
        $prev_page = Post::where('id' , '<' ,$post->id)->max('id');


        return view('posts.show') 
                             
                             ->with('tags' , Tag::all() ) 
                             ->with('post' , $post)
                             ->with('next' , Post::find($next_page))
                             ->with('prev' , Post::find($prev_page))
                            ->with('title' , $post->title)
                            ->with('blog_name' , Setting::first()->blog_name)
                            ->with('settings',  Setting::first() )
                            ->with('categories' , Category::take(5)->get() )   ;

    }



    public function category($id)
    {

        $category      = Category::find($id) ;
      

        return view('categories.category') 
                            ->with('tags' , Tag::all() ) 
                            ->with('title' , $category->name)
                            ->with('categories' , Category::take(5)->get() ) 
                            ->with('blog_name' , Setting::first()->blog_name)
                            ->with('settings',  Setting::first() )
                            ->with('name' , $category->name )  
                            ->with('category' , $category )    ;

    }



    public function tag($id)
    {

        $tag      = Tag::find($id) ;
      

        return view('tags.tags') 
                             
                            ->with('title' , $tag->tag)
                            ->with('categories' , Category::take(5)->get() ) 
                            ->with('blog_name' , Setting::first()->blog_name)
                            ->with('settings',  Setting::first() )
                            ->with('name' , $tag->name )  
                            
                            ->with('tag' , $tag )    ;

    }



}
