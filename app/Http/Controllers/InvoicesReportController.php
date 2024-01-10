<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesReportController extends Controller
{
    public function index () {
        return view('reports.invoicesReport');
    }

    public function search (request $request) {
        $rdio = $request->rdio;
        $type = $request->type;
        if ($rdio == 1) {   
            if ($request->type && $request->start_at =='' && $request->end_at =='') {
                $invoices = Invoice::select('*')->where('Status','=',$type)->get();
                return view('reports.invoicesReport',compact('type'))->withDetails($invoices);
            } else { 
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $invoices = Invoice::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
                return view('reports.invoicesReport',compact('type','start_at','end_at'))->withDetails($invoices);
            }
        } else {
            $invoices = Invoice::select('*')->where('invoice_number','=',$request->invoice_number)->get();
            return view('reports.invoicesReport')->withDetails($invoices);
        }
    
    }
}
