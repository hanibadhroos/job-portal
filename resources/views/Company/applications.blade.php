@extends('layouts.layout')

@section('title')
    {{ __('messages.applications') }}
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

@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ session::get('success') }}
    </div>
@endif


<table class=" table table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>{{ __('messages.title') }}</th>
            <th>{{ __('messages.jobSeeker') }}</th>
            <th>{{ __('messages.created_at') }}</th>
            <th>{{ __('messages.jobSeekerEdu') }}</th>
            <th>{{ __('messages.jobSeekerSkills') }}</th>
            <th>{{ __('messages.jobSeekerExp') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($allApplications as $application)

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

            <tr>
                <td>{{ $counter }}</td>
                <td>{{ $job->title }}</td>
                <td>{{ $user->name }}</td>
                <td>{{\Carbon\Carbon::parse($application->created_at )->format('Y-m-d') }}</td>
                <td>
                    @if(!empty($profile->education))
                        {{ $profile->education }}
                    @else
                        <span class="text-danger">{{ __('messages.noEdu') }}</span>
                    @endif
                </td>
                <td>
                    @if(!empty($profile->skills))
                    {{ $profile->skills }}
                    @else
                        <span class="text-danger">{{ __('messages.noSkills') }}</span>
                    @endif
                </td>
                <td>
                    @if(!empty($profile->experience))
                    {{ $profile->experience }}
                    @else
                        <span class="text-danger">{{ __('messages.noExp') }}</span>
                    @endif
                </td>

                <td class="text-center">
                    <a href="{{ route('job.details',$job->id) }}" class="btn btn-info mt-1">{{ __('messages.details_btn') }}</a>
                    {{-- check--}}
                    @if (Auth::guard('companies')->check()==$company->id && empty($interview))
                        <a href="{{ route('interview.create',$application->id) }}" class="btn btn-success mt-1">{{ __('messages.accept_btn') }}</a>
                        <a href="{{ route('application.reject',$user->id) }}" class="btn btn-danger mt-1">{{ __('messages.reject_btn') }}</a>
                    @else
                        <b>تم قبول الطلب وتحديد موعد المقابلة</b>
                    @endif
                </td>
            </tr>

    @endforeach
    </tbody>
</table>


@endsection
