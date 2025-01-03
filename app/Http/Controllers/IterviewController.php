<?php

namespace App\Http\Controllers;

use App\Models\Iterview;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use App\Http\Requests\StoreIterviewRequest;
use App\Http\Requests\UpdateIterviewRequest;
use Illuminate\Support\Facades\Auth;

class IterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($application_id)
    {
        $application = Application::where('id',$application_id)->select('*')->first();
        $job_id = Job::where('id',$application->job_id)->value('id');
        $user_id = User::where('id',$application->user_id)->value('id');

        return view("Interview.create",['job_id'=>$job_id,'user_id'=>$user_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIterviewRequest $request)
    {
        $dataToInsert['details'] = $request->details;
        $dataToInsert['interviewDate'] = $request->interviewDate;
        $dataToInsert['job_id'] = $request->job_id;
        $dataToInsert['user_id'] = $request->user_id;
        if(Auth::guard('companies')->check()){
            Iterview::create($dataToInsert);
            $company = Auth::guard('companies')->user();
            return to_route('companydashboard',['company'=>$company])->with(['success'=>'تم تحديد موعدالمقابلة']);
        }
        else{
            echo '<b>يجب علبك الاشتراك اولا او تسجيل الدخول كشركة</b>';
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Iterview $iterview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Iterview $iterview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIterviewRequest $request, Iterview $iterview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Iterview $iterview)
    {
        //
    }
}
