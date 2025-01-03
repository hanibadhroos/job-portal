<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\accountController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IterviewController;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('home');
})->name('home');


// route go to page show tow links (register and login)
Route::get('/register', function () {
    return view('registerLinks');
})->name('registerPage');

//// Email verification notice route
Route::get('/email/verify',[UserController::class, 'verifyNotice'])->middleware('auth')->name('verification.notice');

/////// Email Verification Handler
Route::get('/email/verify/{id}/{hash}', [UserController::class,'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');

//Register route
Route::get('companyRegisterPage', [CompanyController::class,'RegisterPage'])->name('companyRegisterPage');
Route::post('companyRegister', [CompanyController::class,'Register'])->name('companyRegister');
Route::get('company/loginform', [CompanyController::class,'loginForm'])->name('company.loginform');
Route::post('company/login', [CompanyController::class,'Login'])->name('company.login');
//Company and its job operations Routes
Route::middleware('auth:companies')->controller(CompanyController::class)->group( function(){
    //Go to company dashboard
    Route::get('companydashboard/{company}', function($company)
    {
        if($company == Auth::guard('companies')->id()){
            return view('Company.dashboard',['company'=>$company]);
        }
        else{
            abort(403);
        }
    }
    )->name('companydashboard');
    // Getting the Company jobs
    Route::get('/companyJobs/{company_id}','CompanyJobs')->name('company.companyJobs');
    // Getting the Company interviews
    Route::get('/companyInterviews/{company_id}','CompanyInterviews')->name('company.companyInterviews');
    // Getting the Company Applications
    Route::get('/companyApplications/{company_id}','CompanyApplications')->name('company.companyApplications');
    // Logout the Company
    Route::any('/companyLogout', [CompanyController::class,'Logout'])->name('company.companyLogout');
    // show create job form
    Route::get('/CreateJob',[JobController::class,'create'])->name('job.create');
    // store job data in database
    Route::post('/storeJob',[JobController::class,'store'])->name('job.store');

}
);
//////////////////////////////////////////////////




//Job seeker Routes
//Jobseeker Register
Route::post('/jobSeekerRegister',[UserController::class,'Register'])->name('jobseeker.register');
Route::get('user/email_verify',[UserController::class,'VerifyEmail'])->name('verify.email');
// Job seeker Login
Route::get('user/login', [UserController::class,'loginForm'])->name('user.loginform');
Route::post('user/login', [UserController::class,'login'])->name('user.login');
Route::get('user/applications/{user_id}', [UserController::class,'applications'])->name('user.applications');
Route::get('user/interviews/{user_id}', [UserController::class,'interviews'])->name('user.interviews');
 Route::middleware(['auth:web'])->group(function () {
    // Logout the job seeker
    Route::any('/jobseekerLogout', [UserController::class,'Logout'])->name('user.userLogout');
    //show all companies to admin
    route::get('allCompnaies',[UserController::class,'allCompanies'])->name('allCompanies');
    // show all user to admin
    route::get('all User',[UserController::class,'allUsers'])->name('allUsers');
    Route::get('delete/company/{company_id}', [CompanyController::class,'deleteCompany'])->name('deleteCompany');
    Route::get('delete/user/{user_id}', [UserController::class,'deleteUser'])->name('user.delete');
 });



 ////// Jobs /////////////
// indext job
Route::get('jobs', [JobController::class,'index'])->name('job.index');
// details job
Route::get('job/details/{id}',[JobController::class,'show'])->name('job.details');
// edit job
Route::get('job/edit/{id}', [JobController::class,'edit'])->name('job.edit');
// update job
Route::post('job/update/{id}',[JobController::class,'update'])->name('job.update');
//destroy job
Route::get('job/destroy/{id}',[JobController::class,'destroy'])->name('job.destroy');
// job Applications
Route::get('job/applications/{job_id}', [JobController::class,'applications'])->name('job.applications');
/////////

///////Profiles //////////
// create profile
Route::any('user/profile',[ProfileController::class,'create'])->name('profile.create');
// store profile
Route::post('profile/store',[ProfileController::class,'store'])->name('profile.store');
//details profile
Route::get('profile/details/{user_id}',[ProfileController::class,'show'])->name('profile.details');
//edit profile
Route::get('profile/edit/{id}', [ProfileController::class,'edit'])->name('profile.edit');
// update profile
Route::post('profile/update/{id}', [ProfileController::class,'update'])->name('profile.update');
////////////////////////////////////////

////// Applocations //////////
// store application
Route::any('application/store/{job_id}', [ApplicationController::class,'store'])->name('application.store');
// show application
Route::get('application/show/{id}', [ApplicationController::class,'show'])->name('application.show');
// delete application
Route::get('application/delete/{id}', [ApplicationController::class,'destroy'])->name('application.delete');
// reject application
Route::any('application/reject/{user_id}', [ApplicationController::class,'reject'])->name('application.reject');
// accept application
Route::any('application/accept/{user_id}', [ApplicationController::class,'accept'])->name('application.accept');
// change application state
Route::any('application', [ApplicationController::class,'changeState'])->name('application.changeState');

///////////////////////////////



/////// Interviews //////////////////////////////////////////
// create interview with recieve appliction id for get job_id and user_id
Route::get('interview/create/{application_id}', [IterviewController::class,'create'])->name('interview.create');
// store interview
Route::post('interview/store', [IterviewController::class,'store'])->name('interview.store');


/////// Categories /////////////////////
Route::get('categories/index',[CategoryController::class,'index'])->name('category.index');
Route::get('category/create',[CategoryController::class,'create'])->name('category.create');
Route::post('category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('category/edit/{category_id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('category/update/{category_id}',[CategoryController::class, 'update'])->name('category.update');
Route::get('category/delete/{category_id}',[CategoryController::class, 'destroy'])->name('category.delete');




// route::middleware('admin:admin')->group(function(){
//     Route::get('admin/login',[AdminController::class,'loginForm']);
//     Route::post('admin/login',[AdminController::class,'store'])->name('admin.login');

// });

// route::middleware('admin:admin')->group(function(){
//     Route::get('admin/login',[AdminController::class,'loginForm']);
//     Route::post('admin/login',[AdminController::class,'store'])->name('admin.login');

// });


// Route::middleware([
//     'auth:sanctum,admin',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });



