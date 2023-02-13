<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Warning;
class EmployeeController extends Controller
{
    public function EmployeeLogin(Request $request){
        $request->validate([
            "email"=>"required",
        "password"=>"required",
        ]);
        $employee = Employee::where("email", "=", $request->email)->first();

        if(isset($employee->id)){

            if(Hash::check($request->password, $employee->password)){

                // create a token
                $token = $employee->createToken("employee_api")->plainTextToken;

                /// send a response
                return response()->json([
                    "status" => 200,
                    "message" => "employee logged in successfully",
                    "access_token" => $token
                ]);
            }else{

                return response()->json([
                    "status" => 404,
                    "message" => "Password didn't match"
                ], 404);
            }
        }else{

            return response()->json([
                "status" => 404,
                "message" => "employee not found"
            ], 404);
        }
    }
    public function EmployeeLogout(){
        auth()->guard('employee_api')->Logout();
        return response()->json([
            "status"=>200,
            "massege"=>"employee logged out successfuly"
        ]);
       }
       public function EmployeeProfile(){
        $employee_data=auth()->user();
        
        return response()->json([
            "massege"=>"employee profile"
           , $employee_data
        ]);
       }
      
}
