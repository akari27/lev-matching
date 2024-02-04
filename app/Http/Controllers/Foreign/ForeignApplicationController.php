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
                $s=$user->with('japanese')->where('id',$send->receiver_id)->first();
                
                $hobbyId = $s->hobby_category_id;
                $hobbyName = $hobby_category->where('id', $hobbyId)->first()->name;
                $send->hobby = $hobbyName;
                
                if($s->japanese->register_location_id != null){
                    $registerLocationId = $s->japanese->register_location_id;
                    $registerLocationName = $japan_location->where('id', $registerLocationId)->first()->name;
                    $send->register_location = $registerLocationName;
                }
                
                if($s->japanese->often_go_location_id != null){
                    $oftenGoLocationId = $s->japanese->often_go_location_id;
                    $oftenGoLocationName = $japan_location->where('id', $oftenGoLocationId)->first()->name;
                    $send->often_go_location = $oftenGoLocationName;
                }
                
                $send->add_info = $s;
            });
            
        $recieveApplications=$application->where('receiver_id',Auth::id())->where('permission_flag',0)->get();
        $recieveApplications->each(function ($recieve) use($user, $hobby_category, $japan_location)
            {
                $r=$user->with('japanese')->where('id',$recieve->sender_id)->first();

                $hobbyId = $r->hobby_category_id;
                $hobbyName = $hobby_category->where('id', $hobbyId)->first()->name;
                $recieve->hobby = $hobbyName;
                
                if($r->japanese->register_location_id != null){
                    $registerLocationId = $r->japanese->register_location_id;
                    $registerLocationName = $japan_location->where('id', $registerLocationId)->first()->name;
                    $recieve->register_location = $registerLocationName;
                }
                
                if($r->japanese->often_go_location_id != null){
                    $oftenGoLocationId = $r->japanese->often_go_location_id;
                    $oftenGoLocationName = $japan_location->where('id', $oftenGoLocationId)->first()->name;
                    $recieve->often_go_location = $oftenGoLocationName;
                }
                
                $recieve->add_info = $r;
            });

        $approvedApplications = $application->where(function($query) {
            $query->where('sender_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
        })->where('permission_flag', 1)->get();
        $approvedApplications->each(function ($approved) use($user, $hobby_category, $japan_location)
            {
                if($approved->sender_id==Auth::id()){
                    $userId=$approved->receiver_id;
                }
                else{
                    $userId=$approved->sender_id;
                }
                $a=$user->with('japanese')->where('id',$userId)->first();

                $hobbyId = $a->hobby_category_id;
                $hobbyName = $hobby_category->where('id', $hobbyId)->first()->name;
                $approved->hobby = $hobbyName;
                
                if($a->japanese->register_location_id != null){
                    $registerLocationId = $a->japanese->register_location_id;
                    $registerLocationName = $japan_location->where('id', $registerLocationId)->first()->name;
                    $approved->register_location = $registerLocationName;
                }
                
                if($a->japanese->often_go_location_id != null){
                    $oftenGoLocationId = $a->japanese->often_go_location_id;
                    $oftenGoLocationName = $japan_location->where('id', $oftenGoLocationId)->first()->name;
                    $approved->often_go_location = $oftenGoLocationName;
                }

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
        $app=$application->where('sender_id',$request["senderId"])->where('receiver_id',Auth::id())->first();
        $input["permission_flag"]=1;
        $app->fill($input)->save();
        return Redirect::route('foreign.application.index');
    }
    
    public function reject(Request $request,Application $application)
    {
        $app=$application->where('sender_id',$request["senderId"])->where('receiver_id',Auth::id())->first();
        $input["permission_flag"]=-1;
        $app->fill($input)->save();
        return Redirect::route('foreign.application.index');
    }
}