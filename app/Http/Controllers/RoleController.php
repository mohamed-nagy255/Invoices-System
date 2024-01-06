<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct() {
        $this->middleware('permission:عرض صلاحية', ['only' => ['index']]);
        $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }

    public function index () {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    public function create () {
        $permission = Permission::get();
        return view('role.addRole', compact('permission'));
    }

    public function store (request $request) {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ],[
            'name.required' => 'برجاء ادخال اسم الصلاحية',
            'name.unique' => 'اسم الصلاحية موجود بالفعل',
            'permission.required' => 'برجاء اختيار الصلاحيات',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('role.index')->with('add','تم اضافة الصلاحية بجاح');

    }
}
