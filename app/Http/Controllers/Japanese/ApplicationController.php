<?php

namespace App\Http\Controllers\Japanese;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\HobbyCategory;
use App\Models\Country;
use App\Models\JapanLocation;
use App\Models\Application;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function index(User $user,HobbyCategory $hobby_category, JapanLocation $japan_location,Country $country,Application $application)
    {
        $sendApplications=$application->where('sender_id',Auth::id())->where('permission_flag',0)->get();
        $sendApplications->each(function ($send) use($user, $hobby_category, $country, $japan_location)
            {
                $s=$user->with('foreign_visitor')->where('id',$send->reciever_id)->first();
                
                $hobbyId = $s->hobby_category_id;
                $registerLocationId = $s->foreign_visitor->register_location_id;
                $stayLocationId = $s->foreign_visitor->stay_location_id;
                
                $hobbyName = $hobby_category->where('id', $hobbyId)->first()->name;
                $registerLocationName = $country->where('id', $registerLocationId)->first()->name;
                $stayLocationName = $japan_location->where('id', $stayLocationId)->first()->name;
                
                $send->hobby = $hobbyName;
                $send->register_location = $registerLocationName;
                $send->stay_location = $stayLocationName;
                $send->add_info = $s;
            });
            
        $recieveApplications=$application->where('reciever_id',Auth::id())->where('permission_flag',0)->get();
        $recieveApplications->each(function ($recieve) use($user, $hobby_category, $country, $japan_location)
            {
                $r=$user->with('foreign_visitor')->where('id',$recieve->sender_id)->first();

                $hobbyId = $r->hobby_category_id;
                $registerLocationId = $r->foreign_visitor->register_location_id;
                $stayLocationId = $r->foreign_visitor->stay_location_id;
                
                $hobbyName = $hobby_category->where('id', $hobbyId)->first()->name;
                $registerLocationName = $country->where('id', $registerLocationId)->first()->name;
                $stayLocationName = $japan_location->where('id', $stayLocationId)->first()->name;
                
                $recieve->hobby = $hobbyName;
                $recieve->register_location = $registerLocationName;
                $recieve->stay_location = $stayLocationName;
                $recieve->add_info = $r;
            });

        $approvedApplications = $application->where(function($query) {
            $query->where('sender_id', Auth::id())
                  ->orWhere('reciever_id', Auth::id());
        })->where('permission_flag', 1)->get();
        $approvedApplications->each(function ($approved) use($user, $hobby_category, $country, $japan_location)
            {
                if($approved->sender_id==Auth::id()){
                    $userId=$approved->reciever_id;
                }
                else{
                    $userId=$approved->sender_id;
                }
                $a=$user->with('foreign_visitor')->where('id',$userId)->first();

                $hobbyId = $a->hobby_category_id;
                $registerLocationId = $a->foreign_visitor->register_location_id;
                $stayLocationId = $a->foreign_visitor->stay_location_id;
                
                $hobbyName = $hobby_category->where('id', $hobbyId)->first()->name;
                $registerLocationName = $country->where('id', $registerLocationId)->first()->name;
                $stayLocationName = $japan_location->where('id', $stayLocationId)->first()->name;
                
                $approved->hobby = $hobbyName;
                $approved->register_location = $registerLocationName;
                $approved->stay_location = $stayLocationName;
                $approved->add_info = $a;
            });
        
        return Inertia::render('Application',[
            'sendApplications'=>$sendApplications,
            'recieveApplications'=>$recieveApplications,
            'approvedApplications'=>$approvedApplications,
            'users'=>$user->get(),
        ]);
    }
    
    public function permission(Request $request,Application $application)
    {
        $app=$application->where('sender_id',$request["senderId"])->where('reciever_id',Auth::id())->first();
        $input["permission_flag"]=1;
        $app->fill($input)->save();
        return Redirect::route('application.index');
    }
    
    public function reject(Request $request,Application $application)
    {
        $app=$application->where('sender_id',$request["senderId"])->where('reciever_id',Auth::id())->first();
        $input["permission_flag"]=-1;
        $app->fill($input)->save();
        return Redirect::route('application.index');
    }
}