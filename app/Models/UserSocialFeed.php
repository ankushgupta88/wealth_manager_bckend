<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocialFeed extends Model
{
    use HasFactory;
    protected $table = 'user_social_feeds';
    
    protected $fillable = ['user_id','name','username','desc','image','status' ];
}
