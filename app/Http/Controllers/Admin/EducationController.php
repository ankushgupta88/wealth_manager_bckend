<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserEducation;

class EducationController extends Controller
{
    //function for admin add member Education
    public function submitMemberEducation(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'name' => 'required',
        ]); 

        //Add New Education  
        $insert_education = UserEducation::create([
                'user_id' => $id,    
                'name' => $request->name,    
                'position' => $request->position,  
                'type' => $request->type, 
                'start_date' => date('Y-m-d H:i:s' , strtotime($request->start_date)), 
                'end_date' => date('Y-m-d H:i:s' , strtotime($request->end_date)), 
            ]);
 
        //retrun responce
        if($insert_education){ 
            return back()->with('success','Member Education Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        } 
    }
}
