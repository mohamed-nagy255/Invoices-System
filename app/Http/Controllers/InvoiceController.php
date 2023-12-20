<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\InvoiceDetails;
use App\Models\InvoiceAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InvoiceController extends Controller
{
    public function index () 
    {
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
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
        // return $request;
        Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 1,
            'note' => $request->note,
        ]);

        $invoice_id = Invoice::latest() -> first() -> id;
        InvoiceDetails::create([
            'invoice_id' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 1,
            'note' => $request->note,
            'user' => Auth()->user()->name,
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = Invoice::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new InvoiceAttachment();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth()->user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        return redirect() -> route('invoice.insert') -> with('add', 'تم اضافة الفاتورة بنجاح');
        // return $invoice_id;
    }

    // Edit Invoice
    public function edit ($id)
    {
        $invoice = Invoice::where('id', $id) -> first();
        $sections = Section::all();
        return view('invoices.editInvoice', compact('invoice', 'sections'));
    }

    // Update Invoice 
    public function update (request $request)
    {
        $id = $request -> id;
        $invoice_number = $request->invoice_number;
        
        # Update Invoice
        Invoice::findOrFail($id) -> update([
            'invoice_number' => $invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
        ]);

        # Get Data Details & Attachment
        $invoice_details = InvoiceDetails::where('invoice_id', $id) -> first() -> invoice_number;
        $invoice_attachment = InvoiceAttachment::where('invoice_id', $id) -> first() -> invoice_number;

        # check Invoive Number
        if ($invoice_details != $invoice_number && $invoice_attachment != $invoice_number) {
            # Update Details
            InvoiceDetails::where('invoice_id', $id) -> update([
                'invoice_number' => $invoice_number
            ]);

            # Update Folder Name
            $oldFolderPath = public_path('Attachments/' . $invoice_attachment);
            $newFolderPath = public_path('Attachments/' . $invoice_number);
            if (isset($oldFolderPath)) {
                rename($oldFolderPath, $newFolderPath);
                // echo $oldFolderPath;
                // die();
            }

            # Update Attachment
            InvoiceAttachment::where('invoice_id', $id) -> update([
                'invoice_number' => $invoice_number
            ]);            
        } 
        return redirect() -> back() -> with('edit', 'تم تعديل الفاتورة بنجاح');
    }

    
}
