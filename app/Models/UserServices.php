<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserServices extends Model
{
    use HasFactory;
    protected $table = 'user_services';
    
    protected $fillable = ['user_id','member_service_id' ];

    //get user services list according to user id
    public function userAssignServicesDetails() {
        return $this->belongsTo(MemberService::class,'member_service_id');
    }
}
