@extends('layouts.layout')

@section('title')
طلباتي
@endsection


@section('content')
@php
    $counter = 1;
    use App\Models\Company;
    use App\Models\Job;
    $isEmpty = empty($applications)
@endphp
    @foreach ($applications as $application)

    @php

        $job = Job::where('id',$application->job_id)->select('*')->first();
        $company = Company::where('id',$job->company_id)->select('*')->first();

    @endphp

        <div class="card w-50 mr-auto ml-auto mt-4">
            <div class="card-header">
            <h2 class="card-title">تفاصيل الطلب {{ $counter }}</h2>
            </div>
            <div class="card-body">
                <label for="">{{ __('messages.viewedQuestion') }}</label>
                @if ($application->status == 1)
                    <input type="text" disabled value="تمت المشاهدة" class="form-control">
                @else
                    <input type="text" disabled value="قيد الانتظار" class="form-control">
                @endif
                <br>

                @if ($application->status == 1)
                    <label for="">حالة القبول:</label>
                    @if ($application->accesptState == 1 )
                        <input type="text" disabled value="مقبول" class="form-control">
                    @elseif ($application->accesptState == 0 )
                        <input type="text" disabled value="لم يتم القبول" class="form-control">

                    @endif
                    <br>
                @endif


                <label >{{ __('messages.date') }}:</label>
                <input type="text" disabled value="{{ $application->created_at }}" class="form-control">

                <br>
                <label for="">{{ __('messages.title') }}:</label>
                <input type="text" disabled value="{{ $job->title }}" class="form-control">
                <br>

                <label for="">{{ __('messages.company_name') }}: </label>
                <input type="text" disabled value="{{ $company->name }}" class="form-control">
                <br>

                <a href="{{ route('job.details',$application->job_id) }}" class="btn btn-info">{{ __('messages.details_btn') }}</a>
                @if(Auth::guard('web')->id()== $application->user_id)
                    <a href="{{ route('application.delete',auth()->id()) }}" class="btn btn-danger">{{ __('messages.delete_btn') }}</a>
                @endif
            </div>
        </div>

        @php
            $counter++;
        @endphp
    @endforeach
@endsection
