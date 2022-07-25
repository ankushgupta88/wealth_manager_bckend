<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use App\Models\Plan;

class PlanController extends Controller
{  
    
    // public function show_plan($id)
    // {   
    //     $user = Auth::user(); //auth user
        
    //     $Plan = Plan::find($id); //// id// PlanName// Description// Status// PlanType// Price// BillingStyle
        
    //      echo $Plan->id; 
    //      echo $Plan->PlanName; 
    //     //  echo $Plan->id; 
    //     //  echo $Plan->id; 
    //     //  echo $Plan->id; 
             
    //                 // @foreach ($Plan as plan)
    //                 //     <li>{{  }}</li>
    //                 // @endforeach
                 
 
        
    //     // dd($Plan);
    //     // die('');
  
    //     // if (is_null($Plan)) {
    //     //     return $this->sendError('Product not found.');
    //     // }
   
    //     //return $this->sendResponse(new ProductResource(Plan), 'Plan retrieved successfully.');
    // }
    
    
   //View Plan Blank Form 
   public function plan(){
        $view =  view('admin.plan.member_plan');
        return $view;
    }
    
    //Plan Store  
    public function planstore(Request $request)
    {
        $create_pan = Plan::create([
                    'plan_name'    =>  $request->name,
                    'description' =>  $request->description,
                    'status'      =>  $request->status,
                    'plan_type'    =>  $request->plan_type,
                    'price'       =>  $request->price,
                    'billing_style' =>  $request->billing_style,
                ]);
        //check if plan is create
        if($create_pan){
            return redirect()->back()->with('success','Plan added successfully.');
        } else {
            return redirect()->back()->with('unsuccess','Oops something wrong!');
        }
            
    }
    
    //View Plan list  
    public function view_plan(){
        $plans = Plan::get(); 
        return view('admin.plan.all-plan-list',compact('plans'));
    }
    
    //Plan Delete 
    public function plan_destroy($id )
    {   
        $plan_id = $id;
        $IsPlanDelete = Plan::Where("id", $plan_id)->Delete();
        
        //check if plan is deleted or not
        if($IsPlanDelete){
            return redirect()->back()->with('success','Plan deleted successfully.');
        } else {
            return redirect()->back()->with('unsuccess','Oops something wrong!');
        }
    }
    
    
    //Plan Edit 
    public function edit_plan(plan $id)
    {
        return view('admin.plan.edit_plan',compact('id'));
    }
    
    //Plan Update
    public function update_plan(Request $request, $id)
    {   
         $update_pan = Plan::where('id', $id)
                ->update([
                    'plan_name'    =>  $request->name,
                    'description' =>  $request->description,
                    'status'      =>  $request->status,
                    'plan_type'    =>  $request->plan_type,
                    'price'       =>  $request->price,
                    'billing_style' =>  $request->billing_style,
                ]);
        if($update_pan){
           return back()->with('success','Plan Added Updated Successfully'); 
        } else {
             return back()->with('unsuccess','Opps Something wrong!');
        }
    }
    
    
    
}
