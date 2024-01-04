@extends('layouts.master')
@section('title', 'طباعة فاتورة')
@section('css')
    <style>
        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-7,
        .col-md-5 {
            flex: 0 0 50%;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            table {
                width: 100%;
                max-width: 450px;
                /* Adjust the max-width as needed */
                margin: 50px auto;
            }
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="row align-items-center mb-4">
                {{-- done --}}
                @if (session()->has('done'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> {{ session()->get('done') }} </strong>
                        <i class="fe fe-check-circle fe-16"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col">
                    <h2 class="h5 page-title">
                        <small class="text-muted text-uppercase">رقم الفاتورة</small>
                        <br />
                        #{{ $invoice->invoice_number }}
                    </h2>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" id="print_Button" onclick="printDiv()">
                        طباعة
                        <span class="fe fe-printer fe-16 text-mute"></span>
                    </button>
                    {{-- <button type="button" class="btn btn-primary">Pay</button> --}}
                </div>
            </div>
            <div class="card shadow" id="print">
                <div class="card-body p-5">
                    <div class="row mb-5">
                        <div class="col-12 text-center mb-4">
                            <img src="{{ asset('./assets/images/logo.png') }}"
                                class="navbar-brand-img brand-sm mx-auto mb-4" style="width: 200px" alt="..." />
                            <h2 class="mb-0 text-uppercase">فاتورة تحصيل</h2>
                            <p class="text-muted">
                                Altavista
                                <br />
                                9022 Suspendisse Rd.
                            </p>
                        </div>
                        <div class="col-md-7">
                            {{-- <p class="small text-muted text-uppercase mb-2">
                                Invoice from
                            </p>
                            <p class="mb-4">
                                <strong>Imani Lara</strong><br />
                                Asset Management<br />
                                9022 Suspendisse Rd.<br />
                                High Wycombe<br />
                                (478) 446-9234<br />
                            </p> --}}
                            <p>
                                <span class="small text-muted text-uppercase">رقم الفاتورة #</span><br />
                                <strong>{{ $invoice->invoice_number }}</strong>
                            </p>
                            <p>
                                <span class="small text-muted text-uppercase">القسم</span><br />
                                <strong>{{ $invoice->sections->section_name }}</strong>
                            </p>
                        </div>
                        <div class="col-md-5">
                            {{-- <p class="small text-muted text-uppercase mb-2">
                                Invoice to
                            </p>
                            <p class="mb-4">
                                <strong>Walter Sawyer</strong><br />
                                Human Resources<br />
                                Ap #992-8933 Sagittis Street<br />
                                Ivanteyevka<br />
                                (803) 792-2559<br />
                            </p> --}}
                            <p>
                                <small class="small text-muted text-uppercase">تاريخ الاصدار</small><br />
                                <strong>{{ $invoice->invoice_date }}</strong>
                            </p>
                            <p>
                                <small class="small text-muted text-uppercase">تاريخ الاستحقاق</small><br />
                                <strong>{{ $invoice->Due_date }}</strong>
                            </p>
                        </div>
                    </div>
                    <!-- /.row -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">المنتج</th>
                                <th scope="col" class="text-right">مبلغ التحصيل</th>
                                <th scope="col" class="text-right">مبلغ العمولة</th>
                                <th scope="col" class="text-right">الاجمالي</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $invoice->product }}</td>
                                <td class="text-right">{{ number_format($invoice->Amount_collection, 2) }}</td>
                                <td class="text-right">{{ number_format($invoice->Amount_Commission, 2) }}</td>
                                <td class="text-right">
                                    {{ number_format($invoice->Amount_Commission + $invoice->Amount_collection, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row mt-4">
                        <div class="col-2 text-center">
                            <img src="{{ asset('./assets/images/qr.png') }}" class="navbar-brand-img brand-sm mx-auto my-4"
                                alt="..." />
                        </div>
                        <div class="col-4 md-5">
                            <p class="text-muted small">
                                <strong>ملحوظة :</strong> Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. Nam hendrerit nisi sed
                                sollicitudin pellentesque.
                            </p>
                        </div>
                        <div class="col-md-5">
                            <div class="text-right mr-2">
                                <p class="mb-2 h6">
                                    <span class="text-muted">الخصم : </span>
                                    <strong>{{ number_format($invoice->Discount, 2) }}</strong>
                                </p>
                                <p class="mb-2 h6">
                                    <span class="text-muted">نسبة الضريبة ({{ $invoice->Rate_VAT }}) : </span>
                                    <strong>{{ number_format($invoice->Value_VAT, 2) }}</strong>
                                </p>
                                <p class="mb-2 h6">
                                    <span class="text-muted">الاجمالي شامل الضريبة : </span>
                                    <span class="text-primary">{{ number_format($invoice->Total, 2) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- .row -->
@endsection
@section('js')
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
