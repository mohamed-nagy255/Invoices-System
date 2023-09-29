@extends('layouts.master')
@section('title', 'قائمة الفواتير')
@section('css')
        
@endsection
@section('content')
            <div class="container-fluid">
                <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="h3 mb-3 page-title">Orders</h2>
                    <div class="row mb-4 items-align-center">
                    <div class="col-md">
                        <ul class="nav nav-pills justify-content-start">
                        <li class="nav-item">
                            <a class="nav-link active bg-transparent pr-2 pl-0 text-primary" href="#">الكل <span class="badge badge-pill bg-primary text-white ml-2">164</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2" href="#">المدفوعة <span class="badge badge-pill bg-white border ml-2">64</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2" href="#">المدفوعة جزئياً <span class="badge badge-pill bg-white border ml-2">48</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2" href="#">الغير مدفوعة <span class="badge badge-pill bg-white border ml-2">52</span></a>
                        </li>
                        </ul>
                    </div>
                    <div class="col-md-auto ml-auto text-right">
                        <button type="button" class="btn">
                            <span class="fe fe-refresh-ccw fe-16 text-muted"></span>
                        </button>
                        <button type="button" class="btn">
                            <span class="fe fe-plus-square fe-16 text-muted"></span>
                        </button>
                    </div>
                    </div>
                    <!-- Slide Modal -->
                    {{-- <div class="modal fade modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="defaultModalLabel">Filters</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fe fe-x fe-12"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="p-2">
                            <div class="form-group my-4">
                                <p class="mb-2"><strong>Regions</strong></p>
                                <label for="multi-select2" class="sr-only"></label>
                                <select class="form-control select2-multi" id="multi-select2">
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="UT">Utah</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TX">Texas</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                </select>
                            </div> <!-- form-group -->
                            <div class="form-group my-4">
                                <p class="mb-2">
                                <strong>Payment</strong>
                                </p>
                                <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Paypal</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                <label class="custom-control-label" for="customCheck2">Credit Card</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1-1" checked>
                                <label class="custom-control-label" for="customCheck1">Wire Transfer</label>
                                </div>
                            </div> <!-- form-group -->
                            <div class="form-group my-4">
                                <p class="mb-2">
                                <strong>Types</strong>
                                </p>
                                <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio1">End users</label>
                                </div>
                                <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" checked>
                                <label class="custom-control-label" for="customRadio2">Whole Sales</label>
                                </div>
                            </div> <!-- form-group -->
                            <div class="form-group my-4">
                                <p class="mb-2">
                                <strong>Completed</strong>
                                </p>
                                <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1">Include</label>
                                </div>
                            </div> <!-- form-group -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn mb-2 btn-primary btn-block">Apply</button>
                            <button type="button" class="btn mb-2 btn-secondary btn-block">Reset</button>
                        </div>
                        </div>
                    </div>
                    </div> --}}
                    <table class="table border table-hover bg-white " id="dataTable-1">
                    <thead>
                        <tr role="row">
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
                    <nav aria-label="Table Paging" class="my-3">
                    <ul class="pagination justify-content-end mb-0">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                    </nav>
                </div>
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
@endsection
@section('js')
        
@endsection