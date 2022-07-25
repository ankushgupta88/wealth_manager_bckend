<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use Validator;
use App\Models\User;
use App\Models\UserServices;
//use App\Models\UserFirm;
use App\Models\UserPlan;
use App\Models\Firms;

class MemberRegisterController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     
    public function index(Request $request)
    {
        //Check email exit or not
        $emailvalidator = Validator::make($request->all(), [
            'email'    => 'required|email|unique:users,email',
        ]);
        
        //Validation
        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required',
            'mobile'   => 'required',
        ]);
    
        if($emailvalidator->fails()) { 
             return response()->json([
                "status"  => 201,
                "message" => "That email address is already registered!.",
                "data"    => "", 
            ], 201);
        } elseif($validator->fails()){
            return response()->json([
                "status"  => 201,
                "message" => "Please fill all requred fields.",
                "data"    => "", 
            ], 201);
        }else {
                //Generate password
                $manual_password = Hash::make($request->password);
                
                //create new user
                $insert_user = User::create([
                    'name'  => $request->first_name." ".$request->last_name,
                    'email' =>  $request->email,
                    'user_type' => "Advisor",
                    'user_status' => "Pending",
                    'password'  => $manual_password,
                    'mobile'    => $request->mobile,  
                    'first_name'  => $request->first_name,
                    'last_name'   => $request->last_name,
                    'location'    => $request->location,
                    'postal_code' => $request->postal_code,
                ]);
        
                if($insert_user){
                    $last_insert_id = $insert_user->id;
                    
                    //Check user profile_pic files
                    if($request->hasFile('profile_pic')){
                        foreach($request->file('profile_pic') as $file){
                            $fileName = 'profile_'.time().'.'.$file->getClientOriginalExtension();
                            $upload = $file->move(public_path('/upload/user'), $fileName);
                            //update user with avatar
                            $update_user = User::where('id', $last_insert_id)
                                ->update([
                                    'avatar' =>  $fileName,
                            ]);
                        } 
                    } 

                    //Check if service list is empty
                   /* if($request->filled('services_list')){  
                        //For Insert user Service List
                        $services_list = $request->services_list;
                        $services_list_explode = explode(",",$services_list);
                        foreach($services_list_explode as $key => $val){
                            $insert_service = UserServices::create([
                                'user_id'  => $last_insert_id,
                                'member_service_id'  => $val,
                            ]);
                        }
                    }  */

                    //Check if service list is empty
                   /* if($request->filled('services_list')){ 
                        //For Insert user Service List
                        $services_list = $request->services_list;
                        $services_list_explode = explode(",",$services_list);
                        foreach($services_list_explode as $key => $val){
                            //create user services
                            $insert_user_service = UserServices::create([
                                'user_id'  => $last_insert_id,
                                'name'    => ucwords($val),  
                                'status'  => "Active",
                            ]);
                        }
                    };*/

                    //Check if firm list is empty
                    /*if($request->filled('firm_list')){ 
                        //Check firm profile_pic files
                        $firmfileName = "default_logo.png";
                        if($request->hasFile('firm_logo')){
                            foreach($request->file('firm_logo') as $file){
                                $firmfileName = 'firm_'.time().'.'.$file->getClientOriginalExtension();
                                $upload2 = $file->move(public_path('/upload/firm'), $firmfileName);
                            } 
                        }  

                        $firm_list = $request->firm_list;
                        //create user firm
                        $insert_user_firm = UserFirm::create([
                            'user_id'  => $last_insert_id,
                            'name'    => ucwords($firm_list),  
                            'status'  => "Active",
                            'logo' => $firmfileName,
                        ]);
                    };*/

                    //Chck if Other id exist in rquest
                     /*$firm_name = $request->firm_name;
                    if($firm_name == "Other"){
                        //Firm Logo
                        $firmfileName = "default_logo.png";
                        if($request->hasFile('add_firm_logo')){
                            foreach($request->file('add_firm_logo') as $file){
                                $firmfileName = 'firm_'.time().'.'.$file->getClientOriginalExtension();
                                $upload2 = $file->move(public_path('/upload/firm'), $firmfileName);
                                
                            } 
                        }

                        //Add New Firm 
                        $insert_firm = Firms::create([
                                'name' => $request->add_firm_name,    
                                'logo' => $firmfileName,    
                            ]);
                        
                        //Check if Firm is inserted or not
                        if($insert_firm){
                            $last_insert_firm_id = $insert_firm->id;
                            //update user 
                            $update_user = User::where('id', $last_insert_id) 
                                                ->update([
                                                    'firm_id' => $last_insert_firm_id,    
                                                ]);
                        }
                    } else {
                        //update user 
                        $update_user = User::where('id', $last_insert_id) 
                            ->update([
                                'firm_id' => $firm_name,    
                            ]);
                    } */

                    //create user plan
                    $insert_user_plan = UserPlan::create([
                        'user_id'  => $last_insert_id,
                        'plan_id'  => $request->plan_id,  
                        'status'   => "Active",
                    ]);

                    return response()->json([
                        "status"  => 200,
                        "message" => "Member register successfully.",
                        "data"    => $insert_user, 
                    ], 200);
                } else {
                    return response()->json([
                        "status"  => 201,
                        "message" => "Oops something wrong",
                        "data"    => "", 
                    ], 201);
                } 
        }
    }
}
