<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Arr;


class UserController extends Controller
{ public function index(){

    // $user = User::with('roles')->get();
    // dd($user);
    // dd($user->getRoleNames());
    if(request()->ajax()){
            
        // dd("in");
        // $users=User::all();
        $users = User::with('roles')->get();
        // dd($roles);

        return datatables()->of($users)->addColumn('action',function($data){

        return '<div class="actions">
               <a class="text-black" href="'.route('users.edit',$data->id).'">
                   <i class="feather-edit-3 me-1"></i> Edit
               </a>
               <a class="text-danger" href="'.url("users/destroy").'/'.$data->id.'">
                   <i class="feather-trash-2 me-1"></i> Delete
               </a>

           </div>';
        })->make(true);

    }
    // $count= Role::count();
    // return view ('roles.index',compact('count'))->with('roles');

    return view('users.index');
}
    

public function create()
{
    $roles = Role::select('name','id')->get();
    // dd($roles );
    return view('users.create',compact('roles'));
}

public function store(Request $request)
{
    $users= new User;
    $users->name = $request->name;
    $users->email = $request->email;
    $users->password = Hash::make($request->password);
    // dd($users->password);
    $users->assignRole($request->input('roles'));
    $users->save();
    // dd($users);

    // $users = User::create(['name' => $request->name,
    // 'email'=> $request->email,
    // 'password'=> Hash::make($request->password)]);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}

public function edit($id)
{
    $users=User::find($id);
    $roles = Role::select('name','id')->get();
    // $userRole = $users->roles
    // dd($userRole);
    return view('users.edit',compact('users','roles'));
}

public function update(Request $request , $id)
{
    $users=User::find($id);
    $users->name = $request->name;
    $users->email = $request->email;
    if($request->has('password') && !empty($request->password)){
    $users->password = Hash::make($request->password);
    }
    DB::table('model_has_roles')->where('model_id',$id)->delete();
    $users->assignRole($request->input('roles'));
    $users->save();

    return redirect()->route('users.index')
                        ->with('success','User updated successfully');

}
// public function show($id)
// {
//     return view('users.show');
// }

public function destroy($id)
{
    // dd("id");
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('users.index')->with('success', 'User deleted successfully');
}

}
