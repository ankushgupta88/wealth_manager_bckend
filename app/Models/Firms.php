<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firms extends Model
{
    use HasFactory;
    protected $table = 'firms';
    
    protected $fillable = ['name','logo','status','prsnl_website','cover_color','twitter','linked_in','quote_info','phone_number','address1','city','postal_code','country_code','state_code','biography']; 

    //Get firm services list according to firm id
    public function firmAssignServices() { 
        return $this->hasMany(UserFirm::class,'firm_id');
    }
    
    //Get user list according to firm id
    public function firmAssignUserDetail() { 
        return $this->hasMany(User::class,'firm_id')->orderBy('sort_number', 'ASC')->orderBy('name');
    }
}
