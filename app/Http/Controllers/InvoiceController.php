<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\InvoiceDetails;
use App\Models\InvoiceAttachment;
use App\Notifications\AddInvoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;

class InvoiceController extends Controller
{
    public function index ($id_page) {
        if ($id_page == 'invoice_all') {
            $invoices = Invoice::all();
            return view('invoices.index', compact('invoices'));
        } elseif ($id_page == 'paid_invoice') {
            $invoices = Invoice::where('Value_Status', 0) -> get();
            return view('invoices.index', compact('invoices'));
        } elseif ($id_page == 'partpaid_invoice') {
            $invoices = Invoice::where('Value_Status', 2) -> get();
            return view('invoices.index', compact('invoices'));
        } elseif ($id_page == 'unpaid_invoice') {
            $invoices = Invoice::where('Value_Status', 1) -> get();
            return view('invoices.index', compact('invoices'));
        }
    }

    // Add Invoice Page 
    public function insert () {
        $sections = Section::all();
        return view('invoices.addInvoice', compact('sections'));
    }

    /* 
    ==============================
    Get Producct's Section In AJAX
    ============================== 
    */
    public function getproducts ($id) {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }

    //Insert Invoice In DataBase
    public function store (request $request) {
        // return $request;
        $validated = $request->validate([
            'invoice_number' => 'required|unique:invoices|max:255',
        ],[
            'invoice_number.unique' => 'رقم الفاتورة موجود بالفعل', 
        ]);
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
        // $user = User::first();
        // Notification::send($user , new AddInvoice($invoice_id));
        Notification::route('mail', 'mohamednagy767@gmail.com')->notify(new AddInvoice($invoice_id));;
        return redirect() -> route('invoice.insert') -> with('add', 'تم اضافة الفاتورة بنجاح');
    }

    // Edit Invoice
    public function edit ($id) {
        $invoice = Invoice::where('id', $id) -> first();
        $sections = Section::all();
        return view('invoices.editInvoice', compact('invoice', 'sections'));
    }

    // Update Invoice 
    public function update (request $request)
    {
        $id = $request -> id;
        $invoice_number = $request->invoice_number;

        $validated = $request->validate([
            'invoice_number' => 'required|unique:invoices,invoice_number,'.$id,
        ],[
            'invoice_number.unique' => 'رقم الفاتورة موجود بالفعل', 
        ]);
        
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
        $invoice_attachment = InvoiceAttachment::where('invoice_id', $id) -> pluck('invoice_number') -> first();
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

    //Delete OR Archive Invoice
    public function destroy (request $request) {
        $id = $request -> id;
        $invoice_number = $request -> invoice_number;
        $del_id = $request -> del_id;

        if ($del_id != "archive") {
            #Delete Invoice Attachment
            $dir_path = public_path('Attachments/' . $invoice_number);
            if (is_dir($dir_path)) {
                $file_names = InvoiceAttachment::where('invoice_id', $id) -> pluck('file_name') -> toArray();
                foreach ($file_names as $file) {
                    $file_path = $dir_path . '/' . $file;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
                $files_in_dir = scandir($dir_path);
                if (count($files_in_dir) == 2) {
                    rmdir($dir_path);
                }
            }
            InvoiceAttachment::where('invoice_id', $id) -> delete();
            #Delete Invoice
            Invoice::where('id', $id) -> forcedelete();
            #Delete Invoice Details
            InvoiceDetails::where('invoice_id', $id) -> delete();
            return redirect() -> back() -> with('delete', 'تم حذف الفاتورة بنجاح');
        } else {
            Invoice::findOrFail($id) -> delete();
            return redirect() -> back() -> with('archive', 'تم ارشفة الفاتورة بنجاح');
        }
    }

    ################################
    ######## Change Payment ########
    ################################
    public function show ($id) {
        $invoice = Invoice::where('id', $id) -> first();
        $sections = Section::all();
        return view('invoices.changePayment', compact('invoice', 'sections'));
    }
    public function status_update (request $request) {
        $id = $request -> id;
        $Payment_Date = $request->Payment_Date;
        $invoices = Invoice::findOrFail($id);
        // return $Payment_Date;
        if ($request->Status === 'مدفوعة') {
            $invoices->update([
                'Value_Status' => 0,
                'Status' => $request->Status,
                'Payment_Date' => $Payment_Date,
            ]);
            InvoiceDetails::create([
                'invoice_id' => $id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 0,
                'Payment_Date' => $Payment_Date,
                'note' => $request->note,
                'user' => Auth()->user()->name,
            ]);
            return redirect() -> back() -> with('pay', 'تم تغيير حالة دفع الفاتورة بنجاح');
        } elseif ($request->Status === 'مدفوعة جزئياً') {
            $invoices->update([
                'Value_Status' => 2,
                'Status' => $request->Status,
                'Payment_Date' => $Payment_Date,
            ]);
            InvoiceDetails::create([
                'invoice_id' => $id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 2,
                'Payment_Date' => $Payment_Date,
                'note' => $request->note,
                'user' => Auth()->user()->name,
            ]);
            return redirect() -> back() -> with('pay', 'تم تغيير حالة دفع الفاتورة بنجاح');
        } else {
            return redirect() -> back() -> with('not', ' لم يتم تغيير حالة دفع الفاتورة بنجاح');
        }
    }
}
