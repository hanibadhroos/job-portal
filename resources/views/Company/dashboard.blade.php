@extends('layouts.layout')

@section('title')
    Company dashboard
@endsection


@section('content')

<style>
    .page-title{
        background: linear-gradient(to left, #a19494, #585863);
    }

    .divs-parent{
        margin: 200px;
        display: flex;
        flex-direction: column;
        height: 0px;
    }
    .page-title{
        margin-top: -15px;
    }

</style>

{{-- PHP code  --}}
@php
    $jobs = DB::table('job')->where('company_id',$company)->count();

@endphp



<div class="mt-0 page-title">
    <h1 class="text-center mb-0 page-title pt-2">صفحة التحكم</h1>
</div>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-2 text-center " style="background-color: #786a6a; color:white; height:500px">
            @php
            use App\Models\Company;
            use App\Models\Job;
            use Illuminate\Support\Facades\DB;


                // Getting Company
                $my_company = Company::findOrFail($company);

            @endphp

           {{-- Company logo --}}
           <img class="rounded-circle mt-1" src="{{ asset('uploads/' . $my_company->logo) }}" alt="logo" height="100px" width="100px">
            <br>
            {{-- Name --}}
            <b>{{ $my_company->name }}</b>
            {{-- Email --}}
            <p class="text-center">{{ $my_company->email }}</p>
            {{-- Links --}}
            <ul >
                <p class="bg-dark text-center"><a class="text-white " href="{{ route('company.companyJobs',$company) }}">الوظائف</a></p>
                <p class="bg-dark text-center"><a class="text-white " href="{{ route('company.companyInterviews',$company) }}">المقابلات</a></p>
                <p class="bg-dark text-center"><a class="text-white " href="{{ route('application.changeState') }}">الطلبات</a></p>

            </ul>
        </aside>

        <div class="col-md-10" style="background-color: #473636">
            {{-- when the company is post new job  show this alert--}}
            @if(Session::has('success'))
                <div class="alert alert-success mt-4" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="divs-parent text-center" >
                <div class="btn text-white disabled mb-2 bg-success ">
                     عدد الوظائف: <br> <b >{{ $jobs }} </b>
                </div>
                <div class="btn text-white disabled bg-primary ">
                    تاريخ انشا الشركة: <br>
                    {{\Carbon\Carbon::parse($my_company->created_at)->format('Y-m-d')  }}
                 </div>
            </div>
        </div>

    </div>
</div>

@endsection
