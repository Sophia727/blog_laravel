<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\UserCreatedNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
        return view('admin.user.user_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData= $request->validate([
            'name'=>'required|max:255',
            'email'=>'email|required',
            'birth_date'=>'string|required',
            'photo'=>'mimes:jpg,png,svg|max:10240'
        ]);
        $user= $validatedData;
        $pass = Str::random(8);
        $user['pass'] = $pass;
        $user['password'] = Hash::make($pass);
        if($request['admin']){
            $user['role'] = 'admin';
        }
        if($request->file('photo')){
            $file = $request->file('photo');
            $fileName = "user-".time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('images/users', $fileName, 'public');
            $user['photo'] = $path;
        }
        $newUser = User::create($user);
        if($newUser){
            Mail::to($newUser->email)->send(new UserCreatedNotification($user));
            return redirect()->route('user_list')->with(["status"=> "$newUser->name created successfully"]);
        } else {
            return back()->with("error", "Failed to create the User")->withInput();
        }
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
            return redirect()->route('user_list')->with(["status"=>$message]);
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
        return view('admin.user.user_show', ['user'=>$user]);
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
    public function search(){
        if(!($query = null)){
            $query = request()->input('query');
            $user = User::where('name', 'like',"%$query%")->paginate(10);
            return view('admin.user.user_list', ['users'=>$user]);
        } else {
            $message = "No user found";
        }
    }
    
    }
