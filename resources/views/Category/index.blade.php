@extends("layouts.layout")

@section("title")
    اصناف الوظائف
@endsection

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
@endif
@php
    $counter = 1;
@endphp
    <a href="{{route('category.create')}}" class="btn btn-success" style="width: 100px; height:50px; margin-right:10px">اضافة صنف</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الرقم</th>
                <th>اسم الصنف</th>
                <th>الوصف</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $counter }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-info mt-2">تعديل</a>
                        <a href="{{ route('category.delete',$category->id) }}" class="btn btn-danger mt-2">حذف</a>
                    </td>
                </tr>
                {{-- PHP Code --}}
                @php
                    $counter++;
                @endphp
            @endforeach

        </tbody>
    </table>
@endsection
