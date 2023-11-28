@extends('layouts.master')
@section('title', 'تفاصيل الفاتورة')
@section('css')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row mb-4 items-align-center">
                    <div class="col-md">
                        <h2 class="h3 mb-3 page-title">تفاصيل الفاتورة</h2>
                    </div>
                    {{-- <div class="col-md-auto ml-auto text-right">
                        <a href="{{ route('invoice.insert') }}" type="button" class="btn">
                            <span class="fe fe-plus-square fe-16 text-muted"></span>
                        </a>
                    </div> --}}
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                        role="tab" aria-controls="pills-home" aria-selected="true">معلومات الفاتورة</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                        role="tab" aria-controls="pills-profile" aria-selected="false">حالات الدفع</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                        role="tab" aria-controls="pills-contact" aria-selected="false">المرفقات</a>
                                </li>
                            </ul>
                            <div class="tab-content mb-1" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <table class="table table-striped" style="text-align:center">
                                        <tbody>
                                            <tr>
                                                <th scope="row">رقم الفاتورة</th>
                                                <td>{{ $invoices->invoice_number }}</td>
                                                <th scope="row">تاريخ الاصدار</th>
                                                <td>{{ $invoices->invoice_date }}</td>
                                                <th scope="row">تاريخ الاستحقاق</th>
                                                <td>{{ $invoices->Due_date }}</td>
                                                <th scope="row">القسم</th>
                                                <td>{{ $invoices->sections->section_name }}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">المنتج</th>
                                                <td>{{ $invoices->product }}</td>
                                                <th scope="row">مبلغ التحصيل</th>
                                                <td>{{ $invoices->Amount_collection }}</td>
                                                <th scope="row">مبلغ العمولة</th>
                                                <td>{{ $invoices->Amount_Commission }}</td>
                                                <th scope="row">الخصم</th>
                                                <td>{{ $invoices->Discount }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">نسبة الضريبة</th>
                                                <td>{{ $invoices->Rate_VAT }}</td>
                                                <th scope="row">قيمة الضريبة</th>
                                                <td>{{ $invoices->Value_VAT }}</td>
                                                <th scope="row">الاجمالي مع الضريبة</th>
                                                <td>{{ $invoices->Total }}</td>
                                                <th scope="row">الحالة الحالية</th>
                                                @if ($invoices->Value_Status === 0)
                                                    <td>
                                                        <span class="dot dot-lg bg-success mr-2"></span>
                                                        {{ $invoices->Status }}
                                                    </td>
                                                @elseif ($invoices->Value_Status === 2)
                                                    <td>
                                                        <span class="dot dot-lg bg-warning mr-2"></span>
                                                        {{ $invoices->Status }}
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="dot dot-lg bg-danger mr-2"></span>
                                                        {{ $invoices->Status }}
                                                    </td>
                                                @endif
                                            </tr>

                                            <tr>
                                                <th scope="row">ملاحظات</th>
                                                <td>
                                                    @if ($invoices->note == null)
                                                        لا يوجد ملاحظات
                                                    @else
                                                        {{ $invoices->note }}
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>رقم الفاتورة</th>
                                                <th>المنتج</th>
                                                <th>القسم</th>
                                                <th>حالة الدفع</th>
                                                <th>تاريخ الدفع</th>
                                                <th>ملاحظات</th>
                                                <th>تاريخ الاضافة</th>
                                                <th>المستخدم</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($i = 0)
                                            @foreach ($invoiceDetails as $row)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $row->invoice_number }}</td>
                                                    <td>{{ $row->product }}</td>
                                                    <td>{{ $row->Section }}</td>
                                                    <td>
                                                        @if ($row->Value_Status === 0)
                                                            <span class="dot dot-lg bg-success mr-2"></span>
                                                        @elseif ($row->Value_Status === 2)
                                                            <span class="dot dot-lg bg-warning mr-2"></span>
                                                        @else
                                                            <span class="dot dot-lg bg-danger mr-2"></span>
                                                        @endif
                                                        {{ $row->Status }}
                                                    </td>
                                                    <td>
                                                        @if ($row->Payment_Date == null)
                                                            .. /.. /..
                                                        @else
                                                            {{ $row->Payment_Date }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($row->note == null)
                                                            لا يوجد ملاحظات
                                                        @else
                                                            {{ $invoice->note }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $row->created_at }}</td>
                                                    <td>{{ $row->user }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab"> Anim pariatur cliche reprehenderit, enim eiusmod
                                    high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                    skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                    tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                    shoreditch et. </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
@section('js')

@endsection
