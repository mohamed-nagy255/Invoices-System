@extends('layouts.master')
@section('title', 'ارشيف الفواتير')
@section('css')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row mb-4 items-align-center">
                    <div class="col-md">
                        <h2 class="h3 mb-3 page-title">قائمة الفواتير المؤرشفة</h2>
                    </div>
                    <div class="col-md-auto ml-auto text-right">
                        {{-- <a href="" type="button" class="btn">
                            <span class="fe fe-plus-square fe-16 text-muted"></span>
                        </a> --}}
                    </div>
                </div>
                <div class="col-md-12">
                    {{-- RECOVERY --}}
                    @if (session()->has('done'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ session()->get('done') }} </strong>
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
                                        <th>تاريخ الحذف</th>
                                        <th>المنتج</th>
                                        <th>القسم</th>
                                        <th>مبلغ التحصيل</th>
                                        <th>الخصم</th>
                                        <th>نسبة الضريبة</th>
                                        <th>قيمة الضريبة</th>
                                        <th>الاجمالي</th>
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
                                            <td>{{ $invoice->deleted_at }}</td>
                                            <td>{{ $invoice->product }}</td>
                                            <td>{{ $invoice->sections->section_name }}</a>
                                            </td>
                                            <td>{{ $invoice->Amount_collection }}</td>
                                            <td>{{ $invoice->Discount }}</td>
                                            <td>{{ $invoice->Rate_VAT }}</td>
                                            <td>{{ $invoice->Value_VAT }}</td>
                                            <td>{{ $invoice->Total }}</td>
                                            <td>
                                                @if ($invoice->Value_Status === 0)
                                                    <span class="dot dot-lg bg-success mr-2"></span>
                                                @elseif ($invoice->Value_Status === 2)
                                                    <span class="dot dot-lg bg-warning mr-2"></span>
                                                @else
                                                    <span class="dot dot-lg bg-danger mr-2"></span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-left">
                                                        <a class="dropdown-item"
                                                            href="{{ route('recovery.archive', $invoice->id) }}">
                                                            الغاء الارشفة
                                                        </a>
                                                        <a type="button" class="dropdown-item" data-toggle="modal"
                                                            data-target="#deleteModal" data-whatever="@mdo"
                                                            data-id="{{ $invoice->id }}"
                                                            data-invoice_number="{{ $invoice->invoice_number }}">
                                                             حذف الفاتورة
                                                        </a>
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
