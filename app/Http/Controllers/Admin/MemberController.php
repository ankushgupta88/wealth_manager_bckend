<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use App\Imports\UsersImport;  
use Maatwebsite\Excel\Facades\Excel;

use App\Models\User;
use App\Models\UserServices;
use App\Models\UserArticle;
use App\Models\UserAvailability;
use App\Models\UserEducation;
use App\Models\UserSocialFeed;
use App\Models\UserVideo;
use App\Models\Firms;
use App\Models\MemberService;

class MemberController extends Controller
{
    //function for admin member list
    public function index(){ 
        $members = User::where('user_type', 'Advisor')->get();
        $view =  view('admin.member.member-list', compact('members') );
        return $view; 
    }

    //function for admin add member 
    public function addMember(){
        $firms = Firms::get();
        $services = MemberService::get();
        $view =  view('admin.member.add-member', compact('firms','services') );
        return $view;
    } 

    //function for admin submit member 
    public function submitMember(Request $request){
        //validation rule
        $validated = request()->validate([ 
           'first_name' => 'required',
           'last_name'   => 'required',
           'password'   => 'required', 
           'email'    => 'required|email|unique:users,email',
        ]);

        //Generate password
        $manual_password = Hash::make($request->password);
        
        //create new user
        $insert_user = User::create([
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'name'  => $request->first_name." ".$request->last_name,
            'email' =>  $request->email,
            'user_type' => "Advisor",
            'password'  => $manual_password,
            'mobile'    => $request->phone_number,  
            'address1'    => $request->address1,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'state_code' => $request->state_code,
            'country_code' => $request->country_code,
            'profession_name' => $request->profession_name,
            'user_status' => $request->user_status, 
            'user_level_type' => $request->user_level_type, 
            'company' => $request->company, 
            'firm_id' => $request->firm_name,    
            'listing_type' => $request->listing_type,    
            'prsnl_website' => $request->prsnl_website,    
            'cover_color' => $request->cover_color,    
            'twitter' => $request->twitter,    
            'linked_in' => $request->linked_in,    
            'others' => $request->others,    
            'quote_info' => $request->quote_info,  
            'biography' => $request->biography,  
            'experience' => $request->experience,  
        ]);

        if($insert_user){
            $last_insert_id = $insert_user->id;

            //update user 
            if($request->has('services')){ 
                $services_list = $request->services;
                foreach($services_list as $key => $val){
                    $insert_service = UserServices::create([
                        'user_id'  => $last_insert_id,
                        'member_service_id'  => $val,
                    ]);
                }
            }  

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

            return back()->with('success','Member Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    } 

    //function for admin edit member
    public function editMember(Request $request, $id){
        $member = User::where('id', $id)
                        ->where('user_type', 'Advisor')
                        ->with('userAssignServices')
                        ->with('userVideoList')
                        ->with('userArticleList')
                        ->with('userEducationList')
                        ->with('userAvailabilityList')
                        ->with('userAvailabilityList')
                        ->with('userSocialFeedList')
                        ->get();
        
        $firms = Firms::get();
        $services = MemberService::get();
        
        $view =  view('admin.member.edit-member', compact('member','firms','services') );
        return $view;
    } 

    //function for admin edit member test
    public function editTestMember(Request $request, $id){
        $member = User::where('id', $id)
                        ->where('user_type', 'Advisor')
                        ->with('userAssignServices')
                        ->with('userVideoList')
                        ->with('userArticleList')
                        ->with('userEducationList')
                        ->with('userAvailabilityList')
                        ->get();
        $firms = Firms::get();
        $services = MemberService::get();
        $view =  view('admin.member.edit-member-test', compact('member','firms','services') );
        return $view;
    }

    //function for admin update member Information
    public function updateMemberInformation(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'first_name' => 'required',
            'last_name'   => 'required',
        ]); 
        
        //Check user profile_pic files
        if($request->hasFile('profile_pic')){
            foreach($request->file('profile_pic') as $file){
                $fileName = 'profile_'.time().'.'.$file->getClientOriginalExtension();
                $upload = $file->move(public_path('/upload/user'), $fileName);
                //update user with avatar
                $update_user = User::where('id', $id)
                    ->update([
                        'avatar' =>  $fileName,
                ]);
            } 
        } 

        //update user
        $update_user = User::where('id', $id)
                ->update([
                    'first_name'  => $request->first_name,
                    'last_name'   => $request->last_name,
                    'name'  => $request->first_name." ".$request->last_name,
                    'mobile'    => $request->phone_number,  
                    'address1'    => $request->address1,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'state_code' => $request->state_code,
                    'country_code' => $request->country_code,
                    'profession_name' => $request->profession_name,
                    'user_status' => $request->user_status, 
                    'user_level_type' => $request->user_level_type,
                    'company' => $request->company, 
                    //'firm_id' => $request->firm_name,    
                    'listing_type' => $request->listing_type, 
                    'prsnl_website' => $request->prsnl_website,    
                    'cover_color' => $request->cover_color,    
                    'twitter' => $request->twitter,    
                    'linked_in' => $request->linked_in,    
                    'others' => $request->others, 
                    'quote_info' => $request->quote_info, 
                    'experience' => $request->experience, 
                ]);

        if($update_user){
            return back()->with('success','Member Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //function for admin update member Designation
    public function updateMemberDesignation(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            //'first_name' => 'required',
        ]); 
        
        //update user 
        $update_user = User::where('id', $id) 
                ->update([
                    'profession_name'  => $request->profession_name,
                ]);

        if($update_user){
            return back()->with('success','Member Designation Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }
    //function for admin update member Professinoal Service
    public function updateMemberProfessinoalService(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'services' => 'required',
        ]); 
        
        //update user 
        $update_user = false;
        if($request->has('services')){ 
            $services_list = $request->services;
            foreach($services_list as $key => $val){
                $insert_user_service = UserServices::updateOrCreate([
                    'user_id'  => $id,
                    'member_service_id'  => $val,
                ]);
                $update_user = true;
            }
        } 

        if($update_user){
            return back()->with('success','Member Professinoal Service Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //function for admin update member Firm
    public function updateMemberFirm(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'firm_name' => 'required',
        ]); 
         
        $firm_name = $request->firm_name;
        $update_user = false;

        //Chck if Other id exist in rquest
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
                $last_insert_id = $insert_firm->id;
                //update user 
                $update_user = User::where('id', $id) 
                                    ->update([
                                        'firm_id' => $last_insert_id,    
                                    ]);
            }
        } else {
            //update user 
            $update_user = User::where('id', $id) 
                ->update([
                    'firm_id' => $firm_name,    
                ]);
        }

        //retrun responce
        if($update_user){ 
            return back()->with('success','Member Firm Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        } 
    }

    //function for admin update member Business Detail
    public function updateMemberBusinessDetail(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'biography' => 'required',
        ]); 
         
        //update user 
        $update_user = User::where('id', $id) 
                ->update([
                    'biography' => $request->biography,    
                ]);

        if($update_user){
            return back()->with('success','Member Business Detail Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //function for admin delete member 
    public function deleteMember($id){   
        $delete  =  User::where('id', $id)->delete(); 
        if($delete){
            UserServices::where('user_id', $id)->delete();  
            UserArticle::where('user_id', $id)->delete();  
            UserAvailability::where('user_id', $id)->delete();  
            UserEducation::where('user_id', $id)->delete();  
            UserSocialFeed::where('user_id', $id)->delete();  
            UserVideo::where('user_id', $id)->delete();  
            return back()->with('success','Member Deleted Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        } 
    }

    //function for admin delete assign member service 
    public function deleteMemberAssignService($user_id,$member_service_id){  
        $delete  =  UserServices::where('user_id', $user_id)
                                ->where('member_service_id', $member_service_id)
                                ->delete();   
        if($delete){
            return back()->with('success','Member Service Removed Successfully.');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        } 
    }

    //function for admin import member
    public function importMember(){
        $view =  view('admin.member.import-member');
        return $view;
    }

    //function for submit import member
    public function upaloadImportMember(Request $request){
        //validation rule
        $validated = request()->validate([ 
            'import_file' => 'required',
        ]);   

        $Insert = Excel::import(new UsersImport,request()->file('import_file'));
        
        if($Insert){
            return back()->with('success','Member Import Successfully');
        } else {
             return back()->with('unsuccess','Opps Something wrong!');
        }
    }
}
