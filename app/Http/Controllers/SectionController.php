<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function index () {
        $sections = DB::table('sections') -> get();
        return view('sections.index', compact('sections'));
    }

    // Add To DataTable
    public function store (request $request) {
        $validated = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'nullable',
        ],[
            'section_name.required' => 'يجب ادخال اسم القسم',
            'section_name.unique' => 'اسم القسم موجود بالفعل',
            'section_name.max' => 'اسم القسم طويل للغاية',
        ]);
        DB::table('sections') -> insert ([
            'section_name' => $request -> section_name,
            'description' => $request -> description,
        ]);
        return redirect() -> route('section.index') -> with( 'add', 'تم اضافة القسم بنجاح');
    }

    // Update Data
    public function update (request $request) {
        $id = $request -> id;
        $validated = $request->validate([
            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'nullable',
        ],[
            'section_name.required' => 'يجب ادخال اسم القسم',
            'section_name.unique' => 'اسم القسم موجود بالفعل',
            'section_name.max' => 'اسم القسم طويل للغاية',
        ]);
        DB::table('sections') -> where('id', $id) -> update ([
            'section_name' => $request -> section_name,
            'description' => $request -> description,
        ]);
        return redirect() -> route('section.index') -> with( 'edit', 'تم تعديل القسم بنجاح');
    }

    // Delete Data
    public function destroy (request $request) {
        $id = $request -> id;
        DB::table('sections') -> where('id', $id) -> delete();
        return redirect() -> route('section.index') -> with( 'delete', 'تم حذف القسم بنجاح');
    } 
}
