@extends('layouts.master')
@section('title', 'تقارير الفواتير')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row mb-4 items-align-center">
                    <div class="col-md">
                        <h2 class="h3 mb-3 page-title">
                            التقارير
                            <span class="fe-16 text-muted">/ تقارير الفواتير</span>
                        </h2>
                    </div>
                </div>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- row -->
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card mg-b-20">
                                            <div class="card-header pb-0">
                                                <form action="{{ route('report.search') }}" method="POST" role="search"
                                                    autocomplete="off">
                                                    @csrf
                                                    <div class="col-lg-3">
                                                        <label class="rdiobox">
                                                            <input checked name="rdio" type="radio" value="1"
                                                                id="type_div"> <span>بحث بنوع
                                                                الفاتورة</span></label>
                                                    </div>
                                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                                        <label class="rdiobox"><input name="rdio" value="2"
                                                                type="radio">
                                                            <span> بحث برقم الفاتورة </span>
                                                        </label>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                                            <p class="mg-b-10">تحديد نوع الفواتير</p>
                                                            <select class="form-control select2" name="type" required>
                                                                <option value="{{ $type ?? 'حدد نوع الفواتير' }}" selected>
                                                                    {{ $type ?? 'حدد نوع الفواتير' }}
                                                                </option>
                                                                <option value="مدفوعة">الفواتير المدفوعة</option>
                                                                <option value="غير مدفوعة">الفواتير الغير مدفوعة</option>
                                                                <option value="مدفوعة جزئيا">الفواتير المدفوعة جزئيا
                                                                </option>
                                                            </select>
                                                        </div><!-- col-4 -->
                                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="invoice_number">
                                                            <p class="mg-b-10">البحث برقم الفاتورة</p>
                                                            <input type="text" class="form-control" id="invoice_number"
                                                                name="invoice_number">
                                                        </div><!-- col-4 -->
                                                        <div class="col-lg-3" id="start_at">
                                                            <label for="exampleFormControlSelect1">من تاريخ</label>
                                                            <div class="input-group">
                                                                <input class="form-control fc-datepicker"
                                                                    value="{{ $start_at ?? '' }}" name="start_at"
                                                                    placeholder="YYYY-MM-DD" type="date">
                                                            </div><!-- input-group -->
                                                        </div>
                                                        <div class="col-lg-3" id="end_at">
                                                            <label for="exampleFormControlSelect1">الي تاريخ</label>
                                                            <div class="input-group">
                                                                <input class="form-control fc-datepicker" name="end_at"
                                                                    value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD"
                                                                    type="date">
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div><br>
                                                    <div class="row mb-4">
                                                        <div class="col-sm-3 col-md-3">
                                                            <button class="btn btn-primary btn-block">بحث</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    @if (isset($details))
                                                        <table id="example" class="table key-buttons text-md-nowrap"
                                                            style=" text-align: center">
                                                            <thead>
                                                                <tr>
                                                                    <th class="border-bottom-0">#</th>
                                                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                                                    <th class="border-bottom-0">تاريخ القاتورة</th>
                                                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                                                    <th class="border-bottom-0">المنتج</th>
                                                                    <th class="border-bottom-0">القسم</th>
                                                                    <th class="border-bottom-0">الخصم</th>
                                                                    <th class="border-bottom-0">نسبة الضريبة</th>
                                                                    <th class="border-bottom-0">قيمة الضريبة</th>
                                                                    <th class="border-bottom-0">الاجمالي</th>
                                                                    <th class="border-bottom-0">الحالة</th>
                                                                    <th class="border-bottom-0">ملاحظات</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php($i = 0)
                                                                @foreach ($details as $invoice)
                                                                    <tr>
                                                                        <td>{{ $i++ }}</td>
                                                                        <td>{{ $invoice->invoice_number }} </td>
                                                                        <td>{{ $invoice->invoice_date }}</td>
                                                                        <td>{{ $invoice->Due_date }}</td>
                                                                        <td>{{ $invoice->product }}</td>
                                                                        <td>
                                                                            <a
                                                                                href="{{ route('details.index', $invoice->id) }}">
                                                                                {{ $invoice->sections->section_name }}
                                                                            </a>
                                                                        </td>
                                                                        <td>{{ $invoice->Discount }}</td>
                                                                        <td>{{ $invoice->Rate_VAT }}</td>
                                                                        <td>{{ $invoice->Value_VAT }}</td>
                                                                        <td>{{ $invoice->Total }}</td>
                                                                        <td>
                                                                            @if ($invoice->Value_Status == 0)
                                                                                <span
                                                                                    class="text-success">{{ $invoice->Status }}</span>
                                                                            @elseif($invoice->Value_Status == 1)
                                                                                <span
                                                                                    class="text-danger">{{ $invoice->Status }}</span>
                                                                            @else
                                                                                <span
                                                                                    class="text-warning">{{ $invoice->Status }}</span>
                                                                            @endif

                                                                        </td>

                                                                        <td>{{ $invoice->note }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- row closed -->
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#invoice_number').hide();
            $('input[type="radio"]').click(function() {
                if ($(this).attr('id') == 'type_div') {
                    $('#invoice_number').hide();
                    $('#type').show();
                    $('#start_at').show();
                    $('#end_at').show();
                } else {
                    $('#invoice_number').show();
                    $('#type').hide();
                    $('#start_at').hide();
                    $('#end_at').hide();
                }
            });
        });
    </script>
@endsection
