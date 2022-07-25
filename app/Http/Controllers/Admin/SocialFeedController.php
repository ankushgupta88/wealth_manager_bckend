<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserSocialFeed;

class SocialFeedController extends Controller
{
    //function for admin add member social feed
    public function submitMemberSocialFeed(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'name' => 'required',
        ]);  

        //Chck if request is in video
        $fileName = "default_user.png"; 
        if($request->hasFile('image')){
            foreach($request->file('image') as $file){
                $fileName = 'social_feed_'.time().'.'.$file->getClientOriginalExtension();
                $upload = $file->move(public_path('/upload/user_social_feed'), $fileName);
                
            } 
        }

        //Add New Social Feed  
        $insert_social_feed = UserSocialFeed::create([
                'user_id' => $id,    
                'name' => $request->name,    
                'username' => $request->username,    
                'desc' => $request->desc,    
                'image' => $fileName, 
                'status' => $request->status, 
            ]); 
 
        //retrun responce
        if($insert_social_feed){ 
            return back()->with('success','Member Social Feed Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        } 
    }
}
