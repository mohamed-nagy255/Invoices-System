<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\InvoiceDetails;
use App\Models\InvoiceAttachment;
use Illuminate\Support\Facades\Storage;

class InvoiceDetailsController extends Controller
{
    public function index ($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        $invoiceDetails = InvoiceDetails::where('invoice_id', $id)->get();
        $invoiceAttachments = InvoiceAttachment::where('invoice_id', $id)->get();
        return view('invoices.invoiceDetails', compact('invoices', 'invoiceDetails', 'invoiceAttachments'));
    }

    public function destroy (request $request) 
    {
        // return $request;
        $id = $request -> id;
        $file_name = $request -> file_name;
        $invoice_number = $request -> invoice_number;
        InvoiceAttachment::where('id', $id)->delete();
        $file_path = public_path('Attachments/' . $invoice_number . '/' . $file_name);
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        return redirect()->back()->with('delete', 'تم حذف المرفق بنجاح');
    }

    public function open_file ($invoice_number, $file_name)
    {
        // $filePath = Storage::disk('public_uploads')->path($invoice_number.'/'.$file_name);
        $filePath = public_path('/Attachments/' . $invoice_number . '/' . $file_name);
        return response()->file($filePath);
    }

    public function get_file ($invoice_number, $file_name)
    {
        $filePath = public_path('/Attachments/' . $invoice_number . '/' . $file_name);
        return response()->download($filePath);
    }
}
