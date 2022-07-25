<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserAvailability;

class AvailabilityController extends Controller
{
    //function for admin add member Education
    public function submitMemberAvailability(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'day_name' => 'required',
        ]); 

        //Check Availability 
        $check_availability_exits = UserAvailability::where('user_id', $id)   
                                                    ->where('day_name', $request->day_name)->count();
        if($check_availability_exits >= 1){
            return back()->with('unsuccess','Day name already exist. Please try with new name.');
        } else {
            //Add New Availability 
            $insert_availability = UserAvailability::create([
                    'user_id' => $id,    
                    'day_name' => $request->day_name,    
                    'start_time' => $request->start_time,  
                    'close_time' => $request->end_time, 
                    'status' => $request->status, 
                ]);
     
            //retrun responce
            if($insert_availability){ 
                return back()->with('success','Member Availability Added Successfully');
            } else {
                return back()->with('unsuccess','Opps Something wrong!');
            } 
        }
    }
}
