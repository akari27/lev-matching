<?php

namespace App\Http\Controllers\Foreign;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Japanese;
use App\Models\JapanLocation;
use App\Models\HobbyCategory;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ForeignSearchController extends Controller
{
    public function index(
        JapanLocation $japanlocation, 
        HobbyCategory $hobbycategory,
        )
    {
        return Inertia::render('ForeignSearchIndex',[
            'japanlocations' => $japanlocation->get(),
            'hobbycategories' => $hobbycategory->get(),
        ]);
    }
    
    public function search(
        Request $request,
        User $user, 
        Japanese $japanese,
        JapanLocation $japanlocation, 
        HobbyCategory $hobbycategory,
        Application $application,
        )
    {
        $result = [];
        $query = $user->with('japanese')->where('id','!=',Auth::id())->where('is_japanese',1);
        
        if ($request->filled('selectedGender')) {
            $query->where('gender_flag', $request->selectedGender);
        }
        
        if ($request->filled('selectedHobby')) {
            $query->where('hobby_category_id', $request->selectedHobby);
        }
        
        if ($request->filled('selectedRegisterLocation')) {
            // foreign_visitorリレーションを介してregister_location_idを指定
            $query->whereHas('foreign_visitor', function ($q) use ($request) {
                $q->where('register_location_id', $request->selectedRegisterLocation);
        });
        }
        
        if ($request->filled('selectedOftenGoLocation')) {
            $query->whereHas('foreign_visitor', function ($q) use ($request) {
                $q->where('often_go_location_id', $request->selectedOftenGoLocation);
        });
        }
        
        $result = $query->get();
        
        $result->each(function ($r) use($user, $hobbycategory, $japanlocation)
            {
                $hobbyId = $r->hobby_category_id;
                $registerLocationId = $r->japanese->register_location_id;
                $oftenGoLocationId = $r->japanese->often_go_location_id;
                
                $hobbyName = $hobbycategory->where('id', $hobbyId)->first()->name;
                $registerLocationName = $japanlocation->where('id', $registerLocationId)->first()->name;
                $oftenGoLocationName = $japanlocation->where('id', $oftenGoLocationId)->first()->name;
                
                $r->hobby = $hobbyName;
                $r->register_location = $registerLocationName;
                $r->often_go_location = $oftenGoLocationName;
            });
            
        $a=$application->where('sender_id',Auth::id())->get();
    
        return Inertia::render('ForeignSearchIndex',[
            'users' => $result,
            'applications' => $a,
        ]);
    }
    public function apply(Request $request, User $user, Application $application)
    {
        $input["sender_id"]=Auth::id();
        $input["receiver_id"]=$request["selectedUser"];
        $input["permission_flag"]=0;
        $application->fill($input)->save();
        return Redirect::route('foreign.search.index');
    }
}