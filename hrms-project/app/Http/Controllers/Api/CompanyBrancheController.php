<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyBranche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CompanyBrancheController extends Controller
{
    public function AddBranch(Request $request){
        $request->validate([
            "branch_name"=>"required",
        ]);
            $branch=new CompanyBranche();
            $branch->branch_name=$request->branch_name;
            $branch->save();
            return response()->json([
                "status"=>200,
                "message"=>"branch added successfuly"
            ]);
    }

    public function GetAllBranches(){
        $branches=DB::table("company_branches")->get();
        return response()->json([
            "message"=>"branches",$branches
        ]);
       }

       public function UpdateBranch(Request $request,$id){
        if(CompanyBranche::where("id",$id)->exists()){
            $branch=CompanyBranche::find($id);
            $branch->branch_name=!empty($request->branch_name)?$request->branch_name:$branch->branch_name;
        
        $branch->save();
        return response()->json([
            "status"=>200,
            "message"=>"branch updated successfuly"
        ]);
        }
        else {
            return response()->json([
                "status" => 404,
                "message" => "branch not found"
            ], 404);
        }
       }
       public function DeleteBranch($id){
        $delete=CompanyBranche::where("id",$id)->delete();
        return response()->json([
"status"=>200,
"message"=>"branch deleted successfuly"
        ]);
       }
}
