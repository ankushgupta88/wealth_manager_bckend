<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MemberService;

class ServicesController extends Controller
{
    //Function for show service list 
    public function homeServicesList(Request $request)
    {  
        $services = MemberService::where('status', 'Active')->get(); 

        //Count Services
        if(count($services) >= 1){
            return response()->json([
                        "status"  => 200,
                        "message" => "Success",
                        "data"    => $services, 
                    ], 200);
        } else {
            return response()->json([
                    "status"  => 201,
                    "message" => "No Record Found.",
                    "data"    => $firm_list, 
                ], 201);
        }
    }
}
