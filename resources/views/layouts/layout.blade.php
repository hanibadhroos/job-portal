<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- Font Awsome --}}
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/all.css')}}">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>@yield('title')</title>
</head>
<style>

    .lang-div{
        display: flex;
        flex-direction: row;
    }
    #lang-btn{
        background-color: #7c7a79;
        border: none;
    }
    *{
        text-align: {{ app()->getLocale() =='ar'?  'right' : 'left'}};
    }
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
    use Illuminate\Support\Facades\App;

    // Getting profiel
    $user_id = Auth::guard('web')->id();
    $profile = Profile::where('user_id',$user_id)->value('photo');

@endphp
<body>
       <header >
        <nav style="direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}; background-color:gray;" class="navbar mb-1  navbar-expand-sm navbar-toggleable-sm navbar-light border-bottom box-shadow ">
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
                                <a class="nav-link text-dark" href="{{ route('companydashboard',Auth::guard('companies')->user()) }}">{{ __('messages.dashboard') }}</a>
                            </li>

                        @elseif (Auth::guard('web')->check())
                        @php
                            $user = Auth::guard('web')->user();
                        @endphp
                            @if($user->hasRole('admin'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('allCompanies') }}">{{ __('messages.companiesBtn') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('allUsers') }}">{{ __('messages.usersBtn') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('category.index') }}">{{ __('messages.categoriesBtn') }}</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('user.applications',Auth::guard('web')->id()) }}">{{ __('messages.applications') }}</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('user.interviews',Auth::guard('web')->id()) }}">{{ __('messages.interviews') }}</a>
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
                                <a id="logout" class="nav-link text-dark" href="{{ route('company.companyLogout') }}">{{ __('messages.logout') }}</a>
                            </li>
                         @elseif(Auth::guard('web')->check())

                            <li class="nav-item">
                                <a id="logout" class="nav-link text-dark" href="{{ route('user.userLogout') }}">{{ __('messages.logout') }}</a>
                            </li>
                            @if (!$user->hasRole('admin') && $profile)
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
                                        <a href="{{ route('user.loginform') }}">{{ __('messages.loginAsJobseeker') }}</a>
                                        <a href="{{ route('company.loginform') }}">{{ __('messages.loginAsCompany') }}</a>
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
{{--  --}}
    </header>
    <body>

        <main>
            {{-- Localization Buttons --}}
            <div class="lang-div">
                {{-- For swich the languages --}}
                <a class="btn btn-primary" href="{{ route('language.switch', 'en') }}">English</a>
                <a class="btn btn-primary" href="{{ route('language.switch', 'ar') }}">عربي</a>

                {{-- <p>Current Language: {{ App::getLocale() }}</p> --}}

            </div>
            @yield('content')
        </main>
    </body>

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
  <footer style="direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}; background-color:gray;">

        <div class="footer-container container  mb-2">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-3">
                    <h2>{{ __('messages.aboutUs') }}</h2>
                    <p>{{ __('messages.aboutMessages') }}</p>
                </div>


                <div class="col-md-3 col-lg-3 col-sm-3">
                    <h2>{{ __('messages.quick_links') }}</h2>
                    <ul class="nav">
                        <li class="nav-item"><a href="/Index" class="text-dark nav-link">{{ __('messages.homeLink') }}</a></li>

                        <li class="nav-item"><a href="/Home/AboutUs" class="text-dark nav-link">{{ __('messages.aboutUs') }}</a></li>
                    </ul>
                </div>



                <div class="col-md-3 col-lg-3 col-sm-3">
                    <h2>{{ __('messages.contactUs') }}</h2>
                    <div class="contact-info">
                        <i class="fa-solid fa-phone m-1"></i>
                        <span>00967770894642</span>
                    </div>
                    <div class="contact-info" style="display: flex; ">
                        <i class="fas fa-envelope m-1"></i>
                        <a href="mailto:hbadhroos@gmail.com" class="text-dark">hbadhroos@gmail.com</a>
                    </div>
                </div>

                <div class="col-md-3 col-lg-3 col-sm-3">
                    <h2>{{ __('messages.followUs') }}</h2>
                    <div class="social-media">
                        <a href="#" class="m-3"><i class="fab fa-facebook text-dark"></i></a>
                        <a href="#" class="m-3"><i class="fab fa-twitter text-dark"></i></a>
                        <a href="#" class="m-3"><i class="fab fa-instagram text-dark"></i></a>
                        <a href="#" class="m-3"><i class="fab fa-linkedin-in text-dark"></i></a>
                    </div>
                </div>

            </div>

        </div>

        <div class="footer-bottom w-100 ">
            <p class="text-center">&copy;  {{ __('messages.copyRight') }} Hani Soft </p>
        </div>
    </footer>


 <script src="{{ asset('js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('js/script.js') }}"></script>


</body>
</html>
