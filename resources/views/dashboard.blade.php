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
                                            <i class="fe fe-16 fe-clipboard text-white mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-light mb-0">اجمالي الفواتير</p>
                                        <span class="h3 mb-0 text-white">${{ number_format($invoicies_sum, 2) }}</span>
                                        <div class="d-flex">
                                            <span class="small text-success mr-5">{{ $invoicies }}</span>
                                        </div>
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
                                            <i class="fe fe-16 fe-dollar-sign text-white mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-0">الفواتير المدفوعة</p>
                                        <span class="h3 mb-0">{{ number_format($paid_invoicies_sum, 2) }}</span>
                                        <div class="d-flex">
                                            <span class="small text-success mr-5">{{ $paid_invoicies }}</span>
                                        </div>
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
                                            <i class="fe fe-16 fe-pie-chart text-white mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <p class="small text-muted mb-0">الفواتير المدفوعة جزئياً</p>
                                        <div class="row align-items-center no-gutters">
                                            <div class="col-auto">
                                                <span
                                                    class="h3 mr-2 mb-0">{{ number_format($part_paid_invoicies_sum, 2) }}</span>
                                                <span class="small text-warning mr-5">{{ $part_paid_invoicies }}</span>
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
                                            <i class="fe fe-16 fe-alert-octagon text-white mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <p class="small text-muted mb-0">الفواتير الغير مدفوعة</p>
                                        <span class="h3 mb-0">{{ number_format($un_paid_invoicies_sum, 2) }}</span>
                                        <span class="small text-danger mr-5">{{ $un_paid_invoicies }}</span>
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
                                        <span class="fe fe-32 fe-layers text-muted mb-0"></span>
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
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="">
                            <strong class="card-title">احصائيات الفواتير بالنسبة المئوية</strong>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <canvas id="myChart" style="width:100%;max-width:800px"></canvas>
                            </div>
                            <div class="col-md-12">
                                <div class="row align-items-center my-3">
                                    <div class="col">
                                        <strong>الفواتير المدفوعة</strong>
                                    </div>
                                    <div class="col-auto">
                                        <strong>{{ round($paid_invoices_percentage) }}%</strong>
                                    </div>
                                    <div class="col-3">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ round($paid_invoices_percentage) }}%"
                                                aria-valuenow="{{ round($paid_invoices_percentage) }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center my-3">
                                    <div class="col">
                                        <strong>الفواتير المدفوعة جزئيا</strong>
                                    </div>
                                    <div class="col-auto">
                                        <strong>{{ round($part_paid_invoices_percentage) }}%</strong>
                                    </div>
                                    <div class="col-3">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ round($part_paid_invoices_percentage) }}%"
                                                aria-valuenow="{{ round($part_paid_invoices_percentage) }}"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center my-3">
                                    <div class="col">
                                        <strong>الفواتير الغير المدفوعة</strong>
                                    </div>
                                    <div class="col-auto">
                                        <strong>{{ round($un_paid_invoices_percentage) }}%</strong>
                                    </div>
                                    <div class="col-3">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ round($un_paid_invoices_percentage) }}%"
                                                aria-valuenow="{{ round($un_paid_invoices_percentage) }}"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- .col-md-12 -->
                        </div> <!-- .row -->
                    </div> <!-- .card-body -->
                </div> <!-- .card -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection
@section('js')
    <script>
        var xValues = ["المدفوعة", "المدفوعة جزئياً", "الغير مدفوعة"];
        var yValues = [{{ $paid_invoices_percentage }},
            {{ $part_paid_invoices_percentage }},
            {{ $un_paid_invoices_percentage }}
        ];
        var barColors = [
            "#1b68ff",
            "#20c997",
            "#dc3545",
        ];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: ""
                }
            }
        });
    </script>
@endsection
