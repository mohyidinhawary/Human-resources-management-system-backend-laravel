<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function AddAttendance(Request $request,$id){
        $request->validate([
            "time_in"=>"required",
            "time_out"=>"required"
        ]);
            $attendance=new Attendance();
            $attendance->employee_id=$id;
            $attendance->time_in=$request->time_in;
            $attendance->time_out=$request->time_out;
            $attendance->save();
            return response()->json([
                "status"=>200,
                "message"=>"attendance added successfuly"
            ]);
    }

    public function GetAllAttendance(){
        $attendance=Attendance::get();
        return response()->json([
            "message"=>"attendance",$attendance
        ]);
       }

       public function GetEmployeeAttendance($id){
        $attendance=Attendance::where("employee_id",$id)->get();
        return response()->json([
            "message"=>"attendance",$attendance
        ]);
       }

       public function EmployeeShowAttendance(){
        $id=auth()->user()->id;
        $attendance=Attendance::where("employee_id",$id)->get();
        return response()->json([
            "message"=>"attendance",$attendance
        ]);
       }
}
