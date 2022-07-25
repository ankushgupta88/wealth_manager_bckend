<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAvailability extends Model
{
    use HasFactory;
    protected $table = 'user_availabilities';
    
    protected $fillable = ['user_id','day_name','start_time','close_time','status']; 
}
