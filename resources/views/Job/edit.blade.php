@extends('layouts.layout')

@section('title')
    تعديل الوظيفة
@endsection

@section('content')
<style>
    input,textarea{
        text-align: left;
        direction: ltr;
    }
</style>
    <div class="card w-50 mt-2 mr-auto ml-auto">
        <div class="card-header">
            <h2 class="card-title">بيانات الوظيفة:</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('job.update',$job->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">العنوان</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ $job['title'] }}">
                </div>
                <div class="form-group">
                    <label for="Requirments">متطلبات الوظيفة:</label>
                    <textarea name="Requirments" id="Requirments" rows="2" class="form-control" cols="30" rows="10">{{ $job['Requirments'] }}</textarea>
                </div>
                <div class="form-group">
                    <label for="location">موقع العمل:</label>
                    <input type="text" id="location" name="location" class="form-control" value="{{ $job['Location'] }}">
                </div>

                <button type="submit" class="btn btn-success">تعديل</button>
            </form>
        </div>
    </div>

@endsection
