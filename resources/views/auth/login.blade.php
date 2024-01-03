@extends('layouts.masterWithoutNav')
@section('content')
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
            <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="POST" action="{{ route('login') }}">
                @csrf
                {{-- <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html"> --}}
                <img src="{{ asset('./assets/images/logo.png') }}" class="navbar-brand-img brand-sm mx-auto mb-4"
                    style="width: 150px" alt="..." />
                {{-- </a> --}}
                <h1 class="mb-3">
                    {{-- Invoices System --}}
                </h1>
                <div class="form-group">
                    @error('inputEmail')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="email" class="sr-only">البريد الالكتروني</label>
                    <input type="email" name="email" id="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        placeholder="البريد الالكتروني" required="" autofocus="">
                </div>
                <div class="form-group">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="password" class="sr-only">كلمة المرور</label>
                    <input type="password" name="password" id="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        placeholder="كلمة المرور" required="">
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" name="remember" id="remember_me"> تذكرني </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">تسجيل الدخول</button>
                <p class="mt-5 mb-3 text-muted">©CONSOLE 2023</p>
            </form>
        </div>
    </div>
@endsection
