<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Firms;

class MemberController extends Controller
{
    //Function for show advisor list
    public function index(Request $request)
    {  
        $members = User::where('user_type', 'Advisor')
                //->where('user_status', 'Active')
                //->where('user_level_type', '1')
                ->with('userAssignServices')
                ->limit(20)
                ->get();

        //count member
        $member_details = [];
        if(count($members) >= 1){
            foreach($members as $user) {

                //For Firm details
                $advisor_firm = [];
                $firms = Firms::where('id',$user->firm_id)->get();
                foreach($firms as $firm){
                    $advisor_firm = array(
                            "id" => $firm->id,
                            "name" => $firm->name,
                            "logo" => asset('public/upload/firm').'/'.$firm->logo,
                            "status" => $firm->status,
                            "prsnl_website" => $firm->prsnl_website,
                            "cover_color" => $firm->cover_color,
                            "twitter" => $firm->twitter,
                            "linked_in" => $firm->linked_in,
                            "quote_info" => $firm->quote_info,
                            "phone_number" => $firm->phone_number,
                            "address1" => $firm->address1,
                            "city" => $firm->city,
                            "postal_code" => $firm->postal_code,
                            "country_code" => $firm->country_code,
                            "state_code" => $firm->state_code,
                            "biography" => $firm->biography,
                            "created_at" => $firm->created_at,
                            "updated_at" => $firm->updated_at, 
                    );
                }

                //For services details
                $advisor_services = [];
                foreach($user->userAssignServices as $service){
                    $services = array(   
                           "id" => $service->userAssignServicesDetails->id,
                            "name" => $service->userAssignServicesDetails->name,
                            "status" => $service->userAssignServicesDetails->status,
                            "created_at" => $service->userAssignServicesDetails->created_at,
                            "updated_at" => $service->userAssignServicesDetails->updated_at,
                    );

                    $advisor_services[] = $services;
                }

                $member_detail = array( 
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                    "mobile" => $user->mobile,
                    "avatar" => asset('public/upload/user').'/'.$user->avatar,
                    "user_type" => $user->user_type,
                    "user_status" => $user->user_status,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "location" => $user->location,
                    "postal_code" => $user->postal_code,
                    "listing_type" => $user->listing_type,
                    "address1" => $user->address1,
                    "address2" => $user->address2,
                    "city" => $user->city,
                    "state_code" => $user->state_code,
                    "country_code" => $user->country_code,
                    "profession_name" => $user->profession_name,
                    "user_level_type" => 1,
                    "company" => $user->company,
                    "prsnl_website" => $user->prsnl_website,
                    "cover_color" => $user->cover_color,
                    "twitter" => $user->twitter,
                    "linked_in" => $user->linked_in,
                    "others" => $user->others,
                    "quote_info" => $user->quote_info,
                    "biography" => $user->biography,
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,
                    "advisor_services" => $advisor_services,
                    "advisor_firm" => $advisor_firm,
                );

                $member_details[] = $member_detail;
            } 
            
            return response()->json([
                        "status"  => 200,
                        "message" => "Success",
                        "data"    => $member_details, 
                    ], 200);
        } else {
            return response()->json([
                    "status"  => 201,
                    "message" => "No Record Found.",
                    "data"    => $member_details, 
                ], 201);
        }
    }

