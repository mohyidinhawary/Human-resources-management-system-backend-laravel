<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warning;
use Illuminate\Http\Request;
use App\Models\Employee;
class WarningController extends Controller
{
    public function AddWarning(Request $request,$id){
        $request->validate([
"subject"=>"required",
"details"=>"required"
        ]);
        $employee=Employee::where("id",$id)->exists();
        if(!$employee){
            return response()->json([
                "status"=>404,
                "message"=>"not found"
                        ]);
                    }
                    else{
        $warning=new Warning();
        $warning->employee_id=$id;
        $warning->first_name=Employee::where("id",$id)->select("first_name")->get();
        $warning->subject=$request->subject;
        $warning->details=$request->details;
        $warning->save();
        return response()->json([
            "status"=>200,
            "message"=>"warning added successfuly"
                    ]);
                }
    }
    public function ShowEmployeesWarnings(){
        $warnings=Warning::select("first_name","details")->get();
        return response()->json([
            "status"=>200,
            "message"=>"warnings",$warnings
                    ]);
    }
    public function UpdateWarning(Request $request,$id){
        $warning=Warning::where("id",$id)->exists();
        if(!$warning){
            return response()->json([
                "status"=>404,
                "message"=>"not found",
                        ]);
        }
        else{
            $warning=Warning::find($id);
            $warning->subject=!empty($request->subject)?$request->subject:$warning->subject;
        $warning->details=!empty($request->details)?$request->details:$warning->details;
        $warning->save();
        return response()->json([
            "status"=>200,
            "message"=>"warning updated successfuly",
                    ]);
    }
}
public function DeleteWarning($id){
    $warning=Warning::where("id",$id)->delete();
    return response()->json([
        "status"=>200,
        "message"=>"warning deleted successfuly",
                ]);
}

public function ShowEmployeeWarnings(){
    $id=auth()->user()->id;
        $warnings=Warning::where("employee_id",$id)->select("subject","details")->get();
        return response()->json([
            "status"=>200,
            "message"=>"warnings",$warnings
                    ]);
    }

    public function AddWarningForAll(Request $request){
        $request->validate([
            "first_name"=>"required",
"subject"=>"required",
"details"=>"required"
        ]);
        
        
                   
        $warning=new Warning();
       
        $warning->first_name=$request->first_name;
        $warning->subject=$request->subject;
        $warning->details=$request->details;
        $warning->save();
        return response()->json([
            "status"=>200,
            "message"=>"warning added successfuly"
                    ]);
                }
                public function ShowWarningsForAll(){
                    $warnings=Warning::where("employee_id",null)->select("subject","details")->get();
                    return response()->json([
                        "status"=>200,
                        "message"=>"warnings",$warnings
                                ]);
                }

    }

