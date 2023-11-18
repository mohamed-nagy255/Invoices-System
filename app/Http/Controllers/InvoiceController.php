<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index () 
    {
        return view('invoices.index');
    }

    // Add Invoice Page 
    public function insert () 
    {
        $sections = Section::all();
        return view('invoices.addInvoice', compact('sections'));
    }

    /* 
    ==============================
    Get Producct's Section In AJAX
    ============================== 
    */
    public function getproducts ($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }

    //Insert Invoice In DataBase
    public function store (request $request)
    {
        return $request;
    }
}
