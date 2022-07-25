<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\City;

class CityController extends Controller
{
    //function for admin city  list
    public function index(){
        $cities = City::get(); 
        $view =  view('admin.city.all-city-list', compact('cities') );
        return $view; 
    }

    //function for admin add city
    public function addCity(){
        $view =  view('admin.city.add-city');
        return $view;
    } 

    //function for admin submit city
    public function submitCity(Request $request){
        //validation rule
        $validated = request()->validate([ 
            'name'    => 'required|max:255|unique:cities,name', 
        ]); 

        //Check user city_image files
        $fileName = "default_image.png";
        if($request->hasFile('city_image')){
            foreach($request->file('city_image') as $file){
                $fileName = 'city_'.time().'.'.$file->getClientOriginalExtension();
                $upload = $file->move(public_path('/upload/city'), $fileName);
            } 
        } 
            
        //create new city
        $insert_city = City::create([
            'name'  => $request->name,  
            'image'  => $fileName,  
        ]);

        if($insert_city){
            return back()->with('success','City Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    } 

    //function for admin edit city
    public function editCity(Request $request, $id){
        $city = City::where('id', $id)
                                        ->get();
        $view =  view('admin.city.edit-city', compact('city') );
        return $view;
    }

    //function for admin update city
    public function updateCity(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'name' => 'required',
        ]);  
        
        //Check user city_image files
        if($request->hasFile('city_image')){
            foreach($request->file('city_image') as $file){
                $fileName = 'city_'.time().'.'.$file->getClientOriginalExtension();
                $upload = $file->move(public_path('/upload/city'), $fileName);
            } 
            
            //update city
            $update_city = City::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'image' => $fileName,
                ]);
        } else {
            //update city
            $update_city = City::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'image' => $fileName,
                ]);
        }

        if($update_city){
            return back()->with('success','City Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //function for admin delete city
    public function deleteCity($id){   
        $delete  =  City::where('id', $id)->delete(); 
        if($delete){ 
            return back()->with('success','City Deleted Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        } 
    }
}
