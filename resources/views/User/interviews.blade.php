@extends('layouts.layout')

@section('title')
مقابلاتي
@endsection


@section('content')
@php
    $counter = 1;
    use App\Models\Company;
    use App\Models\Job;
    $isEmpty = empty($applications)
@endphp
    @foreach ($interviews as $interview)
   
    @php
        
        $job = Job::where('id',$interview->job_id)->select('*')->first();
        $company = Company::where('id',$job->company_id)->select('*')->first();

    @endphp

        <div class="card w-50 mr-auto ml-auto mt-4">
            <div class="card-header">
            <h2 class="card-title">تفاصيل المقابلة {{ $counter }}</h2>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <label for="" class="ml-2">تفاصيل المقابلة:</label>
                    @if ($interview->details != null )
                        <textarea disabled class="w-100">{{ $interview->details }}</textarea>
                    @endif
                </div>
                <br>

                <label >تاريخ المقابلة:</label>
                <input type="text" disabled value="{{ $interview->interviewDate }}" class="form-control">
                
                <br>
                <label for="">عنوان الوظيفة:</label>
                <input type="text" disabled value="{{ $job->title }}" class="form-control">
                <br>
                
                <label for="">اسم الشركة: </label>
                <input type="text" disabled value="{{ $company->name }}" class="form-control">
                <br>
                
                <a href="{{ route('job.details',$job->id) }}" class="btn btn-info">تفاصيل الوظيفة</a>
                
            </div>
        </div>
        
        @php
            $counter++;
        @endphp
    @endforeach
@endsection