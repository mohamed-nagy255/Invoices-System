<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceArchiveController extends Controller
{
    //Invoice Archive
    public function show () {
        $invoices = Invoice::onlyTrashed() -> get();
        return view('invoices.archiveInvoice', compact('invoices'));
    }

    //Archive recovery
    public function recovery ($id) {
        Invoice::where('id', $id) -> restore();
        return redirect() -> back() -> with('done', 'تم الغاء الارشفة الفاتورة بنجاح');
    }
}
