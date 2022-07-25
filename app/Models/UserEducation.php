<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    use HasFactory;
    protected $table = 'user_educations';
    
    protected $fillable = ['user_id','name','position','type','status','start_date','end_date'];
}
