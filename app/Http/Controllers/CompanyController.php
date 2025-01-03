<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loginForm()
    {
        return view("Company.login");
    }

    public function Login(LoginRequest $request)
    {


        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $credentials = $request->only('email','password');
        $company = Company::where('email',$request->email)->first();
        if($company->isDeleted == 1)
        {

                    return to_route('company.loginform')->with(['success'=>'تم حذف حسابك!!!']);

        }

        else
        {
             if(Auth::guard('companies')->attempt($credentials))
            {
                $company = Auth::guard('companies')->user();
                return \to_route('companydashboard',['company'=>$company]);
            }
            else
            {
                echo 'Wrong in Email or Password';
            }
        }

    }

    public function RegisterPage()
    {
        return view('registerLinks');
    }

    public function Register(StoreCompanyRequest $request): RedirectResponse
    {

        $request->validate([
            'name'=>['required','string','max:255'],
            'email'=>['required','max:255','string','email'],
            'password'=>['required'],
            'location'=>['required','string']

        ]);
        if($request->has('logo'))
        {
            $image = $request->logo;
            $extension = \strtolower($image->extension());
            $fileName = time().random_int(1,10000).".".$extension;
            $image->move('uploads',$fileName);
        }

        $company = Company::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'logo'=>$fileName,
            'location'=>$request->location,
        ]);
        Auth::guard('companies')->login($company);
         return \to_route('companydashboard',['company'=>$company]);
    }

    public function Logout()
    {
        Auth::logout();
        \session()->regenerateToken();

        return view('Company.login');
    }

    // Get All company's jobs
    public function CompanyJobs($company_id)
    {
        if(Auth::guard('companies')->id() == $company_id)
        {
            $jobs = Job::with('company')->where('company_id',$company_id)->get();
            return view('Company.jobs',['jobs'=>$jobs]);
        }
        else
        {
            abort(404);
        }


    }

    public function CompanyInterviews($company_id)
    {
        if(Auth::guard('companies')->check())
        {
            $jobs = DB::table('job')->where('company_id',$company_id)->get();
            if(!empty($jobs))
            {
                $allInterviews = [];
                foreach($jobs as $job)
                {
                    $interviews = DB::table('iterviews')->where('job_id',$job->id)->get();
                    if(!$interviews->isEmpty())
                    {
                        $allInterviews = array_merge($allInterviews, $interviews->toArray());

                    }
                }

                if(empty($allInterviews))
                {
                    echo "<b>لا توجد مقابلات حاليا</b>";
                }
                else{
                    return view('Company.interviews',['allInterviews'=>$allInterviews]);
                }
            }
            else
            {
                echo "لا توجد وظائف ولا مقابلات";
            }
        }
        else
            abort(403);
    }

    public function CompanyApplications($company_id)
    {
        if(Auth::guard('companies')->check())
        {
            // $jobs = DB::table('job')->where('company_id',$company_id)->get();
            $jobs = Job::with('company')->where('company_id',$company_id)->get();
            if(!empty($jobs))
            {
                $allApplications = []; // مصفوفة لتخزين جميع الطلبات
                foreach($jobs as $job)
                {
                    $applications = DB::table('applications')->where('job_id',$job->id)->select('*')->orderBy('created_at','DESC')->get();
                    if (!$applications->isEmpty()) {
                        $allApplications = array_merge($allApplications, $applications->toArray());
                    }
                }
                if(!empty($applications))
                {
                    return view('Company.applications',['allApplications'=>$allApplications]);
                }
                else
                {
                    echo "لاتوجد طلبات";
                }
            }
            else
            {
                echo "لا توجد وظائف";
            }
        }
        else
            abort(403);
    }

    function deleteCompany($company_id) {
        $company = Company::where('id',$company_id)->first();
        $company->isDeleted = true;
        $company->save();
        return to_route('allCompanies')->with(['success'=>'تم حذف الشركة بنجاح']);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
