<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Role;
use App\Permission;
class UsersController extends Controller
{


    public function __construct(){
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index')->with('users',User::all())->with('profiles',Profile::all()) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create')   ;
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
            'name' => 'required',
            'email' => 'required',
            
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  bcrypt('password')
        ]);

    //     $admin =  Role::where('name', 'admin')->first();
    //     $owner =  Role::where('name', 'owner')->first();

    //     $editUser =  Permission::where('name', 'edit-user')->first();
    //     $createPost =  Permission::where('name', 'create-post')->first();
    //    // $user->attachRole([$admin, $owner]);
    //     $user->attachRoles([$admin, $owner]);  

    //     $user->attachPermissions([$editUser, $createPost]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatar/1.png'

        ]);

          return redirect()->route('users');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->profile->delete($id);
        $user->delete();
        return redirect()->route('users');
    }




    public function admin($id)
    {
        $user = User::find($id);
        $user->admin = 1;
        $user->save();
        return redirect()->route('users');
    }

    public function notAdmin($id)
    {
        $user = User::find($id);
        $user->admin = 0;
        $user->save();
        return redirect()->route('users');
    }




}
