@extends("layouts.layout")

@section('title')
تفاصيل الوظيفة
@endsection

@section('content')

<style>
    .job-dl{
        background: linear-gradient(to left, #a19494, #585863);
        margin: auto;
        border-radius: 5px;
        border: 3px solid;
    }
</style>

    <dl class="row w-50 mt-2 job-dl">
        <dt class="col-lg-4 bg-secondary text-light p-2">
             {{ __('messages.title') }}:
        </dt>
        <dd class="col-sm-10">
            {{ $job->title }}
        </dd>

        <dt class="col-lg-4 bg-secondary text-light p-2">
             {{ __('messages.requirments') }}:
        </dt>
        <dd class="col-sm-10">
           {{$job->Requirments}}
        </dd>


        <dt class="col-lg-4 bg-secondary text-light p-2">
             {{ __('messages.location') }}:
        </dt>
        <dd class="col-sm-10">
            {{ $job->Location }}
        </dd>

        <dt class="col-lg-4 bg-secondary text-light p-2">
            {{ __('messages.date') }}:
        </dt>
        <dd class="col-sm-10">
            {{ $job->created_at }}
        </dd>

        <dt class="col-lg-4 bg-secondary text-light p-2">
            {{ __('messages.company_name') }}:
        </dt>
        <dd class="col-sm-10">
           {{-- PHP code for get the company name  --}}
           @php
                use App\Models\Application;
                use Illuminate\Support\Facades\Auth;
               $companyName = DB::table('companies')->where('id',$job->company_id)->value('name');
               // Get user_id if it is a jobseeker
               $user_id = Auth::guard('web')->id();
               // Get application by user_id and job_id and use it for control the links
                $application = Application::where('job_id',$job->id)->where('user_id',$user_id)->first();
           @endphp
           {{ $companyName }}
        </dd>
        @if (Auth::guard('web')->check() && empty($application))
            <a href="#" class="btn btn-success mb-2">{{ __('messages.apply_btn') }}</a>
        @elseif (Auth::guard('companies')->check() && $job->company_id==Auth::guard('companies')->id())
            <a href="#" class="btn btn-info mb-2">{{ __('messages.edit_btn') }}</a>
        @endif
    </dl>
    <a href="javascript:history.back()" class="btn btn-secondary w-25 mr-auto ml-auto mt-4">{{ __('messages.back') }}</a>

@endsection
