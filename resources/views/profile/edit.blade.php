{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.master')
@section('title', 'اعدادات الحساب')
@section('css')
    
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        @if (session('status') === 'password-updated' OR session('status') === 'profile-updated')
            <div class="col-12 my-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>تم تحديث البيانات بنجاح. <i class="fe fe-20 fe-check-circle"></i></strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div> <!-- /. col -->
        @endif
      <div class="col-12 col-lg-10 col-xl-8">
        <h2 class="h3 mb-4 page-title">اعدادات الحساب</h2>
        <div class="my-4">
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>
          <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            <div class="row mt-5 align-items-center">
              <div class="col-md-3 text-center mb-5">
                <div class="avatar avatar-xl">
                  <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
              </div>
              <div class="col">
                <div class="row align-items-center">
                  <div class="col-md-7">
                    <h4 class="mb-1">{{ Auth::user() -> name }}</h4>
                  </div>
                  <br>
                  <br>
                  <div class="col-md-7">
                    <h5 class="mb-1">{{ Auth::user() -> email }}</h5>
                  </div>
                  
                </div>
              </div>
            </div>
            <hr class="my-4">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="firstname">اسم المستخدم</label>
                <input type="text" name="name" id="firstname" class="form-control" value="{{ Auth::user() -> name }}">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail4">البريد الالكتروني</label>
              <input type="email" name="email" class="form-control" id="inputEmail4" value="{{ Auth::user() -> email }}">
            </div>
            <button type="submit" class="btn btn-primary">حفط التغيير</button>
          </form>
          <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')
            <hr class="my-4">
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputPassword4">كلمة المرور الحالية</label>
                  <input type="password" name="current_password" class="form-control" id="inputPassword5">
                </div>
                <div class="form-group">
                  <label for="inputPassword5">كلمة المرور الجديدة</label>
                  <input type="password" name="password" class="form-control" id="inputPassword5">
                </div>
                <div class="form-group">
                  <label for="inputPassword6">اعد كتابة كلمة المرور الجديدة</label>
                  <input type="password" name="password_confirmation" class="form-control" id="inputPassword6">
                </div>
              </div>
              <div class="col-md-6">
                <p class="mb-2">متطلبات كلمة المرور</p>
                <p class="small text-muted mb-2"> لإنشاء كلمة مرور جديدة، عليك استيفاء جميع المتطلبات التالية: </p>
                <ul class="small text-muted pl-4 mb-0">
                  <li> الحد الأدنى 8 أحرف </li>
                  <li>احرف خاصة واحدة على الأقل</li>
                  <li>رقم واحد على الأقل</li>
                  <li>لا يمكن أن تكون هي نفس كلمة المرور السابقة </li>
                </ul>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">حفط التغيير</button>
          </form>
        </div> <!-- /.card-body -->
      </div> <!-- /.col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->
@endsection
@section('js')
    
@endsection

