@extends('layouts.master')
@section('title', 'قائمة الفواتير')
@section('css')
        
@endsection
@section('content')
            <div class="container-fluid">
                <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row mb-4 items-align-center">
                        <div class="col-md">
                            <h2 class="h3 mb-3 page-title">قائمة الفواتير</h2>
                        </div>
                    <div class="col-md-auto ml-auto text-right">
                        <button type="button" class="btn">
                            <span class="fe fe-refresh-ccw fe-16 text-muted"></span>
                        </button>
                        <a href="{{ route('invoice.insert') }}" type="button" class="btn">
                            <span class="fe fe-plus-square fe-16 text-muted"></span>
                        </a>
                    </div>
                    </div>
                    <table class="table datatables" id="dataTable-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>رقم الفاتورة</th>
                                <th>تاريخ القاتورة</th>
                                <th>تاريخ الاستحقاق</th>
                                <th>المنتج</th>
                                <th>القسم</th>
                                <th>الخصم</th>
                                <th>نسبة الضريبة</th>
                                <th>قيمة الضريبة</th>
                                <th>الاجمالي</th>
                                <th>ملاحظات</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1573</td>
                                <td>2020-01-14 01:04:42</td>
                                <td>Bryar Reilly</td>
                                <td>(873) 448-3021</td>
                                <td>745-3818 Vitae, Ave</td>
                                <td>$2.06</td>
                                <td>Credit Card </td>
                                <td>$2.06</td>
                                <td>Credit Card </td>
                                <td>$2.06</td>
                                <td>Credit Card </td>
                                <td><span class="dot dot-lg bg-success mr-2"></span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted sr-only">Action</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Remove</a>
                                            <a class="dropdown-item" href="#">Assign</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
@endsection
@section('js')
        <script src='{{ asset('assets/js/jquery.dataTables.min.js') }}'></script>
        <script src='{{ asset('assets/js/dataTables.bootstrap4.min.js') }}'></script>
        <script>
            $('#dataTable-1').DataTable(
            {
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
            });
        </script>
@endsection