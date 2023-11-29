<?php

namespace App\Http\Controllers\Japanese;

use App\Models\User;
use App\Models\HobbyCategory;
use App\Models\JapanLocation;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function show(User $user,HobbyCategory $hobby_category,JapanLocation $japan_location): Response
    {
        $user=$user->where('id',Auth::id())->with('japanese')->first();
        $user_data['hobby_category']=$hobby_category->where('id',$user['hobby_category_id'])->first()->name;
        $user_data['register_location']=$japan_location->where('id',$user->japanese['register_location_id'])->first()->name;
        $user_data['often_go_location']=$japan_location->where('id',$user->japanese['often_go_location_id'])->first()->name;
        return Inertia::render('Mypage', [
            'user_data' => $user_data
        ]);
    }
}
