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
        $invoicies = Invoice::count();
        $invoicies_sum = Invoice::sum('Total');
        $paid_invoicies = Invoice::where('Value_Status', 0)->count();
        $paid_invoicies_sum = Invoice::where('Value_Status', 0)->sum('Total');
        $part_paid_invoicies = Invoice::where('Value_Status', 2)->count();
        $part_paid_invoicies_sum = Invoice::where('Value_Status', 2)->sum('Total');
        $un_paid_invoicies = Invoice::where('Value_Status', 1)->count();
        $un_paid_invoicies_sum = Invoice::where('Value_Status', 1)->sum('Total');
        $paid_invoices_percentage = ($paid_invoicies / $invoicies) * 100;
        $part_paid_invoices_percentage = ($part_paid_invoicies / $invoicies) * 100;
        $un_paid_invoices_percentage = ($un_paid_invoicies / $invoicies) * 100;
        $sections = Section::count();
        $products = Product::count();
        $users = User::count();
        return view('dashboard',
                    compact (
                        'invoicies',
                        'invoicies_sum',
                        'paid_invoicies',
                        'paid_invoicies_sum',
                        'part_paid_invoicies',
                        'part_paid_invoicies_sum',
                        'un_paid_invoicies',
                        'un_paid_invoicies_sum',
                        'paid_invoices_percentage',
                        'part_paid_invoices_percentage',
                        'un_paid_invoices_percentage',

                        'sections',
                        'products',
                        'users',
                    )
                ); 
    }
}
