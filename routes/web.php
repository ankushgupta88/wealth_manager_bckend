<?php
 
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

//Frontend common routing start here 
    Auth::routes([
      'register' => false, // Registration Routes...
      'reset' => false, // Password Reset Routes...
      'verify' => false, // Email Verification Routes...
      'login' => false // Login Routes...
    ]);
    Route::get('/','HomeController@homeCustom');
//Frontend common routing end here 


//Admin common routing start here
	Route::get('admin-login','Admin\LoginController@index');  
	Route::post('/admin-submit', 'Admin\LoginController@dologin')->name('admin.login.submit');
//Admin common routing end here 



Route::group(['middleware' => 'auth'], function(){
    
    // Admin Access Only
    Route::group(['middleware' => 'admin'], function(){
         Route::get('/admin/dashboard','Admin\DashboardController@index');
         
         //Plan
         Route::get('admin/add-plan','Admin\PlanController@plan'); 
         Route::post('admin/plan-store','Admin\PlanController@planstore')->name('plan.store'); 
         Route::get('admin/all-plan-list','Admin\PlanController@view_plan'); 
         Route::get('admin/edit-plan/{id}','Admin\PlanController@edit_plan')->name('edit.plan'); 
         Route::put('admin/update-plan/{id}','Admin\PlanController@update_plan')->name('plan.update');
         Route::get('admin/plan-delete/{id}','Admin\PlanController@plan_destroy'); 

        //Member
        Route::get('admin/search-member', 'Admin\MemberController@index');
        Route::get('admin/add-member', 'Admin\MemberController@addMember');
        Route::post('admin/submit-member','Admin\MemberController@submitMember')->name('admin.submit.member'); 
        Route::get('admin/edit-search-member/{id}','Admin\MemberController@editMember'); 
        Route::get('admin/edit-search-member-test/{id}','Admin\MemberController@editTestMember'); 
        Route::post('admin/update-member-information/{id}','Admin\MemberController@updateMemberInformation')->name('update.member.information');
        Route::post('admin/update-member-sesignation/{id}','Admin\MemberController@updateMemberDesignation')->name('update.member.designation');
        Route::post('admin/update-member-professinoal-service/{id}','Admin\MemberController@updateMemberProfessinoalService')->name('update.member.professinoal.services');  
        Route::post('admin/update-member-firm/{id}','Admin\MemberController@updateMemberFirm')->name('update.member.firm');  
        Route::post('admin/update-member-business-detail/{id}','Admin\MemberController@updateMemberBusinessDetail')->name('update.member.business.detail');    
         Route::get('admin/delete-search-member/{id}','Admin\MemberController@deleteMember');  
        Route::get('admin/import-member','Admin\MemberController@importMember');
        Route::post('admin/upload-import-member','Admin\MemberController@upaloadImportMember')->name('admin.upload.import.member');
        Route::get('admin/delete-assign-member-service/{user_id}/{member_service_id}','Admin\MemberController@deleteMemberAssignService');
        //Member Video
        Route::post('admin/submit-member-video/{id}','Admin\VideoController@submitMemberVideo')->name('submit.member.video');
        //Member Article
        Route::post('admin/submit-member-article/{id}','Admin\ArticleController@submitMemberArticle')->name('submit.member.article'); 
        //Member Article
        Route::post('admin/submit-member-education/{id}','Admin\EducationController@submitMemberEducation')->name('submit.member.education'); 
        //Member Availability
        Route::post('admin/submit-member-availability/{id}','Admin\AvailabilityController@submitMemberAvailability')->name('submit.member.availability');
        //Member Social Feed 
        Route::post('admin/submit-member-social-feed/{id}','Admin\SocialFeedController@submitMemberSocialFeed')->name('submit.member.social.feed'); 
        
        //Member services
        Route::get('admin/member-all-service', 'Admin\MemberServicesController@index');
        Route::get('admin/member-add-service', 'Admin\MemberServicesController@addMemberServices');
        Route::post('admin/submit-member-service','Admin\MemberServicesController@submitMemberService')->name('admin.submit.member.service'); 
        Route::get('admin/edit-member-service/{id}','Admin\MemberServicesController@editMemberService'); 
        Route::post('admin/update-member-service/{id}','Admin\MemberServicesController@updateMemberService')->name('update.member.service');   
        Route::get('admin/delete-member-service/{id}','Admin\MemberServicesController@deleteMemberService');

        //Firm
        Route::get('admin/all-firm-list', 'Admin\FirmController@index');
        Route::get('admin/add-firm', 'Admin\FirmController@addFirm');
        Route::post('admin/submit-firm','Admin\FirmController@submitFirm')->name('submit.firm'); 
        Route::get('admin/edit-firm/{id}','Admin\FirmController@editFirm'); 
        Route::post('admin/update-firm/{id}','Admin\FirmController@updateFirm')->name('update.firm');  
        Route::get('admin/delete-firm/{id}','Admin\FirmController@deleteFirm');
        Route::post('admin/update-firm-professinoal-services/{id}','Admin\FirmController@updateFirmProfessinoalService')->name('update.firm.professinoal.services'); 
        Route::post('admin/update-firm-business-detail/{id}','Admin\FirmController@updateFirmBusinessDetail')->name('update.firm.business.detail'); 
        Route::get('admin/delete-assign-firm-service/{firm_id}/{firm_service_id}','Admin\FirmController@deleteFirmAssignService');
        Route::get('admin/firm-allow-member', 'Admin\FirmController@firmAllowMember');
        Route::post('admin/submit-firm-allow-member','Admin\FirmController@submitFirmAllowMember')->name('admin.submit.firm.allow.member');
        Route::get('admin/manage-member-list', 'Admin\FirmController@manageMemberList');
        Route::get('admin/assign-manage-member-list', 'Admin\FirmController@assignFirmMemberList');
        Route::get('admin/update-member-sort-list', 'Admin\FirmController@updateMemberSortList');
 
        //Firm services
        Route::get('admin/firm-all-service', 'Admin\FirmServicesController@index');
        Route::get('admin/firm-add-service', 'Admin\FirmServicesController@addFirmServices');
        Route::post('admin/submit-firm-service','Admin\FirmServicesController@submitFirmService')->name('admin.submit.firm.service');  
        Route::get('admin/edit-firm-service/{id}','Admin\FirmServicesController@editFirmService');  
        Route::post('admin/update-firm-service/{id}','Admin\FirmServicesController@updateFirmService')->name('update.firm.service');   
        Route::get('admin/delete-firm-service/{id}','Admin\FirmServicesController@deleteFirmService');

        //Cities
        Route::get('admin/all-city-list', 'Admin\CityController@index');
        Route::get('admin/add-city', 'Admin\CityController@addCity');
        Route::post('admin/submit-city','Admin\CityController@submitCity')->name('admin.submit.city'); 
        Route::get('admin/edit-city/{id}','Admin\CityController@editCity'); 
        Route::post('admin/update-city/{id}','Admin\CityController@updateCity')->name('update.city');    
        Route::get('admin/delete-city/{id}','Admin\CityController@deleteCity');

        Route::post('/admin-logout', 'Admin\DashboardController@logout')->name('admin.logout');
    });
     
    // Customer Access Only
    Route::group(['middleware' => 'customer'], function(){
        
    });
    
    // Advisor Access Only
    Route::group(['middleware' => 'advisor'], function(){
       
    });
});

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');























