<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Models\Employee;
class HolidayController extends Controller
{
    public function AddHoliday(Request $request){
        $request->validate([
            "day"=>"required",
            "date"=>"required",
            "start_date"=>"required",
            "end_date"=>"required",
            "occasion"=>"required"
        ]);
        $holiday=new Holiday();
        $holiday->day=$request->day;
        $holiday->date=$request->date;
        $holiday->start_date=$request->start_date;
        $holiday->end_date=$request->end_date;
        $holiday->occasion=$request->occasion;
        
        $holiday->save();
        return response()->json([
"status"=>200,
"message"=>"holiday added successfuly"
        ]);
    }
    public function ShowHolidays(){
        $holidays=Holiday::get();
        return response()->json([
            "status"=>200,
            "message"=>"holidays", $holidays
                    ]);
    }
   



    public function UpdateHoliday(Request $request,$id){
        $holiday=Holiday::where("id",$id)->exists();
            if(!$holiday){
                return response()->json([
                    "status"=>404,
                    "message"=>"not found"
                            ]);
            }
            else{
                $holiday=Holiday::find($id);
                $holiday->day=!empty($request->day)?$request->day:$holiday->day;
            $holiday->date=!empty($request->date)?$request->date:$holiday->date;
            $holiday->start_date=!empty($request->start_date)?$request->start_date:$holiday->start_date;
            $holiday->end_date=!empty($request->end_date)?$request->end_date:$holiday->end_date;
            $holiday->occasion=!empty($request->occasion)?$request->occasion:$holiday->occasion;
            $holiday->save();
            return response()->json([
                "status"=>200,
                "message"=>"holiday updated successfuly"
                        ]);
    }
    }
}
