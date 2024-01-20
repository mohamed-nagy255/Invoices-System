<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustemorReportController extends Controller
{
    public function index () {
        return view('reports.custemorReport');
    }
}
