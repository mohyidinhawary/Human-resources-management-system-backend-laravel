<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\Department;

class JobController extends Controller
{
    public function AddJob(Request $request,$id){
        $request->validate([
            "job_title"=>"required",
        ]);
        if($department=Department::where("id",$id)->exists()){
            $department=Department::find($id);
            $job=new Job();
            $job->department_id=$id;
            $job->job_title=$request->job_title;
            $job->save();
            return response()->json([
                "status"=>200,
                "message"=>"job added successfuly"
            ]);
    }
    else{
    return response()->json([
        "status"=>404,
        "message"=>"department not found"
    ]);
}
    }
    public function GetAllDepartmentsjobs(){
        $jobs=Job::get();
        return response()->json([
            "message"=>"jobs",$jobs
        ]);
       }
       public function GetDepartmentJobs($id){
        if($department=Department::where("id",$id)->exists()){
            $department=Department::find($id);
        $jobs=Job::where("department_id",$id)->select("job_title")->get();
        return response()->json([
            "message"=>"department{$id}",$jobs
        ]);
       }
       
    }
       public function UpdateJob(Request $request,$id){
        if(Job::where("id",$id)->exists()){
             $job=Job::find($id);
             
            $job->job_title=!empty($request->job_title)?$request->job_title:$job->job_title;
        
        $job->save();
        return response()->json([
            "status"=>200,
            "message"=>"job updated successfuly"
        ]);
        
        
       }
       else{
        return response()->json([
            "status" => 404,
            "message" => "job not found"
        ], 404);
       }
    }
       public function DeleteJob($id1,$id2){
        Job::where("id",$id1)->where("department_id",$id2)->delete();
        return response()->json([
"status"=>200,
"message"=>"job deleted successfuly"
        ]);
       }
}
