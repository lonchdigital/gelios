@extends('admin.layouts.auth')

@section('content')

<div class="main-content- h-100vh">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-md-8 col-lg-5">
                <!-- Middle Box -->
                <div class="middle-box">
                    <div class="card">
                        <div class="card-body p-4">

                            <!-- Logo -->
                            <h4 class="font-24 mb-1">Логін.</h4>
                            <p class="mb-30">Увійдіть в свій акаунт щоб продовжити.</p>

                            <form method="POST" action="{{ route('auth.login') }}">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label class="float-left" for="emailaddress">Email</label>
                                    <input class="form-control" type="email" id="emailaddress" name="email" required="" placeholder="Введіть ваш email">
                                </div>

                                <div class="form-group">
                                    <a href="forget-password.html" class="text-dark float-right"></a>
                                    <label class="float-left" for="password">Пароль</label>
                                    <input class="form-control" type="password" name="password" required="" id="password" placeholder="Введіть ваш пароль">
                                </div>

                                <div class="form-group d-flex justify-content-between align-items-center mb-3">
                                    <div class="checkbox d-inline mb-0">
                                        <input type="checkbox" name="checkbox-1" id="checkbox-8">
                                        <label for="checkbox-8" class="cr mb-0">Запам'ятати мене</label>
                                    </div>
                                    {{-- <span class="font-13 text-primary"><a href="forget-password.html">Forgot your password?</a></span> --}}
                                </div>

                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit"> Увійти </button>
                                </div>

                                {{-- <div class="text-center mt-15"><span class="mr-2 font-13 font-weight-bold">Don't have an account?</span><a class="font-13 font-weight-bold" href="register.html">Sign up</a></div> --}}

                            </form>

                            <!-- end card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
