@extends('layouts.master')
@section('title', 'تعديل فاتورة')
@section('css')
    <style>
        .drop-container {
            position: relative;
            display: flex;
            gap: 10px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 200px;
            padding: 20px;
            border-radius: 10px;
            border: 2px dashed #555;
            color: #444;
            cursor: pointer;
            transition: background .2s ease-in-out, border .2s ease-in-out;
        }

        .drop-container:hover {
            background: #eee;
            border-color: #111;
        }

        .drop-container:hover .drop-title {
            color: #222;
        }

        .drop-title {
            color: #444;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            transition: color .2s ease-in-out;
        }

        .drop-container.drag-active {
            background: #eee;
            border-color: #111;
        }

        .drop-container.drag-active .drop-title {
            color: #222;
        }

        input[type=file] {
            width: 350px;
            max-width: 100%;
            color: #444;
            padding: 5px;
            background: #fff;
            border-radius: 10px;
            /* border: 1px solid #555; */
            border: none;
        }

        input[type=file]::file-selector-button {
            display: none;
            margin-right: 20px;
            border: none;
            background: #084cdf;
            padding: 5px 10px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        input[type=file]::file-selector-button:hover {
            background: #0d45a5;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- ADD --}}
            @if (session()->has('edit'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> {{ session()->get('edit') }} </strong>
                    <i class="fe fe-check-circle fe-16"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">تعديل فاتورة</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('invoice.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $invoice->id }}">
                        {{-- ONE --}}
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    value="{{ $invoice->invoice_number }}" title="يرجي ادخال رقم الفاتورة" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="date" value="{{ $invoice->invoice_date }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    value="{{ $invoice->Due_date }}" type="date" required>
                            </div>
                        </div>

                        {{-- Two --}}
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="Section" class="form-control SlectBox">
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد القسم</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"
                                            {{ $invoice->section_id == $section->id ? 'selected' : '' }}>
                                            {{ $section->section_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">المنتج</label>
                                <select id="product" name="product" class="form-control">
                                    <option value="{{ $invoice->product }}">
                                        {{ $invoice->product }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    value="{{ $invoice->Amount_collection }}">
                            </div>
                        </div>

                        {{-- THREE --}}
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input type="text" class="form-control fc-datepicker" id="Amount_Commission"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                    value="{{ $invoice->Amount_Commission }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input type="text" class="form-control fc-datepicker" id="Discount" name="Discount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->Discount }}" title="يرجي ادخال مبلغ الخصم ">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد نسبة الضريبة</option>
                                    <option value="5%" {{ $invoice->Rate_VAT == '5%' ? 'selected' : '' }}>5%</option>
                                    <option value="10%" {{ $invoice->Rate_VAT == '10%' ? 'selected' : '' }}>10%</option>
                                </select>
                            </div>
                        </div>

                        {{-- FOUR --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT"
                                    value="{{ $invoice->Value_VAT }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total"
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

                        <button type="submit" class="btn btn-primary">تعديل الفاتورة</button>

                    </form>
                </div> <!-- /. card-body -->
            </div> <!-- /. card -->
        </div> <!-- /. col -->
    </div> <!-- /. end-section -->
@endsection
@section('js')
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

    <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("Total").value = sumt;

            }

        }
    </script>
@endsection
