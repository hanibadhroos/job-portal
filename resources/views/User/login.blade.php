@extends('layouts.layout')

@section('title')
    User Login
@endsection

@section('content')

<style>
    .card-body{
        background-image: url(http://127.0.0.1:8000/images/login.jpg);
        object-fit: fill;
        background-position: center;
    }
    label{
        color: white;
        font-size: 20px
    }
</style>


    @if(Session::has('success'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="card w-50" style="margin: auto">
        <div class="card-header">
            <p class="card-title text-center"> تسجيل دخول مستخدم  </p>
        </div>

        <div class="card-body " style="background-image:url({{ asset('images/login.jpg') }})">
            <form action="{{ route('user.login') }}" method="POST">
                @csrf
                <label for="email">البريد الالكتروني:</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email">

                <label for="password">كلمة السر:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="password">

                <button type="submit" class="btn btn-primary mt-1">تسجيل الدخول</button>
            </form>


        </div>
    </div>

@endsection
