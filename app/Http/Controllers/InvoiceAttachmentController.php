<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceAttachmentController extends Controller
{
    protected $table = 'invoice_attachments';
    protected $fillable = [
        'file_name',
        'invoice_id',
        'invoice_number',
        'Created_by',
    ];
}
