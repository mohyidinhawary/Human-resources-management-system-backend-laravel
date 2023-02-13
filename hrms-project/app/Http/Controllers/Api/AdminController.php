<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\CompanyBranche;
use App\Models\Department;

class AdminController extends Controller
{
    public function AdminRegister(Request $request){
        $request->validate([
            "first_name"=>"required",
            "middle_name"=>"required",
            "last_name"=>"required",
            "email"=>"required|unique:admins",
            "password"=>"required",
            "university"=>"required",
            "phone_number"=>"required",
            "birth_day"=>"required",
            "city"=>"required",
            "branch"=>"required",
            "date_of_job"=>"required",
            "bank_account_name",
            "bank_account_details",
            "certifcates"=>"required"
        ]);
        $admin=new Admin();
        $admin->first_name=$request->first_name;
        $admin->middle_name=$request->middle_name;
        $admin->last_name=$request->last_name;
        $admin->email=$request->email;
        $admin->password=Hash::make($request->password);
        $admin->university=$request->university;
        $admin->phone_number=$request->phone_number;
        $admin->birth_day=$request->birth_day;
        $admin->city=$request->city;
        $admin->branch=$request->branch;
        $admin->date_of_job=$request->date_of_job;
        $admin->bank_account_name=$request->bank_account_name;
        $admin->bank_account_details=$request->bank_account_details;
        $admin->certifcates=$request->certifcates;
        $admin->save();
        return response()->json([
            "status"=>200,
            "message"=>"admin registerd successfuly"
        ]);
           }
           public function AdminLogin(Request $request){
            $request->validate([
                "email"=>"required",
            "password"=>"required",
            ]);
            $admin = Admin::where("email", "=", $request->email)->first();

            if(isset($admin->id)){
    
                if(Hash::check($request->password, $admin->password)){
    
                    // create a token
                    $token = $admin->createToken("admin_api")->plainTextToken;
    
                    /// send a response
                    return response()->json([
                        "status" => 200,
                        "message" => "admin logged in successfully",
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
                    "message" => "admin not found"
                ], 404);
            }
           }
           public function AdminLogout(){
            auth()->guard('admin_api')->Logout();
            return response()->json([
                "status"=>200,
                "massege"=>"admin logged out successfuly"
            ]);
           }
           public function AdminProfile($id){
            $admin_data=Admin::where("id",$id)->get();
            
            return response()->json([
                "massege"=>"admin profile"
               , $admin_data
            ]);
           }
           public function AddEmployee(Request $request,$id1,$id2){
            $request->validate([
                "first_name"=>"required",
                "middle_name"=>"required",
                "last_name"=>"required",
                "email"=>"required|unique:admins",
                "password"=>"required",
                "university"=>"required",
                "phone_number"=>"required",
                "birth_day"=>"required",
                "city"=>"required",
                "branch"=>"required",
                "department"=>"required",
                "job_title"=>"required",
                "date_of_job"=>"required",
                "basic_salary"=>"required",
                "bank_account_name",
                "bank_account_details",
                "certifcates"=>"required"
            ]);
            if(CompanyBranche::where("id",$id1)->exists()&&Department::where("id",$id2)->exists()){
            $employee=new Employee();
            $employee->first_name=$request->first_name;
            $employee->middle_name=$request->middle_name;
            $employee->last_name=$request->last_name;
            $employee->email=$request->email;
            $employee->password=Hash::make($request->password);
            $employee->university=$request->university;
            $employee->phone_number=$request->phone_number;
            $employee->birth_day=$request->birth_day;
            $employee->city=$request->city;
            $employee->branch=$request->branch;
            $employee->department=$request->department;
            $employee->job_title=$request->job_title;
            $employee->date_of_job=$request->date_of_job;
            $employee->basic_salary=$request->basic_salary;
            $employee->bank_account_name=$request->bank_account_name;
            $employee->bank_account_details=$request->bank_account_details;
            $employee->certifcates=$request->certifcates;
            $employee->branch_id=$id1;
            $employee->department_id=$id2;
            $employee->save();
            return response()->json([
                "status"=>200,
                "message"=>"employee added successfuly"
            ]);
            
        }
        else{
            return response()->json([
                "status"=>404,
                "message"=>"not found"
                       ]);
        }

           }

           public function EmployeeProfile($id){
            $employee_data=Employee::where("id",$id)->get();
            
            return response()->json([
                "massege"=>"employee profile"
               , $employee_data
            ]);
           }
           public function GetAllEmployees(){
            $employees=Employee::select("first_name","email","branch","department","job_title","date_of_job")->get();
            return response()->json([
                "message"=>"employees",$employees
            ]);
           }

           public function UpdateEmployee(Request $request,$id){
            if(Employee::where("id",$id)->exists()){
                $employee=Employee::find($id);
                $employee->first_name=!empty($request->first_name)?$request->first_name:$employee->first_name;
            $employee->middle_name=!empty($request->middle_name)?$request->middle_name:$employee->middle_name;
            $employee->last_name=!empty($request->last_name)?$request->last_name:$employee->last_name;
            $employee->email=!empty($request->email)?$request->email:$employee->email;
            $employee->password=!empty(bcrypt($request->password))?bcrypt($request->password):$employee->password;
            $employee->university=!empty($request->university)?$request->university:$employee->university;
            $employee->phone_number=!empty($request->phone_number)?$request->phone_number:$employee->phone_number;
            $employee->birth_day=!empty($request->birth_day)?$request->birth_day:$employee->birth_day;
            $employee->city=!empty($request->city)?$request->city:$employee->city;
            $employee->branch=!empty($request->branch)?$request->branch:$employee->branch;
            $employee->department=!empty($request->department)?$request->department:$employee->department;
            $employee->job_title=!empty($request->job_title)?$request->job_title:$employee->job_title;
            $employee->date_of_job=!empty($request->date_of_job)?$request->date_of_job:$employee->date_of_job;
            $employee->basic_salary=!empty($request->basic_salary)?$request->basic_salary:$employee->basic_salary;
            $employee->bank_account_name=!empty($request->bank_account_name)?$request->bank_account_name:$employee->bank_account_name;
            $employee->bank_account_details=!empty($request->bank_account_details)?$request->bank_account_details:$employee->bank_account_details;
            $employee->certifcates=!empty($request->certifcates)?$request->certifcates:$employee->certifcates;
           
            $employee->save();
            return response()->json([
                "status"=>200,
                "message"=>"employee updated successfuly"
            ]);
            }
            else {
                return response()->json([
                    "status" => 404,
                    "message" => "Employee not found"
                ], 404);
            }
           }
           public function DeleteEmployee($id){
            $delete=Employee::where("id",$id)->delete();
            return response()->json([
"status"=>200,
"message"=>"employee deleted successfuly"
            ]);
           }
           public function EmployeesFiltersByBranches($id){
            $branch_employees=Employee::where("branch_id",$id)->get();
            return response()->json([
                "status"=>200,
                "message"=>$branch_employees
                            ]);
           }

           public function EmployeesFiltersByDepartments($id){
            $branch_employees=Employee::where("department_id",$id)->get();
            return response()->json([
                "status"=>200,
                "message"=>$branch_employees
                            ]);
           }
           
}
