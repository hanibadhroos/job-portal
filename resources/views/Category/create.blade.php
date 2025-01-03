@extends('layouts.layout')
@section('title')
اضافة صنف جديد
@endsection

@section('content')
<style>
    *{
        text-align: left;
        direction: ltr;
    }
</style>

    <div class="card w-50 m-auto p-2">
        <div class="card-header">
            <h2 class="card-title text-center">Category Ditails</h2>
        </div>
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <label for="name">Category Name:</label>
                <input type="text" name="name" class="form-control" >
                <label for="description">Description:</label>
                <input type="text" name="description" class="form-control">

                <button type="submit" class="btn btn-primary mt-2">انشاء</button>
            </form>
    </div>
@endsection
