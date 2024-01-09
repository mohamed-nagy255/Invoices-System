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
                        <h2 class="h3 mb-3 page-title">
                            ادارة الفواتير
                            <span class="fe-16 text-muted">
                                @if (request()->is('invoice/invoice_table/invoice_all'))
                                    / قائمة الفواتير
                                @elseif (request()->is('invoice/invoice_table/paid_invoice'))
                                    / الفواتير المدفوعة
                                @elseif (request()->is('invoice/invoice_table/partpaid_invoice'))
                                    / الفواتير المدفوعة جزئياٌ
                                @elseif (request()->is('invoice/invoice_table/unpaid_invoice'))
                                    / الفواتير الغير المدفوعة
                                @endif
                            </span>
                        </h2>
                    </div>
                    <div class="col-md-auto ml-auto text-right">
                        @can('اضافة فاتورة')
                            <a href="{{ route('invoice.insert') }}" type="button" class="btn">
                                اضافة فاتورة <span class="fe fe-plus-square fe-16 text-primary"></span>
                            </a>
                        @endcan
                        @can('تصدير EXCEL')
                            <a href="{{ route('export.excel') }}" type="button" class="btn">
                                تصدير اكسيل <span class="fe fe-upload fe-16 text-success"></span>
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="col-md-12">
                    {{-- archive --}}
                    @if (session()->has('archive'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ session()->get('archive') }} </strong>
                            <i class="fe fe-check-circle fe-16"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {{-- DELETE --}}
                    @if (session()->has('delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> {{ session()->get('delete') }} </strong>
                            <i class="fe fe-check-circle fe-16"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card shadow">
                        <div class="card-body">
                            <table class="table datatables" id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>رقم الفاتورة</th>
                                        <th>تاريخ القاتورة</th>
                                        <th>تاريخ الاستحقاق</th>
                                        <th>المنتج</th>
                                        <th>القسم</th>
                                        <th>مبلغ التحصيل</th>
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
                                    @php($id = 0)
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <td>{{ $invoice->invoice_date }}</td>
                                            <td>{{ $invoice->Due_date }}</td>
                                            <td>{{ $invoice->product }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('details.index', $invoice->id) }}">{{ $invoice->sections->section_name }}</a>
                                            </td>
                                            <td>{{ $invoice->Amount_collection }}</td>
                                            <td>{{ $invoice->Discount }}</td>
                                            <td>{{ $invoice->Rate_VAT }}</td>
                                            <td>{{ $invoice->Value_VAT }}</td>
                                            <td>{{ $invoice->Total }}</td>
                                            <td>
                                                @if ($invoice->note == null)
                                                    لا يوجد ملاحظات
                                                @else
                                                    {{ $invoice->note }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($invoice->Value_Status === 0)
                                                    <span class="dot dot-lg bg-success mr-2"></span>
                                                @elseif ($invoice->Value_Status === 2)
                                                    <span class="dot dot-lg bg-warning mr-2"></span>
                                                @else
                                                    <span class="dot dot-lg bg-danger mr-2"></span>
                                                @endif
                                                {{ $invoice->Status }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @can('تعديل الفاتورة')
                                                            <a class="dropdown-item"
                                                                href="{{ route('invoice.edit', $invoice->id) }}">
                                                                تعديل <span class="fe fe-edit fe-16 text-success "></span>
                                                            </a>
                                                        @endcan
                                                        @can('تغير حالة الدفع')
                                                            <a class="dropdown-item"
                                                                href="{{ route('invoice.show.payment', $invoice->id) }}">
                                                                تغير حالة الدفع <span
                                                                    class="fe fe-target fe-16 text-success "></span>
                                                            </a>
                                                        @endcan
                                                        @can('ارشفة الفاتورة')
                                                            <a type="button" class="dropdown-item" data-toggle="modal"
                                                                data-target="#archiveModal" data-whatever="@mdo"
                                                                data-id="{{ $invoice->id }}"
                                                                data-invoice_number="{{ $invoice->invoice_number }}">
                                                                ارشفة الفاتورة <span
                                                                    class="fe fe-layers fe-16 text-warning "></span>
                                                            </a>
                                                        @endcan
                                                        <a class="dropdown-item"
                                                            href="{{ route('details.index', $invoice->id) }}">
                                                            المعلومات <span
                                                                class="fe fe-package fe-16 text-success "></span>
                                                        </a>
                                                        @can('طباعةالفاتورة')
                                                            <a class="dropdown-item"
                                                                href="{{ route('invoice.template', $invoice->id) }}">
                                                                طباعة الفاتورة
                                                                <span class="fe fe-printer fe-16 text-success"></span>
                                                            </a>
                                                        @endcan
                                                        @can('حذف الفاتورة')
                                                            <a type="button" class="dropdown-item" data-toggle="modal"
                                                                data-target="#deleteModal" data-whatever="@mdo"
                                                                data-id="{{ $invoice->id }}"
                                                                data-invoice_number="{{ $invoice->invoice_number }}">
                                                                حذف الفاتورة <span
                                                                    class="fe fe-trash-2 fe-16 text-danger "></span>
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

    @include('invoices.invoiceArchiveModal')
    @include('invoices.deleteModalInvoice')

@endsection
@section('js')
    <script src='{{ asset('assets/js/jquery.dataTables.min.js') }}'></script>
    <script src='{{ asset('assets/js/dataTables.bootstrap4.min.js') }}'></script>
    <script>
        $('#dataTable-1').DataTable({
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
    </script>
    {{-- Archive MODALE --}}
    <script>
        $('#archiveModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>
    {{-- DELETE MODALE --}}
    <script>
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>
@endsection
