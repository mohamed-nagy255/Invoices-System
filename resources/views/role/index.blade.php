@extends('layouts.master')
@section('title', 'صلاحيات المستخدمين')
@section('css')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row mb-4 items-align-center">
                    <div class="col-md">
                        <h2 class="h3 mb-3 page-title">
                            المستخدمين
                            <span class="fe-16 text-muted">/ صلاحيات المستخدمين</span>
                        </h2>
                    </div>
                    <div class="col-md-auto ml-auto text-right">
                        @can('اضافة صلاحية')
                            <a href="{{ route('role.create') }}" type="button" class="btn">
                                اضافة صلاحية
                                <span class="fe fe-plus-square fe-16 text-primary"></span>
                            </a>
                        @endcan
                    </div>
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
                    @if (session()->has('update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ session()->get('update') }} </strong>
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
                                            <th>الاسم</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($id = 0)
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $id++ }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td style="color: white">
                                                    @can('عرض صلاحية')
                                                        <a href="{{ route('role.show', $role->id) }}" type="button"
                                                            class="btn" title="SHOW">
                                                            <span class="fe fe-eye fe-16 text-primary"></span>
                                                        </a>
                                                    @endcan
                                                    @if ($role->name != 'owner')
                                                        @can('تعديل صلاحية')
                                                            <a href="{{ route('role.edit', $role->id) }}" type="button"
                                                                class="btn" title="EDITE">
                                                                <span class="fe fe-edit fe-16 text-success"></span>
                                                            </a>
                                                        @endcan
                                                        @can('حذف صلاحية')
                                                            <a type="button" class="btn" data-toggle="modal"
                                                                data-target="#deleteModal" data-whatever="@mdo"
                                                                data-id="{{ $role->id }}" title="DELETE">
                                                                <span class="fe fe-trash-2 fe-16 text-danger"></span>
                                                            </a>
                                                        @endcan
                                                    @endif
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
    @include('role.deleteModale')
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
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })
    </script>
@endsection
