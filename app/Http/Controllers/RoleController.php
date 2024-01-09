<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function show ($id) {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)->get();
        return view('role.show',compact('role','rolePermissions'));
    }

    public function edit ($id) {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();
        return view('role.edit',compact('role','permission','rolePermissions'));
    }

    public function update (Request $request, $id) {
        $this->validate($request, [
        'name' => 'required',
        'permission' => 'required',
        ],[
            'name.required' => 'برجاء كتابة اسم الصلاحية',
            'permission.required' => 'برجاء اختيار صلاحية',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('role.index')->with('update','تم تعديل الصلاحية بنجاح');
    }

    public function destroy ($id) {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('role.index')->with('delete','تم حذف الصلاحية بنجاح');
    }
}
