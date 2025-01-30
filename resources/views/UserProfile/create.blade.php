@extends('layouts.layout')

@section('title')
    {{ __('messages.jobseekerProfile') }}
@endsection

<style>
    input{
        text-align: left;
    }
</style>
@section('content')
    <div class="card w-50 m-auto">
        <div class="card-header">
        </div>
        <div class="card-body">
            <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="photo">{{ __('messages.personalPhoto') }}</label>
                <input type="file" name="photo" class="form-control" id="photo">
                <label for="education">{{ __('messages.jobSeekerEdu') }}</label>
                <input type="text" id="education" name="education" class="form-control">
                <label for="skills">{{ __('messages.jobSeekerSkills') }}</label>
                <textarea type="text" class="form-control" name="skills" id="skills"></textarea>
                <label for="experience">{{ __('messages.jobSeekerExp') }}</label>
                <textarea type="text" name="experience" id="experience" class="form-control"></textarea>

                <button type="submit" class="btn btn-success mt-2">{{ __('messages.saveBtn') }}</button>
            </form>
        </div>
    </div>


@endsection
