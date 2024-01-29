<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function list(){

        $users  =   User::where('id','!=',Auth::user()->id)->paginate(25);
        
        return view('user.roles.index', compact('users') );
    }

    public function edit($id){

        if(Auth::user()->id == $id){

            return redirect()->route('users.list')->with('error','User can not assign role itself');

        }else{

            $user   =   User::where('id',$id)->first();
            $title  =   'Update User';
            $route  =   'users.update';
            $roles  =   Role::all();

            return view('user.roles.edit', compact('user','title','route','roles'));
        }
        
        
    }

    public function update(Request $request){
        
        $user    =   User::find($request->id);

        // Find the role by its ID
        $role = Role::find($request->role);
        
        if ($user && $role) {
            // Sync the user's roles with the selected role
            $user->syncRoles([$role->name]);
    
            // Additional logic or response
            return redirect()->route('users.list')->with('success', 'Role updated successfully.');
        } else {
            // User or role not found
            return redirect()->route('users.list')->with('error', 'User or role not found.');
        }
    }
    
}
