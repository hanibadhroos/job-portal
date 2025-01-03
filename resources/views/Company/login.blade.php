@extends('layouts.layout')

@section('title')
    Company Login
@endsection

@section('content')
@if (Session::has('success'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('success') }}
    </div>    
@endif
    <div class="card w-50" style="margin: auto">
        <div class="card-header">
            <p class="card-title text-center"> تسجيل الدخول الى الشركة</p>
        </div>

        <div class="card-body">
            <form action="{{ route('company.login') }}" method="POST">
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