@extends('layouts.master')
@section('title', 'لوحة التحكم')
@section('css')
    <style>
        a {
            text-decoration: none !important;
        }
    </style>
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h1 class="h2 page-title">اهلا بك !</h1>
                    </div>
                </div>
                <div class="row">
                    <a href="{{ route('invoice.index', $id_page = 'invoice_all') }}" class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow bg-primary text-white">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-primary-light">
                                            <i class="fe fe-16 fe-shopping-bag text-white mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-light mb-0">اجمالي عدد الفواتير</p>
                                        <span class="h3 mb-0 text-white">{{ $invoicies }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('invoice.index', $id_page = 'paid_invoice') }}" class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-primary">
                                            <i class="fe fe-16 fe-shopping-cart text-white mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-0">الفواتير المدفوعة</p>
                                        <span class="h3 mb-0">{{ $paid_invoicies }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('invoice.index', $id_page = 'partpaid_invoice') }}" class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-primary">
                                            <i class="fe fe-16 fe-filter text-white mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <p class="small text-muted mb-0">الفواتير المدفوعة جزئياً</p>
                                        <div class="row align-items-center no-gutters">
                                            <div class="col-auto">
                                                <span class="h3 mr-2 mb-0">{{ $part_paid_invoicies }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('invoice.index', $id_page = 'unpaid_invoice') }}" class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-primary">
                                            <i class="fe fe-16 fe-activity text-white mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <p class="small text-muted mb-0">الفواتير الغير مدفوعة</p>
                                        <span class="h3 mb-0">{{ $un_paid_invoicies }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> <!-- end section -->
                <!-- info small box -->
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <span class="h2 mb-0">{{ $sections }}</span>
                                        <p class="small text-muted mb-0">عدد المنتاجات</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-shopping-bag text-muted mb-0"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <span class="h2 mb-0">{{ $products }}</span>
                                        <p class="small text-muted mb-0">عدد الاقسام</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-clipboard text-muted mb-0"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <span class="h2 mb-0">{{ $users }}</span>
                                        <p class="small text-muted mb-0">عدد مستخدمين البرنامج</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fe fe-32 fe-users text-muted mb-0"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection
@section('js')

@endsection
