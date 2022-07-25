<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;
 
class User extends Authenticatable
{
    use HasApiTokens , HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'users';
     
    // protected $fillable = ['name','email','password','mobile','avatar','user_type','user_status', ];
    
    protected $fillable = ['name','email','password','mobile','avatar','user_type','user_status','first_name','last_name','location','postal_code','listing_type','address1','address2','city','state_code','country_code','profession_name', 'user_level_type', 'company','firm_id','prsnl_website','cover_color','twitter','linked_in','others','quote_info','biography','sort_number','experience'];      
 
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token', ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Get user services list according to user id
    public function userAssignServices() {
        return $this->hasMany(UserServices::class)->with('userAssignServicesDetails');
    }
    
    //Get user video list according to user id
    public function userVideoList() {
        return $this->hasMany(UserVideo::class);
    }
    
    //Get user article list according to user id
    public function userArticleList() {
        return $this->hasMany(UserArticle::class);
    }
    
    //Get user Education list according to user id
    public function userEducationList() {
        return $this->hasMany(UserEducation::class);
    }
    
     //Get user Availability list according to user id
    public function userAvailabilityList() {
        return $this->hasMany(UserAvailability::class);
    }

    //Get user Social Feed list according to user id
    public function userSocialFeedList() {
        return $this->hasMany(UserSocialFeed::class);
    }
}
