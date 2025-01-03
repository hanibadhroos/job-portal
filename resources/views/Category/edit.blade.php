@extends('layouts.layout')

@section('title')
 تعديل الصنف

@endsection


@section('content')
<style>
    .parnet-div{
        border: 2px solid #ddd;
        border-radius: 8px;
        padding: 5px;
        font-family: emoji;
        background-color: #EEE;
    }
</style>

    <form action="{{ route('category.update',$category->id) }}" method="POST">
        @csrf
        <div class="form-group w-50 m-auto parnet-div">
            <label for="name"> اسم الصنف:</label>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control">
            <label for="description">الوصف:</label>
            <input type="text" name="description" value="{{ $category->description }}" class="form-control">

            <button class="btn btn-info mt-2">تعديل</button>
        </div>
    </form>

@endsection
