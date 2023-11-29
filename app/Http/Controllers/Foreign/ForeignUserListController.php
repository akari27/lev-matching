<?php

namespace App\Http\Controllers\Foreign;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Japanese;
use App\Models\Country;
use App\Models\JapanLocation;
use App\Models\HobbyCategory;
use App\Models\Application;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ForeignUserListController extends Controller
{
    public function index(Application $application, User $user, HobbyCategory $hobby_category, JapanLocation $japan_location)
    {
        $application=$application->where('sender_id',Auth::id())->get();
        $users=$user->with('japanese')->where('is_japanese',1)->get();
        
        // $users->foreign_visitor['register_location_id']=Country::where('id',$users->foreign_visitor['register_location_id'])->first()->name;
        // 上のコメントアウトだとむり、eachを使って各ユーザデータに対し処理しないといけなさそう、めんどくさいけどvueで処理するより良さそう・・・？
        $users->each(function ($user) use ($hobby_category, $japan_location) {
            $hobbyId = $user->hobby_category_id;
            $registerLocationId = $user->japanese->register_location_id;
            $oftenGoLocationId = $user->japanese->often_go_location_id;
            
            $hobbyName = $hobby_category->where('id', $hobbyId)->first()->name;
            $registerLocationName = $japan_location->where('id', $registerLocationId)->first()->name;
            $oftenGoLocationName = $japan_location->where('id', $oftenGoLocationId)->first()->name;
            
            $user->hobby = $hobbyName;
            $user->register_location = $registerLocationName;
            $user->often_go_location = $oftenGoLocationName;
        });
        
        return Inertia::render('ForeignUserList',[
            'users' => $users,
            'application' => $application,
        ]);
    }
    
    public function apply(Request $request, User $user, Application $application)
    {
        $input["sender_id"]=Auth::id();
        $input["reciever_id"]=$request["selectedUser"];
        $input["permission_flag"]=0;
        $application->fill($input)->save();
        return Redirect::route('foreign.list.index');
    }
}