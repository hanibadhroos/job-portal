@extends('layouts.layout')

@section('title')
    {{ __('messages.addInterview') }}
@endsection

@section('content')

{{-- php code for get user_id and job_id by using application_id --}}
@php
use App\Models\Job;
use App\Models\User;

// $job_id = Job::where('id',$application->job_id)->value('id');
// $user_id = User::where('id',$application->user_id)->value('id');

@endphp
    <div class="card w-50 ml-auto mr-auto mt-4">
        <div class="card-header">
            <h2 class="card-title">{{ __('messages.interviews') }}</h2>

        </div>
        <div class="card-body">
            <form action="{{ route('interview.store') }}" method="POST">
                @csrf
                <label for="details">{{ __('messages.details_btn') }}:</label>
                <textarea name="details" id="details" cols="30" rows="10" class="form-control"></textarea>
                <label for="interviewDate">{{ __('messages.interviewDate') }}:</label>
                <input type="datetime-local" name="interviewDate" id="interviewDate" class="form-control">
                <input type="hidden" name="job_id" value="{{ $job_id }}">
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <button class="btn btn-success mt-2">{{ __('messages.saveBtn') }}</button>
            </form>
        </div>
    </div>
@endsection
