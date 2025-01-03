<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('UserProfile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        $dataToInsert['education'] = $request->education;
        $dataToInsert['skills'] = $request->skills;
        $dataToInsert['experience'] = $request->experience;
        $dataToInsert['created_at'] = date('Y-m-d H:i:s');
        $user_id = Auth::guard('web')->id();
        $dataToInsert['user_id'] = $user_id;
        if($request->has('photo')){
            $image = $request->photo;
            $extension = strtolower($image->extension());
            $fileName = time().random_int(1,10000) . "." . $extension;
            $image->move("assets/uploads",$fileName);
            $dataToInsert['photo'] = $fileName;
        }
        Profile::create($dataToInsert);
        return to_route('home')->with(['success'=>'تم تعبئة ملفك الشخصي']);

    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $profile = Profile::where('user_id',$user_id)->select('*')->first();
        if($profile){
            return view('UserProfile.details',['myProfile'=>$profile]);
        }
        return to_route('profile.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
