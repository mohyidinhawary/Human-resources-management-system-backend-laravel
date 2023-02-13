<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vacation;
use Illuminate\Http\Request;
use App\Models\RequestService;
use App\Models\Employee;

class VacationController extends Controller
{
    public function AddVacationForEmployee(Request $request,$id){
        $request->validate([
            "first_name"=>"required",
        "leave_type"=>"required",
            "applied_on"=>"required",
            "start_date"=>"required",
            "end_date"=>"required",
            "leave_reason"=>"required"
        ]);
        
        $vacation=new Vacation();
        
        $vacation->employee_id=$id;
        $vacation->first_name=$request->first_name;
        $vacation->leave_type=$request->leave_type;
  
        
        $vacation->applied_on=$request->applied_on;
        $vacation->start_date=$request->start_date;
        $vacation->end_date=$request->end_date;
        $vacation->leave_reason=$request->leave_reason;
$vacation->save();

        //where("employee_id",$id)->where("vacation","=",true)->get();
       
            
               
                return response()->json([
                    "status"=>200,
                    "message"=>"vacation added successfuly"
                           ]);
        }
        public function GetEmployeeVacation($id){
            $vacations=Vacation::where("employee_id",$id)->get();
            return response()->json([
                "status"=>200,
                "message"=>$vacations
                       ]);
        }


        public function EmployeeVacation(){
            $id=auth()->user()->id;
            $vacations=Vacation::where("employee_id",$id)->get();
            return response()->json([
                "status"=>200,
                "message"=>$vacations
                       ]);
        }

}

