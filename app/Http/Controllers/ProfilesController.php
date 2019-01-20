<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;
class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        $id = Auth::id();
       // return dd($id);
          if ($user->profile == null) {

             $profile =  Profile::create([
            'user_id' => $id,
            'avatar' => 'uploads/avatar/1.png'
             ]);

           // return dd($id);
        }

       
        
        return view('users.profile')->with('user',Auth::user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
        
        

        $this->validate($request,[
            "name"    => "required",
            "email"  => "required|email" 
            
            
        ]);


        $user = Auth::user();
     



        if ( $request->hasFile('avatar')  ) {
            $avatar = $request->avatar;
            $avatar_new_name = time().$avatar->getClientOriginalName();
            $avatar->move('uploads/avatar/',$avatar_new_name);
            $user->profile->avatar = 'uploads/avatar/'.$avatar_new_name;
           $user->profile->save();
    
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile->facebook = $request->facebook;
        $user->profile->twitter = $request->twitter;
        $user->profile->github = $request->github;
        $user->profile->about = $request->about;
        $user->save();
        $user->profile->save();


        if ( $request->has('password')  ) {
            
           $user->password = bcrypt($request->password);
           $user->save();
        }
        return redirect()->back();

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
