<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\Employee;
class DiscountController extends Controller
{
    public function AddDiscount(Request $request,$id){
        $request->validate([
            "discount_date"=>"required",
            "loan"=>"",
            "absence"=>"",
            "late"=>"",
            "early_leaving"=>"",
            "discount_amount"=>"required",
            "discount_details"=>"required"
        ]);
        $employee=Employee::where("id",$id)->exists();
        if(!$employee){
            return response()->json([
                "status"=>404,
                "message"=>"not found"
                        ]);
        }
        else{
        $discount=new Discount();
        $discount->employee_id=$id;
        $discount->discount_date=$request->discount_date;
        $discount->loan=$request->loan;
        $discount->absence=$request->absence;
        $discount->late=$request->late;
        $discount->early_leaving=$request->early_leaving;
        $discount->discount_amount=$request->discount_amount;
        $discount->discount_details=$request->discount_details;
        $discount->save();
        return response()->json([
"status"=>200,
"message"=>"discount done successfuly"
        ]);
    }
}
public function ShowDiscounts(){
    $discounts=Discount::get();
    return response()->json([
        "status"=>200,
        "message"=>"discounts", $discounts
                ]);
}
public function ShowEmployeeDiscounts($id){
    $employee_discounts=Discount::where("employee_id",$id)->get();
    return response()->json([
        "status"=>200,
        "message"=>"discounts", $employee_discounts
                ]);
}
public function UpdateDiscount(Request $request,$id){
    $discount=Discount::where("id",$id)->exists();
        if(!$discount){
            return response()->json([
                "status"=>404,
                "message"=>"not found"
                        ]);
        }
        else{
            $discount=Discount::find($id);
            $discount->discount_date=!empty($request->discount_date)?$request->discount_date:$discount->discount_date;
        $discount->loan=!empty($request->loan)?$request->loan:$discount->loan;
        $discount->absence=!empty($request->absence)?$request->absence:$discount->absence;
        $discount->late=!empty($request->late)?$request->late:$discount->late;
        $discount->early_leaving=!empty($request->early_leaving)?$request->early_leaving:$discount->early_leaving;
        $discount->discount_amount=!empty($request->discount_amount)?$request->discount_amount:$discount->discount_amount;
        $discount->discount_details=!empty($request->discount_details)?$request->discount_details:$discount->discount_details;
        $discount->save();
        return response()->json([
            "status"=>200,
            "message"=>"discount updated successfuly"
                    ]);
}
}
public function TotalDiscounts($id){
    $total_discounts=Discount::where('employee_id',$id)->sum("discount_amount");
    return response()->json([
        "status"=>200,
        "message"=>$total_discounts
                ]);
}
}
