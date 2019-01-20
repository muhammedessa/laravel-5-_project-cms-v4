<?php
use App\Mail\TestEmail;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
Auth::routes(['verify' => true]);



Route::get('/home', 'HomeController@index')->name('home') ;



//Route::group(['prefix' => 'user', 'middleware'=>'auth'], function () {
  Route::group([ 'middleware'=>'auth'], function () {   
    //route for posts
    Route::get('/posts', 'PostsController@index')->name('posts'); 
    Route::get('/post/trashed', 'PostsController@trashed')->name('post.trashed');
    Route::get('/post/hdelete/{id}', 'PostsController@hdelete')->name('post.hdelete');
    Route::get('/post/restore/{id}', 'PostsController@restore')->name('post.restore');
    Route::get('/post/edit/{id}', 'PostsController@edit')->name('post.edit');
    Route::post('/post/update/{id}', 'PostsController@update')->name('post.update');
    Route::get('/post/create', 'PostsController@create')->name('post.create');
    Route::post('/post/store', 'PostsController@store')->name('post.store'); 
    Route::get('/post/delete/{id}', 'PostsController@destroy')->name('post.delete'); 
    
     //route for Categories
    Route::get('/categories', 'CategoriesController@index')->name('categories'); 
    Route::get('/category/edit/{id}', 'CategoriesController@edit')->name('category.edit');
    Route::get('/category/delete/{id}', 'CategoriesController@destroy')->name('category.delete'); 
    Route::get('/category/create', 'CategoriesController@create')->name('category.create');   
    Route::post('/category/store', 'CategoriesController@store')->name('category.store'); 
    Route::post('/category/update/{id}', 'CategoriesController@update')->name('category.update'); 


    //route for Tag
    Route::get('/tags', 'TagController@index')->name('tags'); 
    Route::get('/tag/edit/{id}', 'TagController@edit')->name('tag.edit');
    Route::get('/tag/delete/{id}', 'TagController@destroy')->name('tag.delete'); 
    Route::get('/tag/create', 'TagController@create')->name('tag.create');   
    Route::post('/tag/store', 'TagController@store')->name('tag.store'); 
    Route::post('/tag/update/{id}', 'TagController@update')->name('tag.update'); 
 


    //route for users
    Route::get('/users', 'UsersController@index')->name('users'); 
    Route::get('/users/admin/{id}', 'UsersController@admin')->name('users.admin'); //->middleware('admin'); 
    Route::get('/users/notadmin/{id}', 'UsersController@notAdmin')->name('users.not.admin'); 
    Route::get('/users/create', 'UsersController@create')->name('users.create'); 
    Route::post('/users/store', 'UsersController@store')->name('users.store'); 
    Route::get('/users/delete/{id}', 'UsersController@destroy')->name('users.delete'); 
    
    
    //route for user profile
    Route::get('/users/profile', 'ProfilesController@index')->name('users.profile');
    Route::post('/users/profile/update', 'ProfilesController@update')->name('users.profile.update');
    Route::get('/users/profile/create', 'ProfilesController@create')->name('users.profile.create'); 

        //route for Settings
        Route::get('/settings', 'SettingsController@index')->name('settings');
        Route::post('/settings/update', 'SettingsController@update')->name('settings.update');

        //route for User front end
        Route::get('/', 'siteUIcontroller@index')->name('index');
        Route::get('/category/{id}', 'siteUIcontroller@category')->name('category.show');
        Route::get('/tag/{id}', 'siteUIcontroller@tag')->name('tag.show');

         //route for showing single post
         Route::get('/post/{slug}', 'siteUIcontroller@showPost')->name('post.show'); 


        //route for admin dashboard
      Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard'); 


      //route for query results
        Route::get('/results', function () {
            $post = App\Post::where('title', 'like' ,  '%' . request('search') . '%' )->get();
            return view('results.results')
            ->with('posts' , $post ) 
            ->with('title' ,  'Result : '. request('search') )
            ->with('settings',  App\Setting::first() )
            ->with('blog_name' , App\Setting::first()->blog_name)
            ->with('categories' , App\Category::take(5)->get() )   
            ->with('query' , request('search') )   ;
            
        }) ;








  

          //route for sending emails
        Route::get('/testmail', function () {
 
            $data = ['message' => 'This is a test!'];
            Mail::to('muhammed.essa@gmail.com')->send(new TestEmail($data));

            return back();
            })->name('testmail');












            Route::get('sendemail', function () {

                $data = array(
                    'name' => "Muhammed Essa",
                );
            
                Mail::send('emails.test', $data, function ($message) {
            
                    $message->from('muhammed.essa@codeforiraq.org', 'Hello Muhammed');
            
                    $message->to('muhammed.essa@gmail.com')
                    ->subject('This is test email');
            
                });
            
                return "Your email has been sent successfully";
            
            });




}) ;


Route::get('/muhammed', function(){
// dd(App\Category::find(7)->posts());
// return App\Post::find(4)->category  ;
// return App\Tag::find(5)->posts  ;
// return App\Post::find(9)->tags  ;
//return App\User::find(1)->profile  ;
  return App\Post::find(7)->category    ;
})->name('muhammed'); 






// make new role
Route::get('/newrole', function(){
   
    // $owner = new App\Role();
    // $owner->name         = 'owner';
    // $owner->display_name = 'Project Owner'; // optional
    // $owner->description  = 'User is the owner of a given project'; // optional
    // $owner->save();

    $admin = new App\Role();
    $admin->name         = 'admin';
    $admin->display_name = 'User Administrator'; // optional
    $admin->description  = 'User is allowed to manage and edit other users'; // optional
    $admin->save();

    return back();
    })->name('newrole'); 







    // make new permission
Route::get('/newpermission', function(){
   
   
    $createPost = new App\Permission();
    $createPost->name         = 'create-post';
    $createPost->display_name = 'Create Posts'; // optional
    // Allow a user to...
    $createPost->description  = 'create new blog posts'; // optional
    $createPost->save();
    
    $editUser = new App\Permission();
    $editUser->name         = 'edit-user';
    $editUser->display_name = 'Edit Users'; // optional
    // Allow a user to...
    $editUser->description  = 'edit existing users'; // optional
    $editUser->save();

    return back();
    })->name('newpermission'); 







Route::group([ 'middleware'=>['role:adminsitrator']], function () {   

 Route::resource('userss', 'UserssController') ;
 Route::resource('permission', 'PermissionController') ;
 Route::resource('roles', 'RolesController') ;
});


Route::get('/greeting', function () {

    



    return view('greeting', ['name' => 'Muhammed Essa']);
});










// Route::group(['prefix' => 'admin'], function () {
//     Voyager::routes();
// });
