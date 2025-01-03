@extends('layouts.layout')

@section('title')
    المقابلات
@endsection

@section('content')

{{-- PHP code  --}}
@php
use App\Models\Job;
use App\Models\User;
    $no = 0;
@endphp


   <table class="table table-bordered">
       <thead>
           <tr>
               <th>الرقم</th>
               <th>التفاصيل</th>
               <th>موعد المقابلة</th>
               <th>عنوان الوظيفة </th>
               <th>المرشح</th>
           </tr>
       </thead>
       <tbody>
            @foreach ($allInterviews as $interview )
                {{-- PHP code --}}
                @php
                    $no++;
                    $job_title = Job::where('id',$interview->job_id)->value('title');
                    $username = User::where('id',$interview->user_id)->value('name');
                @endphp


                <tr>
                    <td>{{ $no }}</td>
                    <td>
                        {{ $interview->details }}
                    </td>
                    <td>{{ $interview->interviewDate }}</td>
                    <td>{{ $job_title }}</td>
                    <td>{{ $username}}</td>
                </tr>

                
            @endforeach
           
       </tbody>
   </table>
@endsection

