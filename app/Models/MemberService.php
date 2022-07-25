<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberService extends Model
{
    use HasFactory;
    protected $table = 'member_services';
    
    protected $fillable = ['name','short_name','status']; 

    //Get user services list according to service
    public function userAssignServicesList() {
        return $this->hasMany(UserServices::class);
    }

}
