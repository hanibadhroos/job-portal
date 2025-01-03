@extends('layouts.layout')

@section('title')
    الوظائف
@endsection

@php
$no = 1;
@endphp

@section('content')
    @if(Session::has('success') )
        <div class="alert alert-success" role="alert">
            {{Session::get('success') }}
        </div>
    @endif
    @if(!Auth::guard('web')->check())
       <a class="m-auto" href="{{ route('user.loginform') }}"> <h2 class="text-warning ">للتقديم على الوظائف يرجى الاشتراك او تسجيل الدخول كمستخدم</h2></a>
    @endif
    <div class="container mb-4" style="background-image:url({{ asset('images/jobs.jpg') }})">
        <table class="table table-bordered table-hover mt-4">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>عنوان الوظيفة</th>
                    <th>موقع العمل</th>
                    <th>اسم الشركة</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->Location }}</td>

                        {{-- PHP code  --}}
                        @php
                            $no ++;
                            $companyName = DB::table('companies')->where('id',$job->company_id)->value('name');
                        @endphp

                        <td>{{$companyName}}</td>

                        <td>
                            @if(Auth::guard('companies')->check()&& $job->company_id == Auth::guard('companies')->id())
                                <a href="{{ route('job.edit',$job->id) }}" class="btn btn-success">تعديل</a>
                                <a href="{{ route('job.destroy',$job->id) }}" class="btn btn-danger">حذف</a>
                            @elseif (Auth::guard('web')->check() && !Auth::guard('web')->user()->hasRole('admin'))
                                @php
                                    $applied = DB::table('applications')->where('user_id','=',Auth::guard('web')->id())->where('job_id',$job->id)->first();
                                @endphp
                                @if(!empty($applied))
                                    @php
                                        $application_id = DB::table('applications')->where('user_id','=',Auth::guard('web')->id())->where('job_id',$job->id)->value('id');
                                    @endphp
                                    {{-- Go to applicaton Details --}}
                                    <a href="{{ route('application.show',$application_id) }}" >تم التقديم </a>
                                @else
                                    <a href="{{ route('application.store',$job->id) }}" class="btn btn-success">تقديم</a>
                                @endif

                            @endif
                            <a href="{{ route('job.details',$job->id) }}" class="btn btn-info"> <i class="fas fa-eye"></i>التفاصيل</a>

                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>


    </div>
@endsection
