<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Firms;
use App\Models\City;
use App\Models\MemberService;

class CitySearchController extends Controller
{
    //Function for advisor search according to city 
    public function index(Request $request)
    {  
        //Get Request
        $city_name = $request->city_name;

        $members = User::Where('user_type', 'Advisor')
                //->Where('user_status', 'Active')
                ->Where('city', $city_name)
                ->get();

        //Count members
        $final_result_list = [];
        $member_details = [];
        $user_list_according_city_name = [];
        if(count($members) >= 1){
            foreach($members as $user) { 
                //User List According to city name
                $according_city_name = array(
                    "id" => $user->id,
                    "name" => $user->name,
                    "avatar" => asset('public/upload/user').'/'.$user->avatar,
                );

                //User List 
                $member_detail = array( 
                    "id" => $user->id,
                    "name" => $user->name,
                    "avatar" => asset('public/upload/user').'/'.$user->avatar,
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
                    "company" => $user->company,
                    "experience" => $user->experience,
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,
                );

                $user_list_according_city_name[] = $according_city_name;
                $member_details[] = $member_detail;
            } 

            //Get Firm List 
            $firm_list = Firms::Select('id','name','status')
                                ->Where('status', 'Active')
                                ->get();

            //Get City List 
            $city_list = City::get();

            //Get Member Service List 
            $member_service_list = MemberService::inRandomOrder()->limit(6)->get();

            //Final Result List
            $final_result_list = array(
                            "member_service_list" => $member_service_list,
                            "user_list_according_city_name" => $user_list_according_city_name,
                            "firm_list" => $firm_list,
                            "city_list" => $city_list,
                            "member_list" => $member_details,
                        );
            
            return response()->json([
                        "status"  => 200,
                        "message" => "Success",
                        "data"    => $final_result_list, 
                    ], 200);
        } else {
            return response()->json([
                    "status"  => 201,
                    "message" => "No Record Found.",
                    "data"    => $final_result_list, 
                ], 201);
        }
    }

    //Function for advisor search according to Advisor name, Firm name, City name 
    public function advisorFirmCitySearch(Request $request)
    {  
        //Get Request
        $advisor_name = $request->advisor_name;
        $firm_name = $request->firm_name;
        $city_name = $request->city_name;

        //Check request 
        $members = [];
        if($request->filled('advisor_name') AND $request->filled('firm_name') AND $request->filled('city_name')){
            //Get Firm id with use firm name
            $firm = Firms::Select('id','name','status')
                                ->Where('status', 'Active')
                                ->Where('name', $firm_name)
                                ->get();
            //Check if Firm Is Exits
            if(count($firm) >= 1){
                //Get Member List
                $members = User::Where('user_type', 'Advisor')
                        //->Where('user_status', 'Active')
                        ->Where('name', $advisor_name)
                        ->Where('firm_id', $firm[0]['id'])
                        ->Where('city', $city_name)
                        ->get();
            } else {
                //Get Member List
                $members = User::Where('user_type', 'Advisor')
                        //->Where('user_status', 'Active')
                        ->Where('name', $advisor_name)
                        ->Where('city', $city_name)
                        ->get();
            }
        } elseif($request->filled('advisor_name') AND $request->filled('firm_name')){
            //Get Firm id with use firm name
            $firm = Firms::Select('id','name','status')
                                ->Where('status', 'Active')
                                ->Where('name', $firm_name)
                                ->get();
            //Check if Firm Is Exits
            if(count($firm) >= 1){ 
                //Get Member List
                $members = User::Where('user_type', 'Advisor')
                        //->Where('user_status', 'Active')
                        ->Where('name', $advisor_name)
                        ->Where('firm_id', $firm[0]['id'])
                        ->get();
            } else {
                //Get Member List
                $members = User::Where('user_type', 'Advisor')
                        //->Where('user_status', 'Active')
                        ->Where('name', $advisor_name)
                        ->get();
            }
        } elseif($request->filled('advisor_name') AND $request->filled('city_name')){
            //Get Member List
            $members = User::Where('user_type', 'Advisor')
                        //->Where('user_status', 'Active')
                        ->Where('name', $advisor_name)
                        ->Where('city', $city_name)
                        ->get();
        } elseif($request->filled('firm_name') AND $request->filled('city_name')){
            //Get Firm id with use firm name
            $firm = Firms::Select('id','name','status')
                                ->Where('status', 'Active')
                                ->Where('name', $firm_name)
                                ->get();
            //Check if Firm Is Exits
            if(count($firm) >= 1){ 
                //Get Member List
                $members = User::Where('user_type', 'Advisor')
                            //->Where('user_status', 'Active')
                            ->Where('firm_id', $firm[0]['id'])
                            ->Where('city', $city_name)
                            ->get();
            } else {
                //Get Member List
                $members = User::Where('user_type', 'Advisor')
                            //->Where('user_status', 'Active')
                            ->Where('city', $city_name)
                            ->get();
            }
        } elseif($request->filled('advisor_name')){
            //Get Member List
            $members = User::Where('user_type', 'Advisor')
                            //->Where('user_status', 'Active')
                            ->Where('name', $advisor_name)
                            ->get();
        } elseif($request->filled('firm_name')){ 
            //Get Firm id with use firm name
            $firm = Firms::Select('id','name','status')
                                ->Where('status', 'Active')
                                ->Where('name', $firm_name)
                                ->get();
            //Check if Firm Is Exits
            if(count($firm) >= 1){ 
                //Get Member List
                $members = User::Where('user_type', 'Advisor')
                            //->Where('user_status', 'Active')
                            ->Where('firm_id', $firm[0]['id'])
                            ->get();
            }
        }  elseif($request->filled('city_name')){
            //Get Member List
            $members = User::Where('user_type', 'Advisor')
                            //->Where('user_status', 'Active')
                            ->Where('city', $city_name)
                            ->get();
        } else {
            //Get Member List
            $members = User::Where('user_type', 'Advisor')
                            //->Where('user_status', 'Active')
                            ->get();
        }
        
        //Count members
        $member_details = [];
        if(count($members) >= 1){
            foreach($members as $user) { 
                //User List 
                $member_detail = array( 
                    "id" => $user->id,
                    "name" => $user->name,
                    "avatar" => asset('public/upload/user').'/'.$user->avatar,
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
                    "company" => $user->company,
                    "firm_id" => $user->firm_id,
                    "experience" => $user->experience,
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,
                );

                $member_details[] = $member_detail;
            } 
            
            return response()->json([
                        "status"  => 200,
                        "message" => "Success",
                        "data"    => $member_details, 
                    ], 200);
        } else {
            return response()->json([
                    "status"  => 201,
                    "message" => "No Record Found.",
                    "data"    => $member_details, 
                ], 201);
        }
    }
}
