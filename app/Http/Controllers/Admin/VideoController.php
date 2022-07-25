<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserVideo;

class VideoController extends Controller
{
    //function for admin add member videos
    public function submitMemberVideo(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'name' => 'required',
        ]); 

        //Chck if request is in video
        $fileName = "default_video.png";
        $upload_type = "Link";
        if($request->hasFile('video')){
            //validation rule
            $validated = request()->validate([ 
                //'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
            ]); 
            $upload_type = "Video";
            foreach($request->file('video') as $file){
                $fileName = 'video_'.time().'.'.$file->getClientOriginalExtension();
                $upload2 = $file->move(public_path('/upload/user_video'), $fileName);
                
            } 
        }

        //Add New Video 
        $insert_video = UserVideo::create([
                'user_id' => $id,    
                'name' => $request->name,    
                'video_link' => $request->link,    
                'file_name' => $fileName, 
                'status' => $request->status, 
                'upload_type' => $upload_type, 
            ]);

        //retrun responce
        if($insert_video){ 
            return back()->with('success','Member Video Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        } 
    }
}
