@extends('layouts.layout')

@section('title')
جميع الشركات المشتركة في الموقع
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
            <tr>
                <th>اسم الشركة</th>
                <th>موقع الشركة</th>
                <th>تاريخ الاشتراك</th>
                <th>عدد وظائف الشركة</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
            @if($company->isDeleted != 1)
                @php
                
                    $jobs = Job::where('company_id',$company->id)->count();
                @endphp
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->location }}</td>
                    <td>{{ $company->created_at }}</td>
                    <td>{{ $jobs }}</td>
                    <td>
                        <a href="{{ route('deleteCompany',$company->id) }}" class="btn btn-danger">حذف الشركة</a>
                    </td>
                </tr>
            @endif
            
            @endforeach
        </tbody>
    </table>
@endsection