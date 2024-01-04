@extends('layouts.master')
@section('title', 'تغيير حالة الدفع')
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- done --}}
            @if (session()->has('pay'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> {{ session()->get('pay') }} </strong>
                    <i class="fe fe-check-circle fe-16"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- not --}}
            @if (session()->has('not'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong> {{ session()->get('not') }} </strong>
                    <i class="fe fe-check-circle fe-16"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">تغيير حالة الدفع</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('update.payment') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input readonly type="hidden" name="id" value="{{ $invoice->id }}">
                        {{-- ONE --}}
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input readonly type="text" class="form-control" id="inputName" name="invoice_number"
                                    value="{{ $invoice->invoice_number }}" title="يرجي ادخال رقم الفاتورة" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>تاريخ الفاتورة</label>
                                <input readonly class="form-control fc-datepicker" name="invoice_Date"
                                    placeholder="YYYY-MM-DD" type="date" value="{{ $invoice->invoice_date }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>تاريخ الاستحقاق</label>
                                <input readonly class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    value="{{ $invoice->Due_date }}" type="date" required>
                            </div>
                        </div>

                        {{-- Two --}}
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">القسم</label>
                                <select readonly name="Section" class="form-control SlectBox" readonly>
                                    <!--placeholder-->
                                    <option value="" disabled disabled>حدد القسم</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"
                                            {{ $invoice->section_id == $section->id ? 'selected' : 'disabled' }}>
                                            {{ $section->section_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">المنتج</label>
                                <select readonly id="product" name="product" class="form-control">
                                    <option value="{{ $invoice->product }}">
                                        {{ $invoice->product }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input readonly type="text" class="form-control" id="inputName" name="Amount_collection"
                                    value="{{ $invoice->Amount_collection }}">
                            </div>
                        </div>

                        {{-- THREE --}}
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input readonly type="text" class="form-control fc-datepicker" id="Amount_Commission"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                    value="{{ $invoice->Amount_Commission }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input readonly type="text" class="form-control fc-datepicker" id="Discount"
                                    name="Discount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->Discount }}" title="يرجي ادخال مبلغ الخصم ">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select readonly name="Rate_VAT" id="Rate_VAT" class="form-control"
                                    onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="" disabled>حدد نسبة الضريبة</option>
                                    <option value="5%" {{ $invoice->Rate_VAT == '5%' ? 'selected' : 'disabled' }}>5%
                                    </option>
                                    <option value="10%" {{ $invoice->Rate_VAT == '10%' ? 'selected' : 'disabled' }}>10%
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- FOUR --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input readonly type="text" class="form-control" id="Value_VAT" name="Value_VAT"
                                    value="{{ $invoice->Value_VAT }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input readonly type="text" class="form-control" id="Total" name="Total"
                                    value="{{ $invoice->Total }}" readonly>
                            </div>
                        </div>

                        {{-- FIVE --}}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputName" class="control-label">الملاحظات</label>
                                <textarea name="note" class="form-control" id="inputName">
@if ($invoice->note == null)
لا توجد ملاحظات@else{{ $invoice->note }}
@endif
                                </textarea>
                            </div>
                        </div>

                        {{-- six --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputName" class="control-label"> حالة الدفع</label>
                                <select name="Status" class="form-control SlectBox">
                                    <!--placeholder-->
                                    <option value="" selected>--اختر حالة الدفع--</option>
                                    <option value="مدفوعة جزئياً">مدفوعة جزئياً</option>
                                    <option value="مدفوعة">مدفوعة</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputName" class="control-label">تاريخ الدفع</label>
                                <input type="date" name="Payment_Date" class="form-control" id="Payment_Date"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <button type="submit" class="btn btn-success">تحديث حالة الدفع</button>
                        </div>


                    </form>
                </div> <!-- /. card-body -->
            </div> <!-- /. card -->
        </div> <!-- /. col -->
    </div> <!-- /. end-section -->
@endsection
@section('js')

@endsection
