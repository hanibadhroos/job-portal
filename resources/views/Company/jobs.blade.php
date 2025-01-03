@extends('layouts.layout')

@section('title')
    وظائفئ
@endsection


@section('content')

@php
    $counter = 1;
@endphp
<div class="bg-dark text-light  mb-2">
    <h2 class="text-center h-50">وظائفي</h2>
</div>
<a href="{{ route('job.create') }}" class="btn btn-success h-75 m-2" style="width: fit-content">نشر وظيفة جديدة</a>

    @foreach ($jobs as $job)

    <div class="card w-50 m-auto ">
        <h1 class="card-header card-title text-center">
                الوظيفة رقم {{ $counter }}
        </h1>
        <hr>
        <div class="card-body">
            {{-- Title --}}
            <div>
                <label for=""> عنوان الوظيفة:</label>
                {{ $job->title }}
            </div>
            {{-- Requirments --}}
            <div>
                <label for=""> متطلبات الوظيفة:</label>
                {{ $job->Requirments }}
            </div>
            {{-- Location --}}
            <div>
                <label for=""> موقع الوظيفة:</label>
                {{ $job->Location }}
            </div>
            {{--  job category --}}
            <div>
                <label for=""> مجال الوظيفة:</label>
                @php
                    $categoryName = DB::table('categories')->where('id',$job->category_id)->value('name');
                @endphp

                {{ $categoryName }}
            </div>
            {{-- date of publish --}}
            <div>
                <label for="">  تاريخ النشر:</label>
                {{ \Carbon\Carbon::parse($job->created_at)->format('Y-m-d') }}
            </div>

            {{-- company operations --}}
            <div>
                @if(Auth::guard('companies')->check()&& $job->company_id == Auth::guard('companies')->id())
                    <a href="{{ route('job.edit',$job->id) }}" class="btn btn-success">تعديل</a>
                    <a href="{{ route('job.destroy',$job->id) }}" class="btn btn-danger">حذف</a>
                    <a href="{{ route('job.details',$job->id) }}" class="btn btn-info">التفاصيل</a>
                    <a href="{{ route('job.applications',$job->id) }}" class="btn btn-primary">الطلبات</a>

                @endif
            </div>
        </div>
    </div>
    <hr>

    @php
        $counter++;
    @endphp
    @endforeach


@endsection
