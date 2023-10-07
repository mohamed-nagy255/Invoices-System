<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index () 
    {
        return view('invoices.index');
    }

    public function insert () 
    {
        $sections = Section::all();
        return view('invoices.addInvoice', compact('sections'));
    }
}
