<?php

namespace App\Http\Controllers\UserRoles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{

    //prevent anyone go to roles pages throughout the write roles routes in URL-> only people who have these permissions can reach to it

    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //get all roles and return it to role page
        $roles = Role::all();
        return view('roles.index',compact('roles'));
    }

    public function create()
    {
        //return to  create permissions page
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        //get request come from create role page and add role name to role table
        $role = Role::create(['name' => $request->input('name')]);
        // Give the selected permissions to this role
        $role->syncPermissions($request->input('permission'));

        session()->flash('add', 'Role Added Successfully');
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        //select role with id and get his permissions ->take it to edit role page
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.edit',compact('role','permission','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        //select role name
        $name = Role::select('name')->where('id', $id)->first()->name;
        //validation on request input
        $this->validate($request, [
            'name' => 'unique:roles,name,'.$id,
            'permission' => 'required',
        ]);
        //get role by id and role name ->save it
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        // update permissions belong to this role
        $role->syncPermissions($request->input('permission'));

        session()->flash('edit', 'Role Updated Successfully');
        return redirect()->route('roles.index');
    }

    public function destroy(Request $request)
    {
        //select role with id and delete it
        DB::table("roles")->where('id',$request->id)->delete();
        session()->flash('delete', 'Role Updated Successfully');
        return redirect()->route('roles.index');
    }
}
