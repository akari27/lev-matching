<?php

namespace App\Http\Controllers\Japanese;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ForeignVisitor;
use App\Models\Country;
use App\Models\JapanLocation;
use App\Models\HobbyCategory;
use App\Models\Application;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserListController extends Controller
{
    public function index(User $user,Application $application,HobbyCategory $hobby_category,Country $country,JapanLocation $japan_location)
    {
        $application=$application->where('sender_id',Auth::id())->get();
        $users=$user->with('foreign_visitor')->where('is_japanese',0)->get();
        
        // $users->foreign_visitor['register_location_id']=Country::where('id',$users->foreign_visitor['register_location_id'])->first()->name;
        // 上のコメントアウトだとむり、eachを使って各ユーザデータに対し処理しないといけなさそう、めんどくさいけどvueで処理するより良さそう・・・？
        $users->each(function ($user) use($hobby_category, $country, $japan_location) {
            $hobbyId = $user->hobby_category_id;
            $registerLocationId = $user->foreign_visitor->register_location_id;
            $stayLocationId = $user->foreign_visitor->stay_location_id;

            $hobbyName = $hobby_category->where('id', $hobbyId)->first()->name;
            $registerLocationName = $country->where('id', $registerLocationId)->first()->name;
            $stayLocationName = $japan_location->where('id', $stayLocationId)->first()->name;

            $user->hobby = $hobbyName;
            $user->register_location = $registerLocationName;
            $user->stay_location = $stayLocationName;
        });
        
        return Inertia::render('UserList',[
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
        return Redirect::route('list.index');
    }
}