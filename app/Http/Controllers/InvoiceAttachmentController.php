<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceAttachment;
use Spatie\Permission\Models\Permission;


class InvoiceAttachmentController extends Controller
{
   function __construct() {
      $this->middleware('permission:اضافة مرفق', ['only' => ['create','store']]);
  }

   public function store (request $request)
   {
      $invoice_id = $request -> invoice_id;
      $invoice_number = $request -> invoice_number;
      $attachments = $request -> file('file_name');
      $user = auth() -> user() -> name;
      
      if ($attachments)
      {
         foreach ($attachments as $row) {
            $file_name = $row->getClientOriginalName();
           
            InvoiceAttachment::create([
               'file_name' => $file_name,
               'invoice_id' => $invoice_id,
               'invoice_number' => $invoice_number,
               'Created_by' => $user,
           ]);
            
            $imageName = $row->getClientOriginalName();
            $row->move(public_path('Attachments/' . $invoice_number), $imageName);
         }
      }
       return redirect() -> back() -> with('add', 'تم اضافة المرفقات بنجاح'); 
   }
}
