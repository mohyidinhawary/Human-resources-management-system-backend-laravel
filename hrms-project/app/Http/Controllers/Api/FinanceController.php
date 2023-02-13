<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Discount;
use App\Models\Increment;
use Illuminate\Support\Facades\DB;
class FinanceController extends Controller
{
    public function AddEmployeeSalary(Request $request,$id){
        $request->validate([
            "first_name"=>"required",
            
            "salary"=>"required",
            
        ]);
        $salary=new Finance();
$salary->employee_id=$id;
$salary->first_name=$request->first_name;
$salary->salary=$request->salary;

        $salary->save();
        return response()->json([
            "status"=>200,
            "message"=>"final salary added successfuly"
                    ]);
        
    
                }
            
    public function ShowEmployeesSalary(){
        $salary=Finance::get();
        return response()->json([
            "status"=>200,
            "message"=>$salary
                    ]);
    }

    public function ShowEmployeeSalary($id){
        $salary=Finance::where("employee_id",$id)->get();
        return response()->json([
            "status"=>200,
            "message"=>$salary
                    ]);
    }

    public function EmployeeShowSalary(){
        $id=auth()->user()->id;
        $salary=Finance::where("employee_id",$id)->get();
        return response()->json([
            "status"=>200,
            "message"=>$salary
                    ]);
    }





    public function ShowEmployeeSalaryRevealed($id){
        if(Employee::where("id",$id)->exists()){
            $increments= Increment::where("employee_id",$id)->get();
$discounts= Discount::where("employee_id",$id)->get();

return response()->json([
    "status"=>200,
    "message"=>"employee salary revealed",$increments,$discounts
    ]);
        }
        else{
            return response()->json([
                "status"=>404,
                "message"=>"not found"
                       ]);
        }

    }



    public function EmployeeShowSalaryRevealed(){
        $id=auth()->user()->id;
            $increments= Increment::where("employee_id",$id)->get();
$discounts= Discount::where("employee_id",$id)->get();

return response()->json([
    "status"=>200,
    "message"=>"employee salary revealed",$increments,$discounts
    ]);
        }
        

    }

