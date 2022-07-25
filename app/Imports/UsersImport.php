<?php

namespace App\Imports;

use App\Models\User;
use App\Models\MemberService;
use App\Models\UserServices;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //Generate password
        $manual_password = Hash::make("test@123");
        //Insert new user
        $insert_user = User::create([  
            'name'     => ucwords($row['first_name'])." ".ucwords($row['last_name']),
            'first_name'    => ucwords($row['first_name']), 
            'last_name'    => ucwords($row['last_name']), 
            'email'    => strtolower($row['first_name'].$row['last_name']).rand(1000,9999).'@gmail.com', 
            'password' =>  $manual_password,
            'company' => $row['company'],
            'user_type' => 'Advisor',
            'user_status' => 'Pending',
            'listing_type' => $row['listing_type'],
            'mobile' => $row['phone_number'],
            'address1' => $row['address1'],
            'city' => $row['city'],
            'state_code' => $row['state_code'],
            'country_code' => $row['country_code'],
            'profession_name' => $row['profession_name'],
            'postal_code' => $row['zip_code'], 
        ]);

        if($insert_user){
            //last user insert id
            $last_insert_user_id = $insert_user->id;

            //For insert user services List
            if($row['services']){  
                $services_list = $row['services'];
                $services_list_explode = explode(",",$services_list);
                foreach($services_list_explode as $key => $val){
                    $insert_service = MemberService::updateOrCreate([ 
                                            'name'    => ucwords($val),
                                            'status'  => "Active", 
                                    ]); 
                    //last service insert id
                    $last_insert_service_id = $insert_service->id;
                    //Assign Service for user
                    $assign_service = UserServices::updateOrCreate([ 
                                            'user_id'    => $last_insert_user_id,
                                            'member_service_id'  => $last_insert_service_id, 
                                    ]);
                }
            } 
        } 

        return $insert_user;
    }
}
