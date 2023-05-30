<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Datatables;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class RolesController extends Controller
{
    Public function index()
    {

        if(request()->ajax()){
            
            // dd("in");
            $roles=Role::all();
            // dd($roles);
    
            return datatables()->of($roles)->addColumn('action',function($data){
                if(auth()->user()->can('role-edit')){
                $display_edit='';
                }else{
                    $display_edit='d-none';
                }

    // dd($display_edit);
            return '<div class="actions">
                
                   <a class="text-black '.$display_edit.'" href="'.route('roles.edit',$data->id).'">
                       <i class="feather-edit-3 me-1"></i> Edit
                   </a>
                   <a class="text-danger" href="'.route('roles.destroy',$data->id).'">
                       <i class="feather-trash-2 me-1"></i> Delete
                   </a>
                 
                   
                  
               </div>';
            })->make(true);
    
        }
        // $count= Role::count();
        // return view ('roles.index',compact('count'))->with('roles');

        return view('roles.index');
    }

    public function create()
    {
        // $all_permissions  = Permission::all();
        // $permission_groups = User::all(); ,compact('all_permissions','permission_groups')
        // $roles = Role::get();
        // $rolePermissions = $roles->permissions()
        //                             ->pluck('id')
        //                             ->toArray();
        $permissions = Permission::get();
        // dd($permissions);
        return view('roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->name]);
        if($request->has('permission') && !empty($request->permission)){
            $role->syncPermissions($request->input('permission'));
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        // $roles = Role::find($id);
        $roles = Role::find($id);
        $rolePermissions = $roles->permissions()
                                    ->pluck('id')
                                    ->toArray();
        $permissions = Permission::select('id','name')->orderBy('created_at','asc')->get();
        // dd($roles);
        return view('roles.edit',compact('roles','rolePermissions','permissions'));
    }

    public function update(Request $request, $id)
    {
        
        $roles = Role::find($id); 
        // dd($roles);
        $roles->name = $request->name;

        $roles->save();
        
        $roles->syncPermissions($request->input('permissions'));

        if(!$roles){
            return redirect()->back()->with('error', 'Something went wrong');
        }

        // $roles->update(['name' => $request->name]);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }


    public function show()
    {

    }

    public function destroy($id)
    {

        $roles = Role::find($id);
        $roles->delete($id);
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');


        // return response()->json(['status' => 1],500);


     }


}
