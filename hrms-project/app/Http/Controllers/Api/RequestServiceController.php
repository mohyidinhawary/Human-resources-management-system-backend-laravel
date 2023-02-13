<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RequestService;
use Illuminate\Http\Request;

class RequestServiceController extends Controller
{
    public function CraeteRequestService(Request $request,$id1)
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
            "details"=>"required",
            
        ]);

        // employee id + create data
        

        $service = new RequestService();

        $service->admin_id = $id1;
        $service->employee_id =auth()->user()->id ;
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
        $service=RequestService::where("id",$id)->exists();
            if(!$service){
                return response()->json([
                    "status"=>404,
                    "message"=>"not found"
                            ]);
            }
            else{
                $service=RequestService::find($id);
    
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
        RequestService::where("id",$id)->delete();
        return response()->json([
"status"=>200,
"message"=>"requested service deleted successfuly"
        ]);
       }
       public function ShowEmployeeRequestedServices(){
        $id=auth()->user()->id;
       if( $employee_requested_services=RequestService::where("employee_id",$id)->
        select("first_name","vacation","transfer","promotion","complaining","resignation","subject","details")
        ->get())
        {
        return response()->json([
            "status"=>200,
            "message"=>$employee_requested_services
                    ]);
       }
       return response()->json([
        "status"=>200,
        "message"=>"empty"
                ]);
    }
    public function AdminRequestAccept(Request $request,$id1,$id2){
        $request->validate([
            "accept"=>"",
            
        ]);
$accept=RequestService::where('id',$id1)->where('employee_id',$id2)->first();
$accept->accept=$request->accept;
$accept->save();
return response()->json([
    "status"=>200,
    "message"=>"request answered successfuly"
            ]);
    }

    public function ShowAdminMailServices(){
         $admin_mail_services=RequestService::
         select("employee_id","first_name","vacation","transfer","promotion","complaining","resignation","subject","details","accept")
         ->get();
         
         return response()->json([
             "status"=>200,
             "message"=>$admin_mail_services
                     ]);
        }

        public function ShowEmployeeRequestedServicesAnswered(){
            $id=auth()->user()->id;
            if( $employee_requested_services_answered=RequestService::where("employee_id",$id)->wherenot("accept",null)->
             select("first_name","vacation","transfer","promotion","complaining","resignation","subject","details","accept")
             ->get())
             {
             return response()->json([
                 "status"=>200,
                 "message"=>$employee_requested_services_answered
                         ]);
            }
            return response()->json([
             "status"=>200,
             "message"=>"empty"
                     ]);
         }
        
     }

