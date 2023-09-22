@extends('layouts.master')
@section('title', 'جدول الاقسام')
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

                    {{-- Validathion --}}
                    <div class="col-12 mb-4">
                        {{-- ADD --}}
                    @if (session()->has('add'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ session()->get('add') }} </strong> 
                            <i class="fe fe-check-circle fe-16"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif
                        {{-- UPDATE --}}
                    @if (session()->has('edit'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ session()->get('edit') }} </strong> 
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
                    {{-- ERORR --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                        <i class="fe fe-alert-triangle fe-16"></i>
                                    </li>
                                    @endforeach
                                </ul>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                        @endif
                    </div> <!-- /. col -->
                <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                    <div class="card-body">
                        <!-- table -->
                        <table class="table datatables" id="dataTable-1">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>اسم القسم</th>
                            <th>الملاحظات</th>
                            <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($id = 0)
                            @foreach ($sections as $row)
                                <tr>
                                    <td>{{ $id++ }}</td>
                                    <td>{{ $row -> section_name }}</td>
                                    <td >
                                        @if ($row -> description != null)
                                            {{ $row -> description }}
                                        @else
                                            لا يوجد ملاحظات
                                        @endif
                                    </td>
                                    <td style="color: white">
                                        <a type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal" data-whatever="@mdo"
                                        data-id="{{ $row -> id }}"
                                        data-section_name="{{ $row -> section_name }}"
                                        data-description="{{ $row -> description }}">
                                            <i class="fe fe-edit fe-16"></i>
                                        </a>
                                        <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="@mdo"
                                        data-id="{{ $row -> id }}"
                                        data-section_name="{{ $row -> section_name }}">
                                            <i class="fe fe-trash fe-16"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
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
        @include('sections.editModal')
        @include('sections.deleteModal')

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

            <script>
                $('#editModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget)
                    var id = button.data('id')
                    var section_name = button.data('section_name')
                    var description = button.data('description')
                    var modal = $(this)
                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #section_name').val(section_name);
                    modal.find('.modal-body #description').val(description);
                })

            </script>

            <script>
                $('#deleteModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget)
                    var id = button.data('id')
                    var section_name = button.data('section_name')
                    var modal = $(this)
                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #section_name').val(section_name);
                })

            </script>
@endsection