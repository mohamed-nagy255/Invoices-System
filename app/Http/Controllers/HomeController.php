<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        $invoicies = Invoice::all()->count();
        $paid_invoicies = Invoice::where('Value_Status', '===', 0)->count();
        $part_paid_invoicies = Invoice::where('Value_Status', '===', 2)->count();
        $un_paid_invoicies = Invoice::where('Value_Status', '===', 1)->count();
        $sections = Section::all()->count();
        $products = Product::all()->count();
        $users = User::all()->count();
        return view('dashboard',
                    compact (
                        'invoicies',
                        'paid_invoicies',
                        'part_paid_invoicies',
                        'un_paid_invoicies',

                        'sections',
                        'products',
                        'users',
                    )
                ); 
    }
}
