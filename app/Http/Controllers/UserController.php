<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index () {
        $users = User::orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function create () {
        $roles = Role::pluck('name','name')->all();
        return view('users.addUser',compact('roles'));
    }

    public function store (Request $request) {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm-password',
        'role_name' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('role_name'));
        return redirect()->route('user.index')->with('add','تم اضافة المستخدم بنجاح');
    }

    public function show ($id) {
        $user = User::find($id);
        return view('users.showUser',compact('user'));
    }

    public function edit ($id) {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.editUser',compact('user','roles','userRole'));
    }

    public function update (Request $request, $id) {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'same:confirm-password',
        'roles' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
        $input['password'] = Hash::make($input['password']);
        }else{
        $input = array_except($input,array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('user.index')->with('edit','تم تحديث معلومات المستخدم بنجاح');
    }

    public function destroy (Request $request) {
        // return $request;
        User::find($request->id)->delete();
        return redirect()->route('user.index')->with('delete','تم حذف المستخدم بنجاح');
    }

}
