<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store( $job_id)
    {
        if(Auth::guard('web')->check())
        {
            // if $isApplied is empty so allow to create new application 
            $isApplied = DB::table('applications')->where('job_id',$job_id)->where('user_id',Auth::guard('web')->id())->select('*')->first();
            if($job_id != null && empty($isApplied)){

                $dataToInsert['job_id']  = $job_id;
                $dataToInsert['status']  = 0;
                $dataToInsert['user_id']  = Auth::guard('web')->id();
                $dataToInsert['created_at']  =date('Y-m-d H:i:s') ;

                Application::create($dataToInsert);
                return to_route('job.index')->with(['success'=>'تم التقديم بنجاح']);
            }
            else
                abort(404);
        }
        else
            abort(403);
       
     
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {

        $application = Application::where('id',$id)->select('*')->first();
        if (Auth::guard('companies')->id()) {
            $company_id = Auth::guard('companies')->id();
            $company_job= Job::where('company_id',$company_id)->where('id',$application->job_id)->first();
        }
        if($application->user_id == Auth::guard('web')->id() || !empty($company_job)){
            return view('Application.details',['application'=>$application]);
        }
        else
            abort(403);
    }

    public function reject( $user_id)
    {
        if (Auth::guard('companies')->check()) {
            $dataToUpdate['accesptState']= 0;
            Application::where('user_id',$user_id)->update($dataToUpdate);
            return back()->with(['success','تم رفض الطلب']); 
        }
        else 
            abort(403);
   
        
    }

    public function accept($user_id)
    {
        if (Auth::guard('companies')->check()) {
            $dataToUpdate ['accesptState'] = 1;
            Application::where('user_id',$user_id)->update($dataToUpdate);
            return to_route('interview.create')->with(['seccess'=>'تم قبول الطلب. يرجى تعبئة بيانات المقابلة']);
        }
        else
            abort(403);
    }

    public function changeState()
    {
       $unviewedApplications = DB::table('applications')->where('status',0)->get();
       foreach ($unviewedApplications as $app) {
            $app->status =1 ;
            $dataToUpdate['status'] = $app->status;
            Application::where('id',$app->id)->update($dataToUpdate);
       }
        return to_route('company.companyApplications',Auth::guard('companies')->id());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $user_id)
    {
        $application = DB::table('applications')->where('user_id',$user_id)->delete();
        return to_route('home')->with(['success'=>'تم حذف الطلب بنجاح']);
    }
}
