@extends('layouts.layout')
@section('title')
 تفاصيل الملف الشخصي
@endsection

@php
    $user_id = Auth::guard('web')->id();
    $profile_photo = DB::table('profiles')->where('user_id',$user_id)->value('photo');
@endphp

@section('content')
    <div class="card w-75 m-auto">

        <div class="card-header">
            <h2 class="card-title text-center">تفاصيل ملفك </h2>
        </div>
        <div class="row">
            <div class="col-md-2">
                <img src="{{asset('assets/uploads/'.$myProfile->photo)}}" width="100" height="100" class="rounded-circle" alt="profile image">
            </div>

            <div class="col-md-8">
                <label >الموهل العلمي:</label>
                <b>{{ $myProfile->education }}</b>
                @if ($myProfile->experience != null)
                    <hr>
                    <label> الخبرات:</label>
                    <b>{{ $myProfile->experience }}</b>
                @endif
                <hr>
                <label >المهارات:</label>
                <b>{{ $myProfile->skills }}</b>
            </div>
        </div>


    </div>
@endsection
