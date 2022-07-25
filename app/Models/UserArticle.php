<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArticle extends Model
{
    use HasFactory;
    protected $table = 'user_articles';
    
    protected $fillable = ['user_id','name','desc','image','status'];
}
