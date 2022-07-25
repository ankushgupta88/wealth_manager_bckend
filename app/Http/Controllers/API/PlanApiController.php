<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;


class PlanApiController extends Controller
{   
    //show Plan as Active
    public function showPlanList(Request $request )
    {   
        $Plan = Plan::where('Status','=', 'Active')->get();
        
        if($Plan){
            return response()->json([
                "status"  => 200,
                "message" => "Successfully.",
                "data"    => $Plan, 
            ], 200);
        } else {
            return response()->json([
                "status"  => 201,
                "message" => "UnSuccessfully!",
                "data"    => "", 
            ], 201);
        }
    }
}
