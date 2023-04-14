<?php

namespace App\Http\Controllers\UserRoles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    //prevent anyone go to users pages throughout the write users routes in URL-> only people who have these permissions can reach to it

    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        //get all users and return it to users page
        $data = User::all();
        return view('users.index',compact('data'));
    }

    public function create()
    {
        //get all roles name and return it to  create user page
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        //validation on request input
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'same:confirm-password',
            'roles' => 'required'],
            );

        $input = $request->all();
        //hash password
        $input['password'] = Hash::make($input['password']);
        // add user to database
        $user = User::create($input);
        //assign roles to user
        $user->assignRole($request->input('roles'));
        session()->flash('add', 'User Added Successfully');
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        //get user with his roles
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        //validation on request input
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'],
        );

        $input = $request->all();
        //hash password
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }
        //get user by id and update it in database
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        session()->flash('edit', 'User Updated Successfully');
        return redirect()->route('users.index');
    }

    public function destroy(Request $request)
    {
        //select user with id and delete it
        User::find($request->id)->delete();
        session()->flash('delete', 'User Deleted Successfully');
        return redirect()->route('users.index');
    }
}
