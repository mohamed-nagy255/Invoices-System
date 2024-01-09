@extends('layouts.master')
@section('title', 'اضافة صلاحية')
@section('css')
    <!--Internal  Font Awesome -->
    <link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{URL::asset('assets/plugins/treeview/treeview-rtl.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">صلاحيات المستخدم</strong>
                </div>
                <div class="card-body">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mg-b-20">
                                <div class="card-body">
                                    <div class="main-content-label mg-b-5">
                                        <div class="pull-right">
                                            <a class="btn btn-primary btn-sm" href="{{ route('role.index') }}">رجوع</a>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-lg-4">
                                            <ul id="treeview1">
                                                <li>
                                                    <a href="#">{{ $role->name }}</a>
                                                    <ul>
                                                        @if (!empty($rolePermissions))
                                                            @foreach ($rolePermissions as $v)
                                                                <li>{{ $v->name }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row closed -->
                </div> <!-- /. card-body -->
            </div> <!-- /. card -->
        </div> <!-- /. col -->
    </div> <!-- /. end-section -->
@endsection
@section('js')
    <script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
@endsection
