@extends('layouts.layout')

@section('title')
Check Your Email
@endsection

@section('content')

<h1>verify your Email </h1>
<p>check your email for verify it, please.</p>
<a href="{{ route('verification.resend') }}">Resend link</a>
@endsection
