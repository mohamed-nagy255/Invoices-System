@extends('layouts.master')
@section('title', 'اضافة صلاحية')
@section('css')
    <!--Internal  Font Awesome -->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{ asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
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
                    <strong class="card-title">اضافة صلاحية</strong>
                </div>
                <div class="card-body">
                    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['role.update', $role->id]]) !!}
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mg-b-20">
                                <div class="card-body">
                                    <div class="main-content-label mg-b-5">
                                        <div class="form-group">
                                            <p>اسم الصلاحية :</p>
                                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-lg-4">
                                            <ul id="treeview1">
                                                <li><a href="#">الصلاحيات</a>
                                                    <ul>
                                                        <li>
                                                            @foreach ($permission as $value)
                                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                                                    {{ $value->name }}</label>
                                                                <br />
                                                            @endforeach
                                                        </li>

                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary"> تحديث الصلاحية</button>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row closed -->
                    {!! Form::close() !!}
                </div> <!-- /. card-body -->
            </div> <!-- /. card -->
        </div> <!-- /. col -->
    </div> <!-- /. end-section -->
@endsection
@section('js')
    <!-- Internal Treeview js -->
    <script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
@endsection
