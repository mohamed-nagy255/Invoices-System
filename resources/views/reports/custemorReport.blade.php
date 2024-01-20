@extends('layouts.master')
@section('title', 'تقارير العملاء')
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
                            <span class="fe-16 text-muted">/ تقارير العملاء</span>
                        </h2>
                    </div>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>خطا</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- row -->
                <div class="row">

                    <div class="col-xl-12">
                        <div class="card mg-b-20">


                            <div class="card-header pb-0">

                                <form action="{{ route('custemorReport.search') }}" method="POST" role="search"
                                    autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <label for="inputName" class="control-label">القسم</label>
                                            <select name="Section" class="form-control select2"
                                                onclick="console.log($(this).val())"
                                                onchange="console.log('change is firing')">
                                                <!--placeholder-->
                                                <option value="" selected disabled>حدد القسم</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}"> {{ $section->section_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                            <label for="inputName" class="control-label">المنتج</label>
                                            <select id="product" name="product" class="form-control select2">
                                            </select>
                                        </div>
                                        <div class="col-lg-3" id="start_at">
                                            <label for="exampleFormControlSelect1">من تاريخ</label>
                                            <div class="input-group">
                                                <input class="form-control" value="{{ $start_at ?? '' }}" name="start_at"
                                                    placeholder="YYYY-MM-DD" type="date">
                                            </div><!-- input-group -->
                                        </div>
                                        <div class="col-lg-3" id="end_at">
                                            <label for="exampleFormControlSelect1">الي تاريخ</label>
                                            <div class="input-group">
                                                <input class="form-control" name="end_at" value="{{ $end_at ?? '' }}"
                                                    placeholder="YYYY-MM-DD" type="date">
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-1 col-md-1">
                                            <button class="btn btn-primary btn-block">بحث</button>
                                        </div>
                                    </div>
                                    <br>
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
                                                            <a href="{{ route('details.index', $invoice->id) }}">
                                                                {{ $invoice->sections->section_name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $invoice->Discount }}</td>
                                                        <td>{{ $invoice->Rate_VAT }}</td>
                                                        <td>{{ $invoice->Value_VAT }}</td>
                                                        <td>{{ $invoice->Total }}</td>
                                                        <td>
                                                            @if ($invoice->Value_Status == 0)
                                                                <span class="text-success">{{ $invoice->Status }}</span>
                                                            @elseif($invoice->Value_Status == 1)
                                                                <span class="text-danger">{{ $invoice->Status }}</span>
                                                            @else
                                                                <span class="text-warning">{{ $invoice->Status }}</span>
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
                </div>
                <!-- row closed -->
            </div>
            <!-- Container closed -->
        </div>
        <!-- main-content closed -->
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
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
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
    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
