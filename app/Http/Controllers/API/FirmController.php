<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Firms;

class FirmController extends Controller
{
    //Function for show firm list 
    public function firmList(Request $request)
    {  
        $firms = Firms::where('status', 'Active')
                                ->inRandomOrder()
                                ->with('firmAssignServices')   
                                ->limit(10)
                                ->get(); 

        //count firms
        $firm_list = [];
        if(count($firms) >= 1){
            foreach($firms as $firm) { 
                //For services details
                $firm_services = [];
                foreach($firm->firmAssignServices as $service){
                    $services = array(   
                           "id" => $service->firmAssignServicesDetails->id,
                            "name" => $service->firmAssignServicesDetails->name,
                            "status" => $service->firmAssignServicesDetails->status,
                            "created_at" => $service->firmAssignServicesDetails->created_at,
                            "updated_at" => $service->firmAssignServicesDetails->updated_at,
                    );

                    $firm_services[] = $services;
                }
                
                    $firm_detail = array(
                            "id" => $firm->id,
                            "name" => $firm->name,
                            "logo" => asset('public/upload/firm').'/'.$firm->logo,
                            "status" => $firm->status,
                            "prsnl_website" => $firm->prsnl_website,
                            "cover_color" => $firm->cover_color,
                            "twitter" => $firm->twitter,
                            "linked_in" => $firm->linked_in,
                            "quote_info" => $firm->quote_info,
                            "phone_number" => $firm->phone_number,
                            "address1" => $firm->address1,
                            "city" => $firm->city,
                            "postal_code" => $firm->postal_code,
                            "country_code" => $firm->country_code,
                            "state_code" => $firm->state_code,
                            "biography" => $firm->biography,
                            "created_at" => $firm->created_at,
                            "updated_at" => $firm->updated_at,
                            "viewing_agents" => [],
                            "professional_services" => $firm_services,
                    );

                $firm_list[] = $firm_detail;
            } 
            
            return response()->json([
                        "status"  => 200,
                        "message" => "Success",
                        "data"    => $firm_list, 
                    ], 200);
        } else {
            return response()->json([
                    "status"  => 201,
                    "message" => "No Record Found.",
                    "data"    => $firm_list, 
                ], 201);
        }
    }


    //Function for show single firm details
    public function singleFirmDetail(Request $request)
    {  
        $firm_id = $request->id;
       
        $firms = Firms::where('id', $firm_id)
                                ->where('status', 'Active')
                                ->with('firmAssignServices')   
                                ->with('firmAssignUserDetail')   
                                ->get(); 
                                
       
        //Count firm
        $firm_list = [];
        if(count($firms) >= 1){
            foreach($firms as $firm) { 
                
                //For services details
                $firm_services = [];
                foreach($firm->firmAssignServices as $service){
                    $services = array(   
                           "id" => $service->firmAssignServicesDetails->id,
                            "name" => $service->firmAssignServicesDetails->name,
                            "status" => $service->firmAssignServicesDetails->status,
                            "created_at" => $service->firmAssignServicesDetails->created_at,
                            "updated_at" => $service->firmAssignServicesDetails->updated_at,
                    );

                    $firm_services[] = $services;
                }
                
                //For firm assign user list
                $assign_user_list = [];
                foreach($firm->firmAssignUserDetail as $user){
                    $user_list = array(   
                        "id" => $user->id,
                        "name" => $user->name,
                        "email" => $user->email,
                        "mobile" => $user->mobile,
                        "avatar" => asset('public/upload/user').'/'.$user->avatar,
                        "user_type" => $user->user_type,
                        "user_status" => $user->user_status,
                        "first_name" => $user->first_name,
                        "last_name" => $user->last_name,
                        "location" => $user->location,
                        "postal_code" => $user->postal_code,
                        "listing_type" => $user->listing_type,
                        "address1" => $user->address1,
                        "address2" => $user->address2,
                        "city" => $user->city,
                        "state_code" => $user->state_code,
                        "country_code" => $user->country_code,
                        "profession_name" => $user->profession_name,
                        "user_level_type" => $user->user_level_type,
                        "company" => $user->company,
                        "prsnl_website" => $user->prsnl_website,
                        "cover_color" => $user->cover_color,
                        "twitter" => $user->twitter,
                        "linked_in" => $user->linked_in,
                        "others" => $user->others,
                        "quote_info" => $user->quote_info,
                        "biography" => $user->biography,
                        "created_at" => $user->created_at,
                        "updated_at" => $user->updated_at,
                    );

                    $assign_user_list[] = $user_list;
                }
                
                
                $firm_detail = array(
                        "id" => $firm->id,
                        "name" => $firm->name,
                        "logo" => asset('public/upload/firm').'/'.$firm->logo,
                        "status" => $firm->status,
                        "prsnl_website" => $firm->prsnl_website,
                        "cover_color" => $firm->cover_color,
                        "twitter" => $firm->twitter,
                        "linked_in" => $firm->linked_in,
                        "quote_info" => $firm->quote_info,
                        "phone_number" => $firm->phone_number,
                        "address1" => $firm->address1,
                        "city" => $firm->city,
                        "postal_code" => $firm->postal_code,
                        "country_code" => $firm->country_code,
                        "state_code" => $firm->state_code,
                        "biography" => $firm->biography,
                        "created_at" => $firm->created_at,
                        "updated_at" => $firm->updated_at,
                        "professional_services" => $firm_services,
                        "viewing_agents" => $assign_user_list,
                        "viewing_agent_count" => count($assign_user_list),
                );

                $firm_list[] = $firm_detail;
            } 
            
            return response()->json([
                        "status"  => 200,
                        "message" => "Success",
                        "data"    => $firm_list, 
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
