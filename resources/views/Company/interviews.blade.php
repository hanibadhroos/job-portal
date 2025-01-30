@extends('layouts.layout')

@section('title')
    {{ __('messages.interviews') }}
@endsection

@section('content')

{{-- PHP code  --}}
@php
use App\Models\Job;
use App\Models\User;
    $no = 0;
@endphp


   <table class="table table-bordered">
       <thead>
           <tr>
               <th>{{ __('messages.no') }}</th>
               <th>{{ __('messages.details_btn') }}</th>
               <th>{{ __('messages.interviewDate') }}</th>
               <th>{{ __('messages.title') }}</th>
               <th>{{ __('messages.jobSeeker') }}</th>
           </tr>
       </thead>
       <tbody>
            @foreach ($allInterviews as $interview )
                {{-- PHP code --}}
                @php
                    $no++;
                    $job_title = Job::where('id',$interview->job_id)->value('title');
                    $username = User::where('id',$interview->user_id)->value('name');
                @endphp


                <tr>
                    <td>{{ $no }}</td>
                    <td>
                        {{ $interview->details }}
                    </td>
                    <td>{{ $interview->interviewDate }}</td>
                    <td>{{ $job_title }}</td>
                    <td>{{ $username}}</td>
                </tr>


            @endforeach

       </tbody>
   </table>
@endsection

