<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;
class PostsController extends Controller
{



    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        $categories = Category::all();
        if ($categories->count() ==0   ) {
             
            return redirect()->route('category.create') ;
            
        }


        $tags = Tag::all();
        if ($tags->count() ==0 ) {
             
            return redirect()->route('tag.create') ;
            
        }


        return view('posts.create')->with('categories',$categories)
        ->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        
        $this->validate($request,[
            "title"    => "required",
            "content"  => "required",
            "category_id"  => "required",
            "featured" => "required|image",
            "tags" => "required"
        ]);

        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/posts',$featured_new_name);


        $post = Post::create([
            "title"    => $request->title,
            "content"  => $request->content,
            "category_id"  => $request->category_id,
            "featrued" => 'uploads/posts/'.$featured_new_name,
            "slug"    => str_slug($request->title), // my new post => my-new-post
            "user_id" => Auth::id()
        ]);

        $post->tags()->attach($request->tags);

    
     return redirect()->back();
        
   // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('posts',$post)
        ->with('categories',Category::all())->with('tags',Tag::all());;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $post = Post::find($id);

        $this->validate($request,[
            "title"    => "required",
            "content"  => "required",
            "category_id"  => "required" 
            
        ]);


        if ( $request->hasFile('featured')  ) {
            $featured = $request->featured;
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/posts/',$featured_new_name);

            $post->featrued = 'uploads/posts/'.$featured_new_name;
    
        }

       // dd($post);
        $post->title =  $request->title;
        $post->content =  $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        $post->tags()->sync($request->tags);
        
        return redirect()->route('posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete($id);
        return redirect()->back();
    }


    public function trashed()
    {
        $post = Post::onlyTrashed()->get();
      // dd($post);
       return view('posts.softdeleted')->with('posts',$post);
    }

    public function hdelete($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->restore();
        return redirect()->route('posts');
    }

}
