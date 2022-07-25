<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\City;

class CityController extends Controller
{
    //Function for show city list  
    public function index(Request $request)
    {  
        $cities = City::orderBy('id', 'ASC')->limit(8)->get(); 

        //Count city
        $city_list = [];
        if(count($cities) >= 1){
            foreach($cities as $city) { 
                $city_detail = array(
                        "id" => $city->id,
                        "name" => $city->name,
                        "image" => asset('public/upload/city').'/'.$city->image,
                        "created_at" => $city->created_at,
                        "updated_at" => $city->updated_at,
                );

                $city_list[] = $city_detail;
            } 
            
            return response()->json([
                        "status"  => 200,
                        "message" => "Success",
                        "data"    => $city_list, 
                    ], 200);
        } else {
            return response()->json([
                    "status"  => 201,
                    "message" => "No Record Found.",
                    "data"    => $city_list, 
                ], 201);
        }
    }
}
