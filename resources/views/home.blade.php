@extends('layouts.layout')

@section('title')
    {{ __('messages.homeLink') }}
@endsection

@section('content')
    @if(Session::has('success') )
        <div class="alert alert-success" role="alert">
            {{Session::get('success') }}
        </div>
    @endif
    {{-- <div style="margin-top: -20px">
        <div class="bg-dark">
            <video width="100%" height="700"  autoplay muted loop poster="video.jpg" id="videobg">
                <source src="{{asset('images/video.mp4')}}" type="video/mp4">
            </video>
        </div>

    </div> --}}

    <div class="banner">
        <video autoplay muted loop>
            <source src="images/video.mp4" type="video/mp4">
        </video>

        <div class="lay">
            <div class="caption">
                <h2 style="color:wheat; font-size: x-large; font-family: system-ui; font-weight: bolder;">
                    {{ __('messages.introduction') }}

                </h2>

            </div>
        </div>
    </div>
@endsection
