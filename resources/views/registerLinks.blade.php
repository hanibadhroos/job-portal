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
    <h2>حساب شركة</h2>
    <a href="#" class="btn btn-success mr-4 to_user">انشاء حساب باحث عن عمل</a>
  </div>

    <form action="{{ route('companyRegister') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <label for="name">اسم الشركة:</label>
      <input type="text" id="name" name="name" placeholder="ادخل اسم شركتك" required>

      <label for="email">البريد الالكتروني:</label>
      <input type="text" id="email" name="email" placeholder="ادخل البريد الالكتروني" required>

      <label for="password">كلمة المرور:</label>
      <input type="password" id="password" name="password" placeholder="ادخل كلمة المرور" required>

      <label for="location">موقع الشركة:</label>
      <input type="text" id="location" name="location" required>

      <label for="logo">شعار الشركة:</label>
      <input type="file" id="logo" name="logo" required>



      <button type="submit">تسجيل</button>
    </form>
  </div>

  {{-- For Register as a job seeker --}}
  <div class="form-container " style="display: none;">
    <div class="row">
      <h4> حساب باحث عن عمل</h4>
      <a href="#" class="btn btn-success mr-4 to_company">التسجيل كشركة</a>

    </div>
    <form action="{{ route('jobseeker.register') }}" method="POST">
      @csrf

      <label for="name">اسم المستخدم:</label>
      <input type="text" id="name" name="name" placeholder="اسم المستخدم" required>

      <label for="email">البريد الالكتروني:</label>
      <input type="text" id="email" name="email" placeholder="بريدك الالكتروني" required>

      <label for="password">كلمة السر:</label>
      <input type="password" id="password" name="password" placeholder="كلمة المرور" required>

      <button type="submit">تسجيل</button>
    </form>
  </div>

@endsection
