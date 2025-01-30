<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Laravel\Fortify\Actions\CanonicalizeUsername;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

use App\Actions\Fortify\AttemptToAuthenticate;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Http\Response\LoginResponse;
use App\Jobs\EmailVerificationJob;
use App\Mail\VerifyEmail;
use App\Models\Application;
use App\Models\User;
use App\Models\Company;
use App\Models\Iterview;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{

    public function loginForm()
    {
        return view('User.login');
    }

    public function Login(LoginRequest $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $credentials = $request->only('email','password');
        $user = User::where('email',$request->email)->first();
        if($user->isDeleted ==1)
        {
            return to_route('user.loginform')->with(['success'=>'لقد تم حذف حسابك']);
        }
        else{
            if(Auth::guard('web')->attempt($credentials))
            {
                $user = Auth::guard('web')->user();
                // replace it to job.Index
                return \to_route('home');

            }
            else
            {
                echo 'Wrong in Email or Password';
            }
        }

    }


    public function Register(Request $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        Auth::login($user);

        event(new Registered($user));
        return view('Email.verify');

        // if ($user) {
        //     EmailVerificationJob::dispatch($user);
        //     return view('Email.verify');
        // }
        // else{
        //     return to_route('registerPage');
        // }

    }

    public function Logout()
    {
        Auth::logout();
        \session()->regenerateToken();
        return view('home');
    }
    public function applications($user_id)
    {
        $applications = Application::where('user_id',$user_id)->select('*')->orderby('created_at','DESC')->get();
        if(!$applications->isEmpty()){
            return view('User.applications',['applications'=>$applications]);
        }
        else
         echo "<b> لا توجد طلبات</b>";
    }
    public function interviews($user_id)
    {
        $interviews = Iterview::where('user_id',$user_id)->select('*')->orderby('created_at','DESC')->get();
        if($interviews)
        {
            return view('User.interviews',['interviews'=>$interviews]);
        }
        else
            echo "<b>لا توجد مقابلات</b>";
    }

    function allCompanies() {
        $companies = Company::orderBy('created_at','DESC')->get();
        return view('Admin.allCompanies',['companies'=>$companies]);
    }
    function allUsers() {
        $users = User::where('isDeleted',0)->orderBy('created_at','DESC')->get();
        if($users != null)
        {
            return view('Admin.allUsers',compact('users'));
        }
        else
            echo "<b>لا يوجد مستخدمين مفعلين</b>";
    }
   function deleteUser($user_id){
    $user = User::where('id',$user_id)->first();
    $user->isDeleted=true;
    $user->save();
    return to_route('allUsers')->with(['success'=>'تم حذف المستخدم بنجاح']);

   }
}

