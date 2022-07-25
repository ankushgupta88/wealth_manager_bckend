<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\MemberService;
use App\Models\Firms;

class SearchMemberController extends Controller
{
    //Function for search sidebar  
    public function sidebarFilterResult(Request $request)
    {  
        //Get Firm list
        $firm_list = Firms::Select('id','name','status')
                                ->Where('status', 'Active')
                                ->get();

        ////Get designation
        $professional_designation_list = User::Select('profession_name')
                                                ->Where('user_type', 'Advisor')
                                                //->Where('user_status', 'Active')
                                                ->whereNotNull('profession_name')
                                                ->groupBy('profession_name')
                                                ->get();


        //Get Member Service List 
        $member_service_list = MemberService::get();

        //Final Result List
        $final_result_list = array(
                        "firm_list" => $firm_list,
                        "professional_designation_list" => $professional_designation_list,
                        "member_service_list" => $member_service_list,
                    );
        //Check if result is exits or not
        if(count($professional_designation_list) >= 1 OR count($member_service_list) >= 1 OR count($firm_list) >= 1){
            return response()->json([
                        "status"  => 200,
                        "message" => "Success",
                        "data"    => $final_result_list, 
                    ], 200);
        } else {
            return response()->json([
                    "status"  => 201,
                    "message" => "No Record Found.",
                    "data"    => [], 
                ], 201);
        }
    }

    //Function for search filter Result  
    public function searchFilterResult(Request $request)
    { 
        //Get Request
        $service_name = $request->service_name;
        $member_name = $request->member_name;
        //Check request 
        $members = [];
        if($request->filled('member_name') AND $request->filled('service_name')){
            //Get Service According to Service name
            $services = MemberService::Select('id','name','status')
                            //->Where('status', 'Active')
                            ->Where('name', $service_name)
                            ->with('userAssignServicesList')
                            ->get();

            //Check if Services is exits or not
            $service_user_ids = [];
            if(count($services) >= 1 ){
            //For store user ids in array
                foreach($services[0]->userAssignServicesList as $service){
                    $service_user_ids[] =  $service->user_id;

                }
            }
            //Get Member List
            $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->where('name', $member_name)
                        ->whereIn('id', $service_user_ids)
                        ->get();
        } elseif($request->filled('member_name')){
            //Get Member List
            $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->where('name', $member_name)
                        ->get(); 
        } elseif($request->filled('service_name')){
            //Get Service According to Service name
            $services = MemberService::Select('id','name','status')
                            ->Where('status', 'Active')
                            ->Where('name', $service_name)
                            ->with('userAssignServicesList')
                            ->get();

            //Check if Services is exits or not
            $service_user_ids = [];
            if(count($services) >= 1 ){
            //For store user ids in array
                foreach($services[0]->userAssignServicesList as $service){
                    $service_user_ids[] =  $service->user_id;

                }
            }
            //Get Member List
            $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->whereIn('id', $service_user_ids)
                        ->get(); 
        } else {
            //Get Member List
            $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->get(); 
        }
        
        //Count members
        $member_details = [];
        if(count($members) >= 1){
            foreach($members as $user) {
                $member_detail = array( 
                    "id" => $user->id,
                    "name" => $user->name,
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
                    "company" => $user->company,
                    "experience" => $user->experience,
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,
                );

                $member_details[] = $member_detail;
            }

            //Final Result List
            $final_result_list = array(
                            "viewing_agent_count" => count($members),
                            "member_list" => $member_details,
                        );

            //Return resonce
            return response()->json([
                        "status"  => 200,
                        "message" => "Success",
                        "data"    => $final_result_list, 
                    ], 200);
        } else {
            return response()->json([
                    "status"  => 201,
                    "message" => "No Record Found.",
                    "data"    => [], 
                ], 201);
        }
    }

