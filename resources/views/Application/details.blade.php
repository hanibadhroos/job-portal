@extends("layouts.layout")

@section('title')
تفاصيل الطلب
@endsection

@section('content')
@php
    $userName = DB::table('users')->where('id',$application->user_id)->value('name');
    $jobTitle = DB::table('job')->where('id',$application->job_id)->value('title');
@endphp

    <div class="card w-50 m-auto">
         <div class="card-header">
            <h2 class="card-title"> تفاصيل الطلب</h2>
         </div>
         <div class="card-body" style="display: flex; flex-direction:column;">
            <label for=""> هل تم مشاهدة طلبي:</label>
            @if($application->status == 1)
                <input type="text" disabled value="تمت مشاهدة الطلب">
            @elseif ($application->status == 0)
                <input type="text" disabled value="لم يشاهد الطلب">
            @endif
            <label for="">عنوان الوظيفة:</label>
            <input type="text" disabled value="{{ $jobTitle }}">
            <label for="">صاحب الطلب:</label>
            <input type="text" disabled value="{{ $userName }}">

            {{-- Application status --}}
            @if( $application->status == 1)
                <label for=""> حالة قبول الطلب:</label>
                @if($application->accesptState == 1)
                    <input type="text" disabled value="تم قبول الطلب">
                @elseif ($application->accesptState == 0 )
                    <input type="text" disabled value="مرفوض">
                @endif
            @endif
          
         </div>
    </div>
@endsection