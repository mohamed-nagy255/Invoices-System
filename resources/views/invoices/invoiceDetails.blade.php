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
                </div>
                <div class="col-md-12 mb-4">
                    {{-- DELETE ATTACHMENT --}}
                    @if (session()->has('delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> {{ session()->get('delete') }} </strong>
                            <i class="fe fe-check-circle fe-16"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {{-- ADD ATTACHMENT --}}
                    @if (session()->has('add'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ session()->get('add') }} </strong>
                            <i class="fe fe-check-circle fe-16"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
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
                                {{-- TAB ONE --}}
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
                                {{-- TAB TWO --}}
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
                                                    <td>{{ $invoices->sections->section_name }}</td>
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
                                {{-- TAB THREE --}}
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="card card-statistics">
                                        {{-- ADD ATTACHMENTS --}}
                                        {{-- @can('اضافة مرفق') --}}
                                        <div class="card-body">
                                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                            <h5 class="card-title">اضافة مرفقات</h5>
                                            <form method="post" action="{{ route('attachment.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile" name="file_name[]" multiple required>
                                                    <input type="hidden" id="customFile" name="invoice_number" value="{{ $invoices->invoice_number }}">
                                                    <input type="hidden" id="invoice_id" name="invoice_id" value="{{ $invoices->id }}">
                                                    <label class="custom-file-label" for="customFile">
                                                        حددالمرفق
                                                    </label>
                                                </div>
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-primary btn-sm "
                                                    name="uploadedFile">
                                                    تاكيد
                                                </button>
                                            </form>
                                        </div>
                                        {{-- @endcan --}}
                                        <br>
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>اسم المرفق</th>
                                                    <th>رقم الفاتورة</th>
                                                    <th>تاريخ الاضافة</th>
                                                    <th>المستخدم</th>
                                                    <th>العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($invoiceAttachments as $row)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td>{{ $row->file_name }}</td>
                                                        <td>{{ $row->invoice_number }}</td>
                                                        <td>{{ $row->created_at }}</td>
                                                        <td>{{ $row->Created_by }}</td>
                                                        <td>
                                                            <a class="btn btn-outline-success btn-sm"
                                                                href="{{ route('details.openfile', [$row->invoice_number, $row->file_name]) }}"
                                                                role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                عرض
                                                            </a>

                                                            <a class="btn btn-outline-info btn-sm"
                                                                href="{{ route('details.download', [$row->invoice_number, $row->file_name]) }}"
                                                                role="button"><i class="fas fa-download"></i>&nbsp;
                                                                تحميل
                                                            </a>
                                                            <a type="button" class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal" data-target="#deleteModal"
                                                                data-whatever="@mdo" data-id="{{ $row->id }}"
                                                                data-file="{{ $row->file_name }}"
                                                                data-invoice="{{ $row->invoice_number }}">
                                                                حذف
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->

        {{-- DELETE MODEEL --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="varyModalLabel">حذف المرفق</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('details.destroy') }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="invoice_number" id="invoice">
                            <strong>هل انت متاكد من حذف هذا المرفق...؟ </strong>
                            <br>
                            <input type="text" name="file_name" id="file" readonly
                                style="border: none; outline: none;font-size: 20px; text-align: end">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn mb-2 btn-danger">حذف</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    @endsection
    @section('js')
        <script>
            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var file = button.data('file')
                var invoice = button.data('invoice')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #invoice').val(invoice);
                modal.find('.modal-body #file').val(file);
            })
        </script>
    @endsection
