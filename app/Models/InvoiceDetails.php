<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;
    protected $table = 'invoice_details';
    protected $fillable = [
        'invoice_id',
        'invoice_number',
        'product',
        'Section',
        'Status',
        'Value_Status',
        'Payment_Date',
        'note',
        'user',
    ];
}
