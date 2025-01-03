@extends('layouts.layout')

@section('title')
    نشر وظيفة جديدة
@endsection

@section('content')

<style>
    input
    {
        direction: ltr;
        text-align: left;
    }
</style>


<div class="card w-50 mr-auto ml-auto mt-4 mb-4 p-2">
    <div class="card-header">
        <h3 class="card-title text-center">بيانات الوظيفة</h3>
    </div>
    <form action="{{ route('job.store') }}" method="POST">
        @csrf
        <label for="title">عنوان الوظيفة:</label>
        <input id="title" type="text" name="title" class="form-control">
        <label for="Requirments">منطلبات الوظيفة:</label>
        <input id="Requirments" type="text" name="Requirments" class="form-control">
        <label for="Location">موقع الوظيفة:</label>
        <input id="Location" type="text" name="Location" class="form-control">
        
        <label for="category">المجال الوظيفي: </label>
        <select name="category" id="category" class="form-control">

            @foreach ($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach

        </select>
        <button type="submit" class="btn btn-success mt-2">نشر الوظيفة</button>
    </form>
</div>
   

@endsection