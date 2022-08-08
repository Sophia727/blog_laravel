<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::orderBy('id', 'asc')->paginate(5);
        return view('admin.user.user_list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        User::create([
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'photo'=>$request->photo,
            'birth_date'=>$request->dateOfBirth,
            'role'=>$request->role,
        ]);
        $alert = "User created Successfully!";
        return view('admin.user.alert', compact('alert'));
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
    public function activate($id){
        $user = User::find($id);
        $user->activate = !$user->activate;
        
        $message="";
        // return 'okkkkk';
        if($user['activate']){
            $user['updated_at']= now();
            $message= "User status: Active!";
        } else{
            $user['updated_at'] = now();
            $message = "User status: Desactivated";
        }
        if($user->update()){
            return redirect()->route('admin.user.user_list')->with(["status"=>$message]);
        } else {
            return back()->with('error', ' User Update failed')->withInput();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.user.show', ['user'=>$user]);
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
        $user= User::find($id);
        if($user->delete()){
        return back()->with('status', "user ID $user->id - $user->name : deleted successfully");
            //le code 200: everything went successully
            //201: created successully
            //419: expired / 404: not found
        } else {
            return back()->with('status', "Oops: failed to delete $user->id ");
        }
    }

    
    }
