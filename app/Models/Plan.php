<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\services;  
use App\Models\User; 

class Plan extends Model
{
    use HasFactory;
    
    protected $table    = 'plans';
    protected $fillable = ['plan_name','description','status','plan_type','price','billing_style']; //

}
