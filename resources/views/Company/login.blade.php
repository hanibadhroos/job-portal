@extends('layouts.layout')

@section('title')
    {{ __('messages.loginAsCompany') }}
@endsection

@section('content')
@if (Session::has('success'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('success') }}
    </div>
@endif
    <div class="card w-50" style="margin: auto">
        <div class="card-header">
            <p class="card-title text-center"> {{ __('messages.loginAsCompany') }}</p>
        </div>

        <div class="card-body">
            <form action="{{ route('company.login') }}" method="POST">
                @csrf
                <label for="email">{{ __('messages.email') }}:</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email">

                <label for="password"> {{ __('messages.password') }}:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="password">

                <button type="submit" class="btn btn-primary mt-1">{{ __('messages.loginLink') }}</button>
            </form>


        </div>
    </div>

@endsection
