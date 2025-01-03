@extends('layouts.layout')

@section('title')
جميع المستخدمين المشتركين في الموقع
@endsection

@section('content')
@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
@endif
@php
    use App\Models\Job;
@endphp
    <table class="table table-bordered">
        <thead>
            <tr style="background-color: #EEE">
                <th>اسم المستخدم</th>
                <th>ايميل المستخدم</th>
                <th>تاريخ الاشتراك</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            @if($user->isDeleted != 1 && !$user->hasRole('admin'))

                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="{{ route('user.delete',$user->id) }}" class="btn btn-danger">حذف المستخدم</a>
                    </td>
                </tr>
            @endif

            @endforeach
        </tbody>
    </table>
@endsection
