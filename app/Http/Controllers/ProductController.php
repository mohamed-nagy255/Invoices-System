<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index () {
        $products = Product::all();
        $sections = Section::all();
        return view('products.index', compact('products', 'sections'));
    }

    // Insert Data
    public function store (request $request) {
        $validated = $request->validate([
            'product_name' => 'required|unique:products|max:255',
            'section_id' => 'integer',
            'description' => 'nullable',
        ],[
            'product_name.required' => 'يجب ادخال اسم المنتج',
            'product_name.unique' => 'اسم المنتج موجود بالفعل',
            'product_name.max' => 'اسم المنتج طويل للغاية',
            'section_id.integer' => 'يجب اختيار اسم القسم التابع لهذا المنتج',
        ]);
        DB::table('products') -> insert ([
            'product_name' => $request -> product_name,
            'section_id' => $request -> section_id,
            'description' => $request -> description,
        ]);
        return redirect() -> route('product.index') -> with('add', 'تم اضافة المنتج بنجاح');
    }

    // Update Data
    public function update (request $request) {
        $id = $request -> id;
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'section_id' => 'integer',
            'description' => 'nullable',
        ],[
            'product_name.required' => 'يجب ادخال اسم المنتج',
            // 'product_name.unique' => 'اسم المنتج موجود بالفعل',
            'product_name.max' => 'اسم المنتج طويل للغاية',
            'section_id.integer' => 'يجب اختيار اسم القسم التابع لهذا المنتج',
        ]);
        DB::table('products') -> where('id', $id) -> update ([
            'product_name' => $request -> product_name,
            'section_id' => $request -> section_id,
            'description' => $request -> description,
        ]);
        return redirect() -> route('product.index') -> with('edit', 'تم تعديل المنتج بنجاح');
        // return $request;
    }

    // Delete Data
    public function destroy (request $request) {
        $id = $request -> id;
        DB::table('products') -> where('id', $id) -> delete();
        return redirect() -> route('product.index') -> with('delete', 'تم حذف المنتج بنجاح');
    } 
}
