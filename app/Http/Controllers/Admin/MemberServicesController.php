<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MemberService;

class MemberServicesController extends Controller
{
    //function for admin member service list
    public function index(){
        $member_servics = MemberService::get();
        $view =  view('admin.member.member-service-list', compact('member_servics') );
        return $view;
    }

    //function for admin add member service
    public function addMemberServices(){
        $view =  view('admin.member.add-member-service' );
        return $view;
    } 

    //function for admin submit member service
    public function submitMemberService(Request $request){
        //validation rule
        $validated = request()->validate([ 
            'name'    => 'required|unique:member_services|max:255',
        ]); 

        //create new user
        $insert_user = MemberService::create([
            'name'  => $request->name,
            'short_name'  => $request->short_name,
            'status'   => $request->status,   
        ]);

        if($insert_user){
            return back()->with('success','Member Service Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    } 

    //function for admin edit member service
    public function editMemberService(Request $request, $id){
        $member_service = MemberService::where('id', $id)
                                        ->get();
        $view =  view('admin.member.edit-member-service', compact('member_service') );
        return $view;
    }

    //function for admin update member service
    public function updateMemberService(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'name' => 'required',
        ]);  
        
        //update service
        $update_service = MemberService::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'short_name' => $request->short_name,
                    'status' => $request->status,
                ]);

        if($update_service){
            return back()->with('success','Member Service Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //function for admin delete member Service 
    public function deleteMemberService($id){    
        $delete  =  MemberService::where('id', $id)->delete(); 
        if($delete){ 
            return back()->with('success','Member Service Deleted Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        } 
    }
}
