@extends('layouts.master')
@section('title', 'تعديل مستخدم')
@section('css')
    <!--Internal  Font Awesome -->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{ asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
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
                    <strong class="card-title">تعديل مستخدم</strong>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('user.index') }}">رجوع</a>
                        </div>
                    </div><br>

                    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['user.update', $user->id]]) !!}
                    <div class="">

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                                {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                                {!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>

                    </div>

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>كلمة المرور: <span class="tx-danger">*</span></label>
                            {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                            {!! Form::password('confirm-password', ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="row row-sm mg-b-20">
                        <div class="col-lg-6">
                            <label class="form-label">حالة المستخدم</label>
                            <select name="Status" id="select-beast" class="form-control  nice-select  custom-select">
                                <option value="{{ $user->Status }}">{{ $user->Status }}</option>
                                <option value="مفعل">مفعل</option>
                                <option value="غير مفعل">غير مفعل</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">نوع المستخدم</label>
                                {!! Form::select('roles', $roles, $userRole, ['class' => 'form-control nice-select custom-select']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mg-b-20">
                    </div>
                    <div class="mg-t-30">
                        <button class="btn btn-primary pd-x-20" type="submit">تحديث</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
    </div> <!-- /. end-section -->
@endsection
@section('js')
    <!-- Internal Treeview js -->
    <script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
@endsection
