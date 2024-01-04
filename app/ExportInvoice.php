<?php
namespace App;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use App\Models\Invoice;

class ExportInvoice implements FromCollection
{
    public function collection()
    { 
        return Invoice::all();
    }
}