@extends('layouts.layout')

@section('title')
طلبات الوطيفة
@endsection


@php
    $counter = 0;
    use App\Models\Job;
    use App\Models\User;
    use App\Models\Profile;
    use App\Models\Company;
    use App\Models\Iterview;
    use Illuminate\Support\Facades\Auth;

@endphp

@section('content')
@foreach ($applications as $application)

{{-- check if there are applications no viewed --}}
{{-- @if ($application->status == 0) --}}
    @php
    $counter++;
    // Get the job information
    $job =Job::where('id',$application->job_id)->select('*')->first();
    
    // Get job seeker (user)  
    $user = User::where('id',$application->user_id)->select('*')->first();

    // Get Profile 
    $profile = Profile::where('user_id',$application->user_id)->select('*')->first();

    // Get company by company_id in job
    $company = Company::where('id',$job->company_id)->select('*')->first();

    // check if interview has user_id and job_id, if true then hide link for this application
    $interview = Iterview::where('job_id',$job->id)->where('user_id',$user->id)->first();

    @endphp 

<div class="card w-50 m-auto">
    <div class="card-header">
        <h3 class="card-title text-center">الطلب {{ $counter }}</h3>
    </div>
    <div class="card-body">
        
        <div>
            <b>حالة القبول:</b>

        </div>
        <div>
            <b>عنوان الوظيفة:</b>
            {{ $job->title }}
        
        </div>
        
        <div>
            <b>صاحب الطلب:</b>
            {{ $user->name }}
            <br>

            <b>موهلات صاحب الطلب:</b>
            @if(!empty($profile->education))
                {{ $profile->education }}
            @else
                <span class="text-warning">لا يملك موهلات</span>
            @endif

            <br>
            <b>مهارات صاحب الطلب:</b>
            @if(!empty($profile->skills))
                {{ $profile->skills }}
            @else
                <span class="text-warning">لا يملك مهارات</span>
            @endif
            <br>
            <b>خبرات صاحب الطلب:</b>
            @if(!empty($profile->experience))
                {{ $profile->experience }}
            @else
                <span class="text-warning">لا يملك خبرات</span>
            @endif

        </div>
    
        <a href="{{ route('job.details',$job->id) }}" class="btn btn-info">تفاصيل الوظيفة</a>
        {{-- check--}}
        @if (Auth::guard('companies')->check()==$company->id && empty($interview))
            <a href="{{ route('application.reject',$user->id) }}" class="btn btn-danger">رفض الطلب</a>
            <a href="{{ route('interview.create',$application->id) }}" class="btn btn-success">قبول الطلب</a>
        @else
            <b>تم قبول الطلب وتحديد موعد المقابلة</b>
        @endif
        
    </div>

    {{-- @endif --}}
    @endforeach
</div>
@endsection