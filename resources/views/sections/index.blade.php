@extends('layouts.master')
@section('title', 'لوحة التحكم')
@section('css')
        
@endsection
@section('content')
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row justify-content-start m-2 d-inline-block">
                        <span>الاعدادات /</span>
                        <h2 class="mb-2 page-title">جدول الاقسام</h2>
                    </div>
                    <div class="row justify-content-end m-2">
                        <button type="button" class="btn mb-2 btn-primary" data-toggle="modal" data-target="#varyModal" data-whatever="@mdo">
                            <i class="fe fe-plus-square fe-16"></i> اضافة قسم
                        </button>
                    </div>
                {{-- <p class="card-text">DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, built upon the foundations of progressive enhancement, that adds all of these advanced features to any HTML table. </p> --}}
                <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                    <div class="card-body">
                        <!-- table -->
                        <table class="table datatables" id="dataTable-1">
                        <thead>
                            <tr>
                            <th></th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Department</th>
                            <th>Company</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input">
                                <label class="custom-control-label"></label>
                                </div>
                            </td>
                            <td>228</td>
                            <td>Caldwell White</td>
                            <td>(763) 192-7853</td>
                            <td>Payroll</td>
                            <td>Yahoo</td>
                            <td>146 Integer Street</td>
                            <td>Newark</td>
                            <td>Mar 9, 2020</td>
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted sr-only">Action</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">تعديل</a>
                                    <a class="dropdown-item" href="#">حذف</a>
                                </div>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->

        @include('sections.addModal')
@endsection
@section('js')
        <script src='{{ asset('assets/js/jquery.dataTables.min.js') }}'></script>
        <script src='{{ asset('assets/js/dataTables.bootstrap4.min.js') }}'></script>
        <script>
            $('#dataTable-1').DataTable(
            {
              autoWidth: true,
              "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
              ]
            });
          </script>
@endsection