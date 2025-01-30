@extends('layouts.layout')

@section('content')

<style>
    .parent-div{
        background-image: url("{{ asset('images/register.jpg') }}");
        background-position:center;
        color: white
    }
</style>

{{-- Register as a Company --}}
<div class="form-container parent-div" >
  <div class="row">
    <h2>{{ __('messages.companyAccount') }}</h2>
    <a href="#" class="btn btn-success mr-4 to_user">{{ __('messages.jobseekerRegister') }}</a>
  </div>

    <form action="{{ route('companyRegister') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <label for="name">{{ __('messages.company_name') }}:</label>
      <input type="text" id="name" name="name" placeholder="{{ __('messages.company_name') }}" required>

      <label for="email"> {{ __('messages.email') }}:</label>
      <input type="text" id="email" name="email" placeholder="{{ __('messages.email') }}" required>

      <label for="password"> {{ __('messages.password') }}:</label>
      <input type="password" id="password" name="password" placeholder="{{ __('messages.password') }}" required>

      <label for="location">{{ __('messages.location') }}:</label>
      <input type="text" id="location" name="location" required>

      <label for="logo">{{ __('messages.logo') }}:</label>
      <input type="file" id="logo" name="logo" required>



      <button type="submit">{{ __('messages.registerLink') }}</button>
    </form>
  </div>

  {{-- For Register as a job seeker --}}
  <div class="form-container " style="display: none;">
    <div class="row">
      <h4>{{ __('messages.jobseekerAccount') }}</h4>
      <a href="#" class="btn btn-success mr-4 to_company">{{ __('messages.companyRegister') }}</a>

    </div>
    <form action="{{ route('jobseeker.register') }}" method="POST">
      @csrf

      <label for="name">{{ __('messages.username') }}</label>
      <input type="text" id="name" name="name" placeholder="{{ __('messages.username') }}" required>

      <label for="email">{{ __('messages.email') }}:</label>
      <input type="text" id="email" name="email" placeholder="{{ __('messages.email') }}" required>

      <label for="password"> {{ __('messages.password') }}:</label>
      <input type="password" id="password" name="password" placeholder="{{ __('messages.password') }}" required>

      <button type="submit">{{ __('messages.registerLink') }}</button>
    </form>
  </div>

@endsection
