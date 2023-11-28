<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\InvoiceDetails;

class InvoiceDetailsController extends Controller
{
    public function index ($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        $invoiceDetails = InvoiceDetails::where('invoice_id', $id)->get();
        return view('invoices.invoiceDetails', compact('invoices', 'invoiceDetails'));
    }
}
