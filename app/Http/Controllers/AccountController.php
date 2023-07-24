<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index(){
        if(auth()->user()->role_id!=1){
            $data['accounts']=User::where('role_id',3)->get();
        }else{

            $data['accounts']=User::all();
        }
    return view('account.index',$data);
    }
   
    public function create(){
        $data['roles']=Role::all();
        if(auth()->user()->role_id!=1){
            $data['roles']=Role::where('id',3)->get();
        }
    
     return view('account.create',$data);  
    }
   
    public function store(Request $request) {
        $status='danger';
        $message='Create Account UnSuccessful';

        $request->validate([ 
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'confirmed']]);
        
        $create= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id'=>$request->role
        ]);
        if($create)
        {
            $status='success';
            $message='Create Account Successfully';
        }
        
        return redirect('admin/account')->with('status',$status)->with('message',$message);
    }
   
    public function edit(User $user){
        $data['account']=$user;
        $data['roles']=Role::all();
        if(auth()->user()->role_id!=1){
            $data['roles']=Role::where('id',3)->get();
        }
        return view('account.edit',$data);
    }
   
    public function update(User $user,Request $request){
        $status='danger';
        $message='Create Account UnSuccessful';

        $request->validate([ 
            'name' => ['required', 'string', 'max:255'],
        ]);

        if($request->password!=null)
        {
            $request->validate(['password' => ['required', 'string', 'confirmed']]);
            $user->update(['password'=> Hash::make($request->password)]);
        }
        
        if($request->email!=$user->email)
        {
            $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            $user->update(['email'=> $request->email]);
        }

        $update=$user->update(['name'=>$request->name,'role_id'=>$request->role]);
        if($update)
        {
            $status='success';
            $message='Create Account Successfully';
        }
        
        return redirect('admin/account')->with('status',$status)->with('message',$message);
    }
    public function detail(User $user){
         $data['account']=$user;
        return view('account.detail',$data);
    }
   
    public function delete(User $user){
        $status='danger';
        $message='Process unsuccess';
        $create= $user->delete();
        if($create){
            $status='success';
            $message='Delete User Succesfully';
        }
        return redirect('admin/account')->with('status',$status)->with('message',$message);
    }   
    }
