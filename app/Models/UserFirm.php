<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFirm extends Model
{
    use HasFactory;
    protected $table = 'user_firms';
    
    protected $fillable = ['firm_id', 'firm_service_id' ]; 

    //get firm services list according to firm_service_id
    public function firmAssignServicesDetails() {
        return $this->belongsTo(FirmService::class,'firm_service_id');
    }
}
