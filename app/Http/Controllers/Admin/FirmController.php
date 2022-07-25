<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Firms;
use App\Models\FirmService;
use App\Models\UserFirm;
use App\Models\User;

class FirmController extends Controller
{
    //function for show firm list
    public function index(){
        $firms = Firms::where('status', 'Active')->get();
        $view =  view('admin.firm.firm-list', compact('firms') );
        return $view;
    }

    //function for admin add firm
    public function addFirm(Request $request){
        $services = FirmService::get();
        $view =  view('admin.firm.add-firm',compact('services'));
        return $view;
    }

    //function for admin submit firm 
    public function submitFirm(Request $request){
        //validation rule
        $validated = request()->validate([ 
            'name' => 'required|unique:firms|max:255',
            'status' => 'required',
        ]); 

        $firmfileName = "default_logo.png";
        if($request->hasFile('logo')){
            foreach($request->file('logo') as $file){
                $firmfileName = 'firm_'.time().'.'.$file->getClientOriginalExtension();
                $upload2 = $file->move(public_path('/upload/firm'), $firmfileName);
                
            } 
        } 

        //insert firm
        $insert_firm = Firms::create([ 
                                'name'  => $request->name,
                                'status'   => $request->status,
                                'logo' => $firmfileName,
                                'prsnl_website' => $request->prsnl_website,    
                                'cover_color' => $request->cover_color,    
                                'twitter' => $request->twitter,    
                                'linked_in' => $request->linked_in,  
                                'quote_info' => $request->quote_info,
                                'phone_number' => $request->phone_number,
                                'address1' => $request->address1,
                                'city' => $request->city,
                                'postal_code' => $request->postal_code,
                                'country_code' => $request->country_code,
                                'state_code' => $request->state_code,
                                'biography' => $request->biography,
                            ]); 

        if($insert_firm){
            $last_insert_id = $insert_firm->id;
            //For Insert firm services List
            if($request->has('services')){ 
                $services_list = $request->services;
                foreach($services_list as $key => $val){
                    $insert_firm_service = UserFirm::create([
                        'firm_id'  => $last_insert_id,
                        'firm_service_id'  => $val,
                    ]);
                }
            }
            return back()->with('success','Firm Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //function for admin edit firm
    public function editFirm(Request $request, $id){
        $firm = Firms::where('id', $id)
                    ->with('firmAssignServices')    
                    ->get();
                   
        $services = FirmService::get();
        $view =  view('admin.firm.edit-firm', compact('firm','services') );
        return $view; 
    }

    //function for admin update firm 
    public function updateFirm(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'name' => 'required',
            'status' => 'required',
        ]); 
        
        if($request->hasFile('logo')){
            foreach($request->file('logo') as $file){
                $firmfileName = 'firm_'.time().'.'.$file->getClientOriginalExtension();
                $upload2 = $file->move(public_path('/upload/firm'), $firmfileName);
                //update firm
                $update_firm = Firms::where('id', $id)
                                    ->update([
                                        'name'  => $request->name,
                                        'status'   => $request->status,
                                        'logo' => $firmfileName,
                                        'prsnl_website' => $request->prsnl_website,    
                                        'cover_color' => $request->cover_color,    
                                        'twitter' => $request->twitter,    
                                        'linked_in' => $request->linked_in,  
                                        'quote_info' => $request->quote_info,
                                        'phone_number' => $request->phone_number,
                                        'address1' => $request->address1,
                                        'city' => $request->city,
                                        'postal_code' => $request->postal_code,
                                        'country_code' => $request->country_code,
                                        'state_code' => $request->state_code,
                                    ]);
            } 
        }   else {
                //update firm
                $update_firm = Firms::where('id', $id)
                                    ->update([
                                        'name'  => $request->name,
                                        'status'   => $request->status,
                                        'prsnl_website' => $request->prsnl_website,    
                                        'cover_color' => $request->cover_color,    
                                        'twitter' => $request->twitter,    
                                        'linked_in' => $request->linked_in,  
                                        'quote_info' => $request->quote_info,
                                        'phone_number' => $request->phone_number,
                                        'address1' => $request->address1,
                                        'city' => $request->city,
                                        'postal_code' => $request->postal_code,
                                        'country_code' => $request->country_code,
                                        'state_code' => $request->state_code,
                                    ]);
        }

        if($update_firm){
            return back()->with('success','Firm Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //function for admin update firm Professinoal Service
    public function updateFirmProfessinoalService(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'services' => 'required',
        ]); 
        
        //update firm 
        $update_firm = false;
        if($request->has('services')){ 
            $services_list = $request->services;
            foreach($services_list as $key => $val){
                $insert_firm_service = UserFirm::updateOrCreate([
                    'firm_id'  => $id,
                    'firm_service_id'  => $val,
                ]);
                $update_firm = true; 
            }
        } 

        if($update_firm){
            return back()->with('success','Firm Professinoal Service Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //function for admin update firm Business Detail
    public function updateFirmBusinessDetail(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'biography' => 'required',
        ]); 
         
        //update user 
        $update_user = Firms::where('id', $id) 
                ->update([
                    'biography' => $request->biography,    
                ]);

        if($update_user){
            return back()->with('success','Firm Business Detail Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //function for admin delete assign firm service 
    public function deleteFirmAssignService($firm_id,$firm_service_id){   
        $delete  =  UserFirm::where('firm_id', $firm_id)
                                ->where('firm_service_id', $firm_service_id)
                                ->delete();   
        if($delete){
            return back()->with('success','Firm Service Removed Successfully.');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        } 
    }

    //function for admin delete firm 
    public function deleteFirm($id){   
        $delete  =  Firms::where('id', $id)->delete(); 
        if($delete){ 
            return back()->with('success','Firm Deleted Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        } 
    }
    
    //function for show firm allow members
    public function firmAllowMember(){
        $firms = Firms::where('status', 'Active')->get();
        $members = User::where('user_type', 'Advisor')->get();
        $view =  view('admin.firm.firm-allow-member', compact('firms', 'members') );
        return $view;
    }
    
    //function for admin submit firm allow member
    public function submitFirmAllowMember(Request $request){
        //validation rule
        $validated = request()->validate([ 
            'firm_name' => 'required',
        ]); 
        
        //update user 
        $update_user = false;
        if($request->has('user_ids')){ 
            $user_ids = $request->user_ids;
            foreach($user_ids as $key => $val){
                $update_user = User::where('id', $val)
                                    ->where('user_type', 'Advisor')
                                    ->update([
                                        'firm_id'  => $request->firm_name,
                                    ]);
                $update_user = true;
            }
        }
        
        if($update_user){
            return back()->with('success','Member Allow Successfully.');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
        
    }
    
    //function for show manager member list
    public function manageMemberList(){
        $firms = Firms::where('status', 'Active')->get();
        $view =  view('admin.firm.manage-member-list', compact('firms') );
        return $view;
    }


    //function for show manager member list according to firm id
    public function assignFirmMemberList(Request $request){
        //Firm Id 
        $firm_id =  $request->firm_id;
        //Get usere
        $members = User::select('id','name','user_type','firm_id','sort_number','avatar')
                        ->where('user_type', 'Advisor')
                        ->where('firm_id', $firm_id)
                        ->orderBy('sort_number', 'ASC')
                        ->orderBy('name')
                        ->get();
        ?>

        <?php //Count members 
        if(count($members) >= 1){ ?>
            <script>
                $(function() { 
                    $("#sortable").sortable({
                        update: function (event, ui) {
                            var options = $(this).sortable('toArray', { attribute: 'data-user_id'}); 
                            //alert(data);
                            $.ajax({
                                type: "GET",
                                url: base_url + "/update-member-sort-list",
                                context: this,
                                data: { options: options},
                                beforeSend: function () {
                                    $(".custom_loader").show();
                                },
                                success: function (responce) { 
                                    $(".update_assign_member_list_reponce").html(responce);
                                    $(".custom_loader").hide();
                                    setTimeout(function () {
                                        $(".success-msg").fadeOut(3000);
                                        $(".unsuccess-msg").fadeOut(3000);
                                    }, 3000);
                                }
                            });
                        } 
                    }); 
                    $("#sortable").disableSelection();
                });
            </script>
            <div class="list list-row card firm-list-cntnt " id="sortable" data-sortable-id="0" aria-dropeffect="move">
                <?php $count_record = 0;
                foreach($members as $user) { ?> 
                        <div class="list-item sortable_list" data-firm_id="<?php echo  $user->firm_id; ?>" data-user_id="<?php echo  $user->id; ?>" data-id="<?php echo $count_record; ?>" data-item-sortable-id="0" draggable="true" role="option" aria-grabbed="false" style="">
                            <div class="item-author text-color" data-abc="true">
                                <img src="<?php echo asset('public/upload/user').'/'.$user->avatar; ?>" alt="<?php echo $user->avatar; ?>" > <?php echo $user->name; ?>
                            </div> 
                        </div>
                <?php $count_record++; } ?>
            </div>
        <?php } else { ?>
            <h4>No Member Found.</h4>
        <?php } ?>
    <?php
    }

    //function for update member Sort list
    public function updateMemberSortList(Request $request){
        //Check Request 
         $update_user = false;
        if($request->has('options')){ 
            $user_ids = $request->options;
            $count = 1;
            foreach($user_ids as $key => $val){
               $update_user = User::where('id', $val)
                                    ->where('user_type', 'Advisor')
                                    ->update([
                                        'sort_number'  => $count,
                                    ]);
                $update_user = true;
                $count++;
            }
        } 

        if($update_user){
            echo '<p class="success-msg">Member Move Successfully.</p>';
        } else {
            echo '<p class="unsuccess-msg">Opps Something wrong!</p>';
        }
    }
}
