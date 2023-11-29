<?php

namespace App\Http\Controllers\Foreign;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Japanese;
use App\Models\HobbyCategory;
use App\Models\JapanLocation;
use App\Models\Application;
use App\Http\Controllers\Controller;

class ForeignApplicationController extends Controller
{
    public function index(User $user,HobbyCategory $hobby_category, JapanLocation $japan_location, Application $application)
    {
        $sendApplications=$application->where('sender_id',Auth::id())->where('permission_flag',0)->get();
        $sendApplications->each(function ($send) use($user, $hobby_category, $japan_location)
            {
                $s=$user->with('japanese')->where('id',$send->reciever_id)->first();
                
                $hobbyId = $s->hobby_category_id;
                $registerLocationId = $s->japanese->register_location_id;
                $oftenGoLocationId = $s->japanese->often_go_location_id;
                
                $hobbyName = $hobby_category->where('id', $hobbyId)->first()->name;
                $registerLocationName = $japan_location->where('id', $registerLocationId)->first()->name;
                $oftenGoLocationName = $japan_location->where('id', $oftenGoLocationId)->first()->name;
                
                $send->hobby = $hobbyName;
                $send->register_location = $registerLocationName;
                $send->often_go_location = $oftenGoLocationName;
                $send->add_info = $s;
            });
            
        $recieveApplications=$application->where('reciever_id',Auth::id())->where('permission_flag',0)->get();
        $recieveApplications->each(function ($recieve) use($user, $hobby_category, $japan_location)
            {
                $r=$user->with('japanese')->where('id',$recieve->sender_id)->first();

                $hobbyId = $r->hobby_category_id;
                $registerLocationId = $r->japanese->register_location_id;
                $oftenGoLocationId = $r->japanese->often_go_location_id;
                
                $hobbyName = $hobby_category->where('id', $hobbyId)->first()->name;
                $registerLocationName = $japan_location->where('id', $registerLocationId)->first()->name;
                $oftenGoLocationName = $japan_location->where('id', $oftenGoLocationId)->first()->name;
                
                $recieve->hobby = $hobbyName;
                $recieve->register_location = $registerLocationName;
                $recieve->often_go_location = $oftenGoLocationName;
                $recieve->add_info = $r;
            });

        $approvedApplications = $application->where(function($query) {
            $query->where('sender_id', Auth::id())
                  ->orWhere('reciever_id', Auth::id());
        })->where('permission_flag', 1)->get();
        $approvedApplications->each(function ($approved) use($user, $hobby_category, $japan_location)
            {
                if($approved->sender_id==Auth::id()){
                    $userId=$approved->reciever_id;
                }
                else{
                    $userId=$approved->sender_id;
                }
                $a=$user->with('japanese')->where('id',$userId)->first();

                $hobbyId = $a->hobby_category_id;
                $registerLocationId = $a->japanese->register_location_id;
                $oftenGoLocationId = $a->japanese->often_go_location_id;
                
                $hobbyName = $hobby_category->where('id', $hobbyId)->first()->name;
                $registerLocationName = $japan_location->where('id', $registerLocationId)->first()->name;
                $oftenGoLocationName = $japan_location->where('id', $oftenGoLocationId)->first()->name;
                
                $approved->hobby = $hobbyName;
                $approved->register_location = $registerLocationName;
                $approved->often_go_location = $oftenGoLocationName;
                $approved->add_info = $a;
            });
        
        return Inertia::render('ForeignApplication',[
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
        return Redirect::route('foreign.application.index');
    }
    
    public function reject(Request $request,Application $application)
    {
        $app=$application->where('sender_id',$request["senderId"])->where('reciever_id',Auth::id())->first();
        $input["permission_flag"]=-1;
        $app->fill($input)->save();
        return Redirect::route('foreign.application.index');
    }
}