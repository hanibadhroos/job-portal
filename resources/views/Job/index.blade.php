@extends('layouts.layout')

@section('title')
    {{ __('messages.jobsLink') }}
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
       <a class="m-auto" href="{{ route('user.loginform') }}"> <h2 class="text-warning text-center" style="text-shadow: 3px 4px 4px black;">{{ __('messages.forApplyAlert') }}</h2></a>
    @endif
    <div class="container mb-4" style="background-image:url({{ asset('images/jobs.jpg') }})">
        <table class="table table-bordered table-hover mt-4 table-responsive">
            <thead>
                <tr>
                    <th>{{ __('messages.no') }} </th>
                    <th> {{ __('messages.title') }}</th>
                    <th>{{ __('messages.location') }}</th>
                    <th>{{ __('messages.company_name') }}</th>
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
                                <a href="{{ route('job.edit',$job->id) }}" class="btn btn-success">{{ __('messages.edit_btn') }}</a>
                                <a href="{{ route('job.destroy',$job->id) }}" class="btn btn-danger">{{ __('messages.delete_btn') }}</a>
                            @elseif (Auth::guard('web')->check() && !Auth::guard('web')->user()->hasRole('admin'))
                                @php
                                    $applied = DB::table('applications')->where('user_id','=',Auth::guard('web')->id())->where('job_id',$job->id)->first();
                                @endphp
                                @if(!empty($applied))
                                    @php
                                        $application_id = DB::table('applications')->where('user_id','=',Auth::guard('web')->id())->where('job_id',$job->id)->value('id');
                                    @endphp
                                    {{-- Go to applicaton Details --}}
                                    <a href="{{ route('application.show',$application_id) }}" >{{ __('messages.applied_text') }} </a>
                                @else
                                    <a href="{{ route('application.store',$job->id) }}" class="btn btn-success">{{ __('messages.apply_btn') }}</a>
                                @endif

                            @endif
                            <a href="{{ route('job.details',$job->id) }}" class="btn btn-info"> <i class="fas fa-eye"></i></a>

                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>


    </div>
@endsection
