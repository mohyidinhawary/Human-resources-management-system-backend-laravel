<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MailService;
use Illuminate\Http\Request;

class MailServiceController extends Controller
{
    public function CraeteRequestService(Request $request)
    {
        // validation
        $request->validate([
            "first_name"=>"required",
            "vacation"=>"",
            "transfer"=>"",
            "promotion"=>"",
            "complaining"=>"",
            "resignation"=>"",
            "subject"=>"required",
            "details"=>"required"
        ]);

        // employee id + create data
        $employee_id = auth()->user()->id;

        $service = new MailService();

        $service->employee_id = $employee_id;
        $service->first_name = $request->first_name;
        $service->vacation = $request->vacation;
        $service->transfer = $request->transfer;
        $service->promotion = $request->promotion;
        $service->complaining = $request->complaining;
        $service->resignation = $request->resignation;
        $service->subject = $request->subject;
        $service->details = $request->details;

        $service->save();


        // send response
        return response()->json([
            "status" => 1,
            "message" => "request service has been created successfuly"
        ]);
    }

    public function UpdateRequestService(Request $request,$id){
        $service=MailService::where("id",$id)->exists();
            if(!$service){
                return response()->json([
                    "status"=>404,
                    "message"=>"not found"
                            ]);
            }
            else{
                $service=MailService::find($id);
    
            $service->first_name=!empty($request->first_name)?$request->first_name:$service->first_name;
            $service->vacation=!empty($request->vacation)?$request->vacation:$service->vacation;
            $service->transfer=!empty($request->transfer)?$request->transfer:$service->transfer;
            $service->promotion=!empty($request->promotion)?$request->promotion:$service->promotion;
            $service->complaining=!empty($request->complaining)?$request->complaining:$service->complaining;
            $service->resignation=!empty($request->resignation)?$request->resignation:$service->resignation;
            $service->subject=!empty($request->subject)?$request->subject:$service->subject;
            $service->details=!empty($request->details)?$request->details:$service->details;
            $service->save();
            return response()->json([
                "status"=>200,
                "message"=>"requested service updated successfuly"
                        ]);
    }
    }

    public function DeleteRequstedService($id){
        MailService::where("id",$id)->delete();
        return response()->json([
"status"=>200,
"message"=>"requested service deleted successfuly"
        ]);
       }
}

