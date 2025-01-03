<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- Font Awsome --}}
    <link rel="stylesheet" href="asset('css/font-awesome/css/all.css')">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>@yield('title')</title>
</head>
<style>
    body {
        display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #CCC;
    }
    main {
            flex: 1;
        }

    footer {
        background-color: #333;
        color: rgb(22, 20, 20);
        text-align: center;
        padding: 10px 0;
    }

    header {
        background-color: #333;
        color: white;
        display: flex;
        justify-content: flex-end;
        height: 100px;
    }
    .dropdown {
        position: relative;
        display: inline-block;
    }
    .dropdown button {
        background-color:inherit;
    }
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: rgb(204, 196, 196);
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }
    .show {
        display: block;
    }
    nav{
        width: 100%;
    }
    .navbar-nav{
        align-items: center;
    }
    .nav-item a{
        font-size: 20px;
        font-weight: bold;
        font-family: system-ui;
    }

</style>
@php
    use App\Models\Profile;
    use Illuminate\Support\Facades\DB;

    // Getting profiel
    $user_id = Auth::guard('web')->id();
    $profile = Profile::where('user_id',$user_id)->value('photo');

@endphp
<body style="display: grid">
       <header >
        <nav style="direction: rtl; background-color:gray;" class="navbar mb-1  navbar-expand-sm navbar-toggleable-sm navbar-light border-bottom box-shadow ">
            <div class="container">
                <a class="navbar-brand"  href="{{ route('home') }}"><i style="color:#f1e9e9;text-shadow: -1px -1px 0 #cf1515, 1px -1px 0 #4e3f3f, -1px 1px 0 #231f1f, 1px 1px 0 #373131;">Middle East Jobs</i></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item ">
                            <a class="nav-link text-dark " href="{{ route('home') }}">{{ __('messages.homeLink') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" >{{ __('messages.aboutUs') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('job.index') }}">{{ __('messages.jobsLink') }}</a>
                        </li>
                        @if(Auth::guard('companies')->check())
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('companydashboard',Auth::guard('companies')->user()) }}">صفحة التحكم</a>
                            </li>

                        @elseif (Auth::guard('web')->check())
                        @php
                            $user = Auth::guard('web')->user();
                        @endphp
                            @if($user->hasRole('admin'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('allCompanies') }}">الشركات</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('allUsers') }}">المستخدمين</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('category.index') }}">الاصناف</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('user.applications',Auth::guard('web')->id()) }}">طلباتي</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('user.interviews',Auth::guard('web')->id()) }}">مقابلاتي</a>
                                </li>
                            @endif


                        @endif
                    </ul>

                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('registerPage') }}">{{ __('messages.registerLink') }}</a>
                        </li>


                        <form action="" method="POST" id="loginForm"> @csrf </form>


                        @if(Auth::guard('companies')->check())


                            <li class="nav-item">
                                <a id="logout" class="nav-link text-dark" href="{{ route('company.companyLogout') }}">خروج</a>
                            </li>
                         @elseif(Auth::guard('web')->check())

                            <li class="nav-item">
                                <a id="logout" class="nav-link text-dark" href="{{ route('user.userLogout') }}">خروج</a>
                            </li>
                            @if (!$user->hasRole('admin'))
                                <li class="nav-item">
                                    <a id="profile" class="nav-link text-dark" href="{{ route('profile.details',Auth::guard('web')->id()) }}">
                                        <img src="assets/uploads/{{ $profile }}" alt="" width="50" height="50" class="rounded-circle mr-4">
                                    </a>
                                </li>
                            @endif



                        @else
                            <li>
                                <div class="dropdown">
                                    <button onclick="toggleDropdown()">{{ __('messages.loginLink') }}</button>
                                    <div id="myDropdown" class="dropdown-content">
                                        <a href="{{ route('user.loginform') }}">تسجيل دخول المستخدم</a>
                                        <a href="{{ route('company.loginform') }}">تسجيل دخول الشركة</a>
                                    </div>
                                </div>
                            </li>
                        @endif



                        <form id="logout-form" action="{{ route('company.companyLogout') }}" method="POST">
                            @csrf
                        </form>

                    </ul>

                </div>
            </div>
        </nav>
    </header>
        @yield('content')

    <script>
        let logout = document.getElementById('logout');
        let form = document.getElementById('logout-form');
        logout.addEventListener('click', function(){
            form.submit();
        })

        function toggleDropdown() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropdown button')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
    </script>


{{-- Footer --}}
  <footer style="direction: rtl; background-color:gray; ">

        <div class="footer-container container  mb-2">
            <div class="row">
                <div class="col-md-6">
                    <h2>من نحن</h2>
                    <p>نحن فريق من المحترفين المبدعين المتحمسين لمساعدة الشركات والأفرادالباحثين عن عمل على تحقيق أهدافهم من خلال تقديم حلول مبتكرة وموثوقة.</p>
                </div>


                <div class="col-md-2">
                    <h2>روابط سريعة</h2>
                    <ul class="nav">
                        <li><a href="/Index" class="text-dark">الصفحة الرئيسية</a></li>

                        <li><a href="/Home/AboutUs" class="text-dark"> من نحن</a></li>
                    </ul>
                </div>



                <div class="col-md-2">
                    <h2>تواصل معنا</h2>
                    <div class="contact-info">
                        <i class="fa-solid fa-location m-1"></i>
                        <span>اليمن-حضرموت-المكلا</span>
                    </div>
                    <div class="contact-info">
                        <i class="fa-solid fa-phone m-1"></i>
                        <span> 770894642</span>
                    </div>
                    <div class="contact-info" style="display: flex; ">
                        <i class="fas fa-envelope m-1"></i>
                        <a href="mailto:hbadhroos@gmail.com" class="text-dark">hbadhroos@gmail.com</a>
                    </div>
                </div>

                <div class="col-md-2">
                    <h2>تابعنا</h2>
                    <div class="social-media">
                        <a href="#"><i class="fas fa-facebook-f"></i></a>
                        <a href="#"><i class="fas fa-twitter"></i></a>
                        <a href="#"><i class="fas fa-instagram"></i></a>
                        <a href="#"><i class="fas fa-linkedin-in"></i></a>
                    </div>
                </div>

            </div>

        </div>

        <div class="footer-bottom w-100 ">
            <p class="text-center">&copy; جميع الحقوق محفوظة Hani Soft </p>
        </div>
    </footer>


 <script src="{{ asset('js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