    //Function for show single advisor 
    public function singleAdvisor(Request $request)
    { 
        //Get Request 
        $advisor_id = $request->id;
    
        $advisor = User::where('id', $advisor_id)
                        ->where('user_type', 'Advisor')
                        //->where('user_status', 'Active')
                        ->with('userAssignServices')
                        ->with('userVideoList')
                        ->with('userArticleList')
                        ->with('userEducationList')
                        ->with('userAvailabilityList')
                        ->with('userSocialFeedList')
                        ->get();
        //count advisor
        $member_details = [];
        if(count($advisor) >= 1){
            foreach($advisor as $user) {
                //For Firm details
                $advisor_firm = [];
                $firms = Firms::where('id',$user->firm_id)->get();
                foreach($firms as $firm){
                    $advisor_firm = array(
                            "id" => $firm->id,
                            "name" => $firm->name,
                            "logo" => asset('public/upload/firm').'/'.$firm->logo,
                            "status" => $firm->status,
                            "prsnl_website" => $firm->prsnl_website,
                            "cover_color" => $firm->cover_color,
                            "twitter" => $firm->twitter,
                            "linked_in" => $firm->linked_in,
                            "quote_info" => $firm->quote_info,
                            "phone_number" => $firm->phone_number,
                            "address1" => $firm->address1,
                            "city" => $firm->city,
                            "postal_code" => $firm->postal_code,
                            "country_code" => $firm->country_code,
                            "state_code" => $firm->state_code,
                            "biography" => $firm->biography,
                            "created_at" => $firm->created_at,
                            "updated_at" => $firm->updated_at, 
                    );
                }

                //For services details
                $advisor_services = [];
                foreach($user->userAssignServices as $service){
                    $services = array(   
                           "id" => $service->userAssignServicesDetails->id,
                            "name" => $service->userAssignServicesDetails->name,
                            "status" => $service->userAssignServicesDetails->status,
                            "created_at" => $service->userAssignServicesDetails->created_at,
                            "updated_at" => $service->userAssignServicesDetails->updated_at,
                    );

                    $advisor_services[] = $services;
                }
                
                //For user videos list
                $video_list = [];
                foreach($user->userVideoList as $video){
                    $videos = array(   
                           "id" => $video->id,
                            "name" => $video->name,
                            "video_link" => $video->video_link,
                            "file_name" => asset('public/upload/user_video').'/'.$video->file_name,
                            "status" => $video->status,
                            "upload_type" => $video->upload_type,
                            "created_at" => $video->created_at,
                            "updated_at" => $video->updated_at,
                    );

                    $video_list[] = $videos;
                }
                
                //For user article list
                $article_list = [];
                foreach($user->userArticleList as $article){
                    $articles = array(   
                           "id" => $article->id,
                            "name" => $article->name,
                            "desc" => $article->desc,
                            "image" => asset('public/upload/user_article').'/'.$article->image,
                            "status" => $article->status,
                            "created_at" => $article->created_at,
                            "updated_at" => $article->updated_at,
                    );

                    $article_list[] = $articles;
                }
                
                //For user education list
                $education_list = []; 
                foreach($user->userEducationList as $education){
                    $educations = array(   
                           "id" => $education->id,
                            "name" => $education->name,
                            "position" => $education->position,
                            "type" => $education->type,
                            "status" => $education->status,
                            "start_date" => $education->start_date,
                            "end_date" => $education->end_date,
                            "created_at" => $education->created_at,
                            "updated_at" => $education->updated_at,
                    );

                    $education_list[] = $educations;
                }
                
                //For user availability list
                $availability_list = []; 
                foreach($user->userAvailabilityList as $availability){
                    $availabilitys = array(   
                           "id" => $availability->id,
                            "day_name" => $availability->day_name,
                            "start_time" => $availability->start_time,
                            "close_time" => $availability->close_time,
                            "status" => $availability->status,
                            "created_at" => $education->created_at,
                            "updated_at" => $education->updated_at,
                    );

                    $availability_list[] = $availabilitys;
                }
                
                //For user social feed list
                $social_feed_list = []; 
                foreach($user->userSocialFeedList as $feed){
                    $social_feeds = array(   
                           "id" => $feed->id,
                            "name" => $feed->name,
                            "username" => $feed->username,
                            "desc" => $feed->desc,
                            "image" => asset('public/upload/user_social_feed').'/'.$feed->image,
                            "status" => $feed->status,
                            "created_at" => date('h:m a', strtotime($feed->created_at))." - ".date('d M Y', strtotime($feed->created_at)),
                            "updated_at" => $feed->updated_at,
                    );

                    $social_feed_list[] = $social_feeds;
                }
                
                //Final Array
                $member_detail = array( 
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                    "mobile" => $user->mobile,
                    "avatar" => asset('public/upload/user').'/'.$user->avatar,
                    "user_type" => $user->user_type,
                    "user_status" => $user->user_status,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "location" => $user->location,
                    "postal_code" => $user->postal_code,
                    "listing_type" => $user->listing_type,
                    "address1" => $user->address1,
                    "address2" => $user->address2,
                    "city" => $user->city,
                    "state_code" => $user->state_code,
                    "country_code" => $user->country_code,
                    "profession_name" => $user->profession_name,
                    "user_level_type" => $user->user_level_type,
                    "company" => $user->company,
                    "prsnl_website" => $user->prsnl_website,
                    "cover_color" => $user->cover_color,
                    "twitter" => $user->twitter,
                    "linked_in" => $user->linked_in,
                    "others" => $user->others,
                    "quote_info" => $user->quote_info,
                    "biography" => $user->biography,
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,
                    "advisor_services" => $advisor_services,
                    "advisor_firm" => $advisor_firm,
                    "user_video_list" => $video_list,
                    "user_article_list" => $article_list,
                    "user_education_list" => $education_list,
                    "user_availability_list" => $availability_list,
                    "user_social_feed_list" => $social_feed_list,
                );

                $member_details[] = $member_detail;
            }
            //Return resonce
            return response()->json([
                        "status"  => 200,
                        "message" => "Success",
                        "data"    => $member_details, 
                    ], 200);
        } else {
            return response()->json([
                    "status"  => 201,
                    "message" => "No Record Found.",
                    "data"    => $member_details, 
                ], 201);
        }
    }
}
