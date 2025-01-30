@extends('layouts.layout')

@section('title')
    {{ __('messages.jobsLink') }}
@endsection


@section('content')

@php
    $counter = 1;
@endphp
<div class="bg-dark text-light  mb-2">
    <h2 class="text-center h-50">{{ __('messages.jobsLink') }}</h2>
</div>
<a href="{{ route('job.create') }}" class="btn btn-success h-75 m-2" style="width: fit-content">{{ __('messages.createJobBtn') }}</a>

    @foreach ($jobs as $job)

    <div class="card w-50 m-auto ">
        <h1 class="card-header card-title text-center">
                {{ __('messages.jobNO') }} {{ $counter }}
        </h1>
        <hr>
        <div class="card-body">
            {{-- Title --}}
            <div>
                <label for=""> {{ __('messages.title') }}:</label>
                {{ $job->title }}
            </div>
            {{-- Requirments --}}
            <div>
                <label for="">{{ __('messages.requirments') }}:</label>
                {{ $job->Requirments }}
            </div>
            {{-- Location --}}
            <div>
                <label for="">  {{ __('messages.location') }}:</label>
                {{ $job->Location }}
            </div>
            {{--  job category --}}
            <div>
                <label for=""> {{ __('messages.jobCategory') }}:</label>
                @php
                    $categoryName = DB::table('categories')->where('id',$job->category_id)->value('name');
                @endphp

                {{ $categoryName }}
            </div>
            {{-- date of publish --}}
            <div>
                <label for=""> {{ __('messages.created_at') }}:</label>
                {{ \Carbon\Carbon::parse($job->created_at)->format('Y-m-d') }}
            </div>

            {{-- company operations --}}
            <div>
                @if(Auth::guard('companies')->check()&& $job->company_id == Auth::guard('companies')->id())
                    <a href="{{ route('job.edit',$job->id) }}" class="btn btn-success">{{ __('messages.edit_btn') }}</a>
                    <a href="{{ route('job.destroy',$job->id) }}" class="btn btn-danger">{{ __('messages.delete_btn') }}</a>
                    <a href="{{ route('job.details',$job->id) }}" class="btn btn-info">{{ __('messages.details_btn') }}</a>
                    <a href="{{ route('job.applications',$job->id) }}" class="btn btn-primary">{{ __('messages.applications') }}</a>

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
