<?php
namespace App\Http\Controllers\API; 
namespace App\Http\Controllers;

// use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;   
use App\Http\Controllers\Controller;
use App\Http\Controllers\TestController;

use App\Http\Controllers\API\AddMemberController;     

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/


//Login,Register API
Route::POST('register-advisor','API\MemberRegisterController@index'); 
Route::POST('login-advisor','API\MemberLoginController@index'); 
//Member
Route::get('advisor-list','API\MemberController@index'); 
Route::get('single-advisor/{id}','API\MemberController@singleAdvisor');   
//Plan list
Route::get('show-plan','API\PlanApiController@showPlanList');

Route::get('firm-list','API\FirmController@firmList'); 
Route::get('single-firm-detail/{id}','API\FirmController@singleFirmDetail');  
//City
Route::get('top-city-list','API\CityController@index');

//Services 
Route::get('home-service-list','API\ServicesController@homeServicesList'); 

//Search
Route::get('city-filter-result','API\CitySearchController@index'); 
Route::get('show-advisor-firm-city-filter-result','API\CitySearchController@advisorFirmCitySearch'); 
Route::get('sidebar-filter-result','API\SearchMemberController@sidebarFilterResult'); 
Route::get('filter-result','API\SearchMemberController@searchFilterResult'); 
Route::get('submit-sidebar-filter-result','API\SearchMemberController@submitSidebarFilterResult'); 

Route::middleware('auth:api')->group( function () {
    
    Route::get('member-profile-detail','API\MemberProfileController@index'); 
    
}); 


























