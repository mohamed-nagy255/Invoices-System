<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index () {
        $users = User::all();
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

}
