@extends('layouts.layout')

@section('title')
    job seeker profile
@endsection

<style>
    input{
        text-align: left;
    }
</style>
@section('content')
    <div class="card w-50 m-auto">
        <div class="card-header">
            <h2 class="card-title text-center">انشاء ملفك الشخصي</h2>
        </div> 
        <div class="card-body">
            <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="photo">الصورة الشخصية</label>
                <input type="file" name="photo" class="form-control" id="photo">
                <label for="education">المؤهل العلمي</label>
                <input type="text" id="education" name="education" class="form-control">
                <label for="skills">المهارات</label>
                <textarea type="text" class="form-control" name="skills" id="skills"></textarea>
                <label for="experience">الخبرات</label>
                <textarea type="text" name="experience" id="experience" class="form-control"></textarea>
    
                <button type="submit" class="btn btn-success mt-2">حفظ</button>
            </form>
        </div>
    </div>
  
    
@endsection