<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
class Employee_Archive extends Controller



// $burgers = DB::scalar(
//     "select count(case when food = 'burger' then 1 end) as burgers from menu"
// );



{
    public function EmployeeArchive($id){
      
    //     $archive=new Archive();
    //     $archive->employee_id=$id;
    //     $archive->first_name=DB::table("employees")->where("id",$id)->select("first_name")->get("first_name")->first();
    //     $archive->email=DB::table("employees")->where("id",$id)->select("email")->get("email")->first();
    //     $archive->branch=DB::table("employees")->where("id",$id)->select("branch")->get("branch")->first();
    //     $archive->department=DB::table("employees")->where("id",$id)->select("department")->get("department")->first();
    //     $archive->job_title=DB::table("employees")->where("id",$id)->select("job_title")->get("job_title")->first();
     
       
    //    $archive->save();
    $employees=Employee::where("id",$id)->get();
    foreach($employees as $key=>$value){
        if(Employee::where("id",$id)->exists()){
        Archive::create([
            "employee_id"=>$value->id,
        "first_name"=>$value->first_name,
        
        "email"=>$value->email,
        
        "branch"=>$value->branch,
        "department"=>$value->department,
        "job_title"=>$value->job_title,
        ]);
        
       return response()->json([
"status"=>200,
"message"=>"employee archived successfuly"
       ]);
    }
   
       
    
}
return response()->json([
    "status"=>404,
    "message"=>"not found"
           ]);
    }
public function ShowEmployeesArchived(){
    $archives=Archive::get();
    return response()->json([
        "message"=>"archives", $archives
    ]);
}
}
