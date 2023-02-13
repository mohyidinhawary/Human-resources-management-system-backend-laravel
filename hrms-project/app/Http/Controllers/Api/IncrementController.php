<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Increment;
use Illuminate\Http\Request;
use App\Models\Employee;
class IncrementController extends Controller
{
    public function AddIncrement(Request $request,$id){
        $request->validate([
            "increment_date"=>"required",
            "award"=>"",
            "over_time"=>"",
            "increment_amount"=>"required",
            "increment_details"=>"required"
        ]);
        $employee=Employee::where("id",$id)->exists();
        if(!$employee){
            return response()->json([
                "status"=>404,
                "message"=>"not found"
                        ]);
        }
        else{
        $increment=new Increment();
        $increment->employee_id=$id;
        $increment->increment_date=$request->increment_date;
        $increment->award=$request->award;
        $increment->over_time=$request->over_time;
        $increment->increment_amount=$request->increment_amount;
        $increment->increment_details=$request->increment_details;
        $increment->save();
        return response()->json([
"status"=>200,
"message"=>"increment done successfuly"
        ]);
    }
}
public function ShowIncrements(){
    $increments=Increment::get();
    return response()->json([
        "status"=>200,
        "message"=>"increments", $increments
                ]);
}
public function ShowEmployeeIncrements($id){
    $employee_increments=Increment::where("employee_id",$id)->get();
    return response()->json([
        "status"=>200,
        "message"=>"discounts", $employee_increments
                ]);
}
public function UpdateIncrement(Request $request,$id){
    $increment=Increment::where("id",$id)->exists();
        if(!$increment){
            return response()->json([
                "status"=>404,
                "message"=>"not found"
                        ]);
        }
        else{
            $increment=Increment::find($id);
            $increment->increment_date=!empty($request->increment_date)?$request->increment_date:$increment->increment_date;
        $increment->award=!empty($request->award)?$request->award:$increment->award;
        $increment->over_time=!empty($request->over_time)?$request->over_time:$increment->over_time;
        $increment->increment_amount=!empty($request->increment_amount)?$request->increment_amount:$increment->increment_amount;
        $increment->increment_details=!empty($request->increment_details)?$request->increment_details:$increment->increment_details;
        $increment->save();
        return response()->json([
            "status"=>200,
            "message"=>"increment updated successfuly"
                    ]);
}
}
public function TotalIncrements($id){
    $total_increments=Increment::where('employee_id',$id)->sum("increment_amount");
    return response()->json([
        "status"=>200,
        "message"=>$total_increments
                ]);
}
}