    //Function for submit Sidebar Filter Result
    public function submitSidebarFilterResult(Request $request)
    { 
        //Get Request
        $member_name = $request->member_name;
        $firm_name = $request->firm_name;
        $designation_name = $request->designation_name;
        $service_name = $request->service_name;

        //Check request and set condition according to url request
        $members = [];
        if($request->filled('member_name') AND $request->filled('firm_name') AND $request->filled('designation_name') AND $request->filled('service_name')){
            //Get Service According to Service name
            $services = MemberService::Select('id','name','status')
                            ->Where('status', 'Active')
                            ->Where('name', $service_name)
                            ->with('userAssignServicesList')
                            ->get();

            //Check if Services is exits or not
            $service_user_ids = [];
            if(count($services) >= 1 ){
                //For store user ids in array
                foreach($services[0]->userAssignServicesList as $service){
                    $service_user_ids[] =  $service->user_id;

                }
            }

           //Get Firm id with use firm name
            $firm = Firms::Select('id','name','status')
                                ->Where('status', 'Active')
                                ->Where('name', $firm_name)
                                ->get();
            //Check if Firm Is Exits
            if(count($firm) >= 1){ 
                //Get Member List
                $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->where('name', $member_name)
                        ->where('firm_id', $firm[0]['id'])
                        ->where('profession_name', $designation_name)
                        ->whereIn('id', $service_user_ids)
                        ->get();
            } 
        } elseif($request->filled('member_name') AND $request->filled('firm_name') AND $request->filled('designation_name')){
            //Get Firm id with use firm name
            $firm = Firms::Select('id','name','status')
                                ->Where('status', 'Active')
                                ->Where('name', $firm_name)
                                ->get();
            //Check if Firm Is Exits
            if(count($firm) >= 1){ 
                //Get Member List
                $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->where('name', $member_name)
                        ->where('firm_id', $firm[0]['id'])
                         ->where('profession_name', $designation_name)
                        ->get();
            } 
        } elseif($request->filled('member_name') AND $request->filled('firm_name')){
            //Get Firm id with use firm name
            $firm = Firms::Select('id','name','status')
                                ->Where('status', 'Active')
                                ->Where('name', $firm_name)
                                ->get();
            //Check if Firm Is Exits
            if(count($firm) >= 1){ 
                //Get Member List
                $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->where('name', $member_name)
                        ->where('firm_id', $firm[0]['id'])
                        ->get();
            } 
        } elseif($request->filled('member_name') AND $request->filled('designation_name')){
            //Get Member List
            $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->where('name', $member_name)
                        ->where('profession_name', $designation_name)
                        ->get(); 
        } elseif($request->filled('member_name') AND $request->filled('service_name')){
            //Get Service According to Service name
            $services = MemberService::Select('id','name','status')
                            ->Where('status', 'Active')
                            ->Where('name', $service_name)
                            ->with('userAssignServicesList')
                            ->get();

            //Check if Services is exits or not
            $service_user_ids = [];
            if(count($services) >= 1 ){
                //For store user ids in array
                foreach($services[0]->userAssignServicesList as $service){
                    $service_user_ids[] =  $service->user_id;

                }
            }

            //Get Member List
            $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->where('name', $member_name)
                        ->whereIn('id', $service_user_ids)
                        ->get();
        } elseif($request->filled('firm_name') AND $request->filled('designation_name')){
            //Get Firm id with use firm name
            $firm = Firms::Select('id','name','status')
                                ->Where('status', 'Active')
                                ->Where('name', $firm_name)
                                ->get();
            //Check if Firm Is Exits
            if(count($firm) >= 1){ 
                //Get Member List
                $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->where('firm_id', $firm[0]['id'])
                        ->where('profession_name', $designation_name)
                        ->get();
            } 
        } elseif($request->filled('firm_name') AND $request->filled('service_name')){
            //Get Service According to Service name
            $services = MemberService::Select('id','name','status')
                            ->Where('status', 'Active')
                            ->Where('name', $service_name)
                            ->with('userAssignServicesList')
                            ->get();

            //Check if Services is exits or not
            $service_user_ids = [];
            if(count($services) >= 1 ){
                //For store user ids in array
                foreach($services[0]->userAssignServicesList as $service){
                    $service_user_ids[] =  $service->user_id;

                }
            }

            //Get Firm id with use firm name
            $firm = Firms::Select('id','name','status')
                                ->Where('status', 'Active')
                                ->Where('name', $firm_name)
                                ->get();
            //Check if Firm Is Exits
            if(count($firm) >= 1){ 
                //Get Member List
                $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->where('firm_id', $firm[0]['id'])
                        ->whereIn('id', $service_user_ids)
                        ->get();
            } 
        } elseif($request->filled('designation_name') AND $request->filled('service_name')){
            //Get Service According to Service name
            $services = MemberService::Select('id','name','status')
                            ->Where('status', 'Active')
                            ->Where('name', $service_name)
                            ->with('userAssignServicesList')
                            ->get();

            //Check if Services is exits or not
            $service_user_ids = [];
            if(count($services) >= 1 ){
            //For store user ids in array
                foreach($services[0]->userAssignServicesList as $service){
                    $service_user_ids[] =  $service->user_id;

                }
            }
            //Get Member List
            $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->where('profession_name', $designation_name)
                        ->whereIn('id', $service_user_ids)
                        ->get();
        } elseif($request->filled('member_name') ){
            //Get Member List
            $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->where('name', $member_name)
                        ->get(); 
        } elseif($request->filled('firm_name') ){ 
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
        } elseif($request->filled('designation_name') ){
            //Get Member List
            $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->where('profession_name', $designation_name)
                        ->get(); 
        } elseif($request->filled('service_name') ){
            //Get Service According to Service name
            $services = MemberService::Select('id','name','status')
                            ->Where('status', 'Active')
                            ->Where('name', $service_name)
                            ->with('userAssignServicesList')
                            ->get();

            //Check if Services is exits or not
            $service_user_ids = [];
            if(count($services) >= 1 ){
            //For store user ids in array
                foreach($services[0]->userAssignServicesList as $service){
                    $service_user_ids[] =  $service->user_id;

                }
            }
            //Get Member List
            $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->whereIn('id', $service_user_ids)
                        ->get();
        } else {
            //Get Member List
            $members = User::where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->get(); 
        }
        
        //Count members
        $member_details = [];
        if(count($members) >= 1){
            foreach($members as $user) {
                $member_detail = array( 
                    "id" => $user->id,
                    "name" => $user->name,
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
                    "company" => $user->company,
                    "firm_id" => $user->firm_id,
                    "experience" => $user->experience,
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,
                );

                $member_details[] = $member_detail;
            }

            //Final Result List
            $final_result_list = array(
                            "viewing_agent_count" => count($members),
                            "member_list" => $member_details,
                        );

            //Return resonce
            return response()->json([
                        "status"  => 200,
                        "message" => "Success",
                        "data"    => $final_result_list, 
                    ], 200);
        } else {
            return response()->json([
                    "status"  => 201,
                    "message" => "No Record Found.",
                    "data"    => [], 
                ], 201);
        }
    }
}
