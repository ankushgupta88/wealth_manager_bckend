<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FirmService;

class FirmServicesController extends Controller
{
    //function for admin Firm service list
    public function index(){
        $firm_services = FirmService::get();
        $view =  view('admin.firm.firm-service-list', compact('firm_services') );
        return $view;
    }

    //function for admin add Firm service
    public function addFirmServices(){
        $view =  view('admin.firm.add-firm-service' );
        return $view;
    } 

    //function for admin submit Firm service
    public function submitFirmService(Request $request){
        //validation rule
        $validated = request()->validate([ 
            'name'    => 'required|unique:firm_services|max:255',
        ]); 

        //create new service
        $insert_user = FirmService::create([
            'name'  => $request->name,
            'status'   => $request->status,   
        ]);

        if($insert_user){
            return back()->with('success','Firm Service Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    } 

    //function for admin edit Firm service
    public function editFirmService(Request $request, $id){
        $firm_service = FirmService::where('id', $id)
                                        ->get();
        $view =  view('admin.firm.edit-firm-service', compact('firm_service') );
        return $view;
    }

    //function for admin update Firm service
    public function updateFirmService(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'name' => 'required',
        ]);  
        
        //update service
        $update_service = FirmService::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'status' => $request->status,
                ]);

        if($update_service){
            return back()->with('success','Firm Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //function for admin delete Firm Service 
    public function deleteFirmService($id){   
        $delete  =  FirmService::where('id', $id)->delete(); 
        if($delete){ 
            return back()->with('success','Firm Service Deleted Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        } 
    }
}
