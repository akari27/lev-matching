<?php

namespace App\Http\Controllers\Foreign;

use App\Models\User;
use App\Models\HobbyCategory;
use App\Models\JapanRegion;
use App\Models\JapanLocation;
use App\Models\Country;
// use App\Models\ForeignVisitor;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ForeignMypageController extends Controller
{
    public function show(Request $request,User $user,HobbyCategory $hobby_category, JapanLocation $japan_location, Country $country): Response
    {
        $user=$user->where('id',Auth::id())->with('foreign_visitor')->first();
        $user_data['hobby_category']=$hobby_category->where('id',$user['hobby_category_id'])->first()->name;
        $user_data['register_location']=$country->where('id',$user->foreign_visitor['register_location_id'])->first()->name;
        $user_data['stay_location']=$japan_location->where('id',$user->foreign_visitor['stay_location_id'])->first()->name;
        $user_data['start_of_stay']=$user->foreign_visitor->start_of_stay;
        $user_data['end_of_stay']=$user->foreign_visitor->end_of_stay;
        $user_data['reason']=$user->foreign_visitor->reason;
        return Inertia::render('ForeignMypage', [
            'user_data' => $user_data
        ]);
    }
}
