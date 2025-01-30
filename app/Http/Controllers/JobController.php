<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use function PHPUnit\Framework\isEmpty;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = DB::table('job')->select('*')->orderby('created_at','DESC')->get();
        return view('Job.index',['jobs'=>$jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->select('name')->get();
            return view('Job.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $category_id = DB::table('categories')->where('name',$request->category)->value('id');

        $jobToInsert['title']=$request->title;
        $jobToInsert['Requirments']=$request->Requirments;
        $jobToInsert['Location']=$request->Location;
        $jobToInsert['category_id']=$category_id;
        $jobToInsert['created_at']=date("Y-m-d H:i:s");
        $company_id = Auth::guard('companies')->id();
        $jobToInsert['company_id']=$company_id;
        Job::create($jobToInsert);

        $company = Auth::guard('companies')->user();
        return to_route('companydashboard',['company'=>$company])->with(['success'=>'تم نشر الوظيفة بنجاح']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $job = DB::table('job')->select('*')->where('id',$id)->first();
        return view('Job.details',['job'=>$job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Job $job)
    {

        $job = Job::select('*')->find($id);
        return view('Job.edit',['job'=>$job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, $id, Job $job)
    {
        if(!Gate::allows('update-job',$job)){
            abort(403);
        }
        $dataToUpdate['title']=$request->title;
        $dataToUpdate['Requirments']=$request->Requirments;
        $dataToUpdate['salary']=$request->salary;
        $dataToUpdate['Location']=$request->location;
        $dataToUpdate['updated_at']=date('Y-m-d H:i:s');

       Job::where('id',$id)->update($dataToUpdate);
       return to_route('home')->with(['success'=>'تم تحديث الوظيفة بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Job::where('id',$id)->delete();
        return to_route('home')->with(['success'=>'تم حذف الوظيفة بنجاح']);
    }
    public function applications($job_id)
    {
        $unviewedApplications = Application::where('status',0)->select('status')->get();
        foreach ($unviewedApplications as $app) {
                $app->status =1 ;
                $dataToUpdate['status'] = $app->status;
                Application::where('id',$app->id)->update($dataToUpdate);
        }
        $applications = DB::table('applications')->where('job_id',$job_id)->select('*')->get();
        if (!$applications ->isEmpty()) {
            return view('Job.applications',['applications'=>$applications]);
        }
        else{
            echo '<b>لا توجد طلبات على هذه الوظيفة</b>';
        }
    }
}
