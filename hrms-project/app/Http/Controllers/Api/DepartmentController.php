<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\CompanyBranche;
class DepartmentController extends Controller
{
    public function AddDepartment(Request $request,$id){
        $request->validate([
            "department_name"=>"required",
        ]);
        if($branch=CompanyBranche::where("id",$id)->exists()){
            $branch=CompanyBranche::find($id);
            $department=new Department();
            $department->branch_id=$id;
            $department->department_name=$request->department_name;
            $department->save();
            return response()->json([
                "status"=>200,
                "message"=>"department added successfuly"
            ]);
    }
    else{
    return response()->json([
        "status"=>404,
        "message"=>"branch not found"
    ]);
}
    }
    public function GetAllBranchesDepartments(){
        $departments=Department::get();
        return response()->json([
            "message"=>"departments",$departments
        ]);
       }
       public function GetBrancheDepartments($id){
        if($branch=Department::where("branch_id",$id)->exists()){
            $branch=Department::find($id);
        $departments=Department::where("branch_id",$id)->select("department_name")->get();
        return response()->json([
            "message"=>"branch{$id}",$departments
        ]);
       }
       else{
        return response()->json([
            "status"=>404,
            "message"=>"branch not found"
        ]);
       }
    }
       public function UpdateDepartment(Request $request,$id1){
        if(Department::where("id",$id1)->exists()){
             $department=Department::find($id1);
             
            $department->department_name=!empty($request->department_name)?$request->department_name:$department->department_name;
        
        $department->save();
        return response()->json([
            "status"=>200,
            "message"=>"department updated successfuly"
        ]);
        
        
       }
       else{
        return response()->json([
            "status" => 404,
            "message" => "department not found"
        ], 404);
       }
    }
       public function DeleteBranch($id1,$id2){
        Department::where("id",$id1)->where("branch_id",$id2)->delete();
        return response()->json([
"status"=>200,
"message"=>"branch deleted successfuly"
        ]);
       }
}
