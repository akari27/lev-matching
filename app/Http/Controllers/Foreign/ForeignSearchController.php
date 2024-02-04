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
    public function index(JapanLocation $japanlocation, HobbyCategory $hobbycategory)
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
        // $query = $user->with('japanese')->where('id','!=',Auth::id())->where('is_japanese',1);
        
        $a = $application->where('sender_id',Auth::id())->where('permission_flag','!=',0);
        $b = $application->where('receiver_id',Auth::id())->where('permission_flag','!=',0);
        
        $receiver_ids = $a->pluck('receiver_id');
        $sender_ids = $b->pluck('sender_id');
        
        $query = $user->with('japanese')
                      ->where('is_japanese', 1)
                      ->whereNotIn('id', $receiver_ids)
                      ->whereNotIn('id', $sender_ids);
        
        if ($request->filled('selectedGender')) {
            $query->where('gender_flag', $request->selectedGender);
        }
        
        if ($request->filled('selectedHobby')) {
            $query->where('hobby_category_id', $request->selectedHobby);
        }
        
        if ($request->filled('selectedRegisterLocation')) {
            // japaneseリレーションを介してregister_location_idを指定
            $query->whereHas('japanese', function ($q) use ($request) {
                $q->where('register_location_id', $request->selectedRegisterLocation);
        });
        }
        
        if ($request->filled('selectedOftenGoLocation')) {
            $query->whereHas('japanese', function ($q) use ($request) {
                $q->where('often_go_location_id', $request->selectedOftenGoLocation);
        });
        }
        
        $result = $query->get();

        $result->each(function ($r) use($user, $hobbycategory, $japanlocation)
            {
                $hobbyId = $r->hobby_category_id;
                $hobbyName = $hobbycategory->where('id', $hobbyId)->first()->name;
                $r->hobby = $hobbyName;
                
                if($r->japanese->register_location_id != null){
                    $registerLocationId = $r->japanese->register_location_id;
                    $registerLocationName = $japanlocation->where('id', $registerLocationId)->first()->name;
                    $r->register_location = $registerLocationName;
                }
                if($r->japanese->often_go_location_id != null){
                    $oftenGoLocationId = $r->japanese->often_go_location_id;
                    $oftenGoLocationName = $japanlocation->where('id', $oftenGoLocationId)->first()->name;
                    $r->often_go_location = $oftenGoLocationName;
                }
            });
            
        $a=$application->where('sender_id',Auth::id())->get();
    
        return Inertia::render('ForeignSearchIndex',[
            'users' => $result,
            'japanlocations' => $japanlocation->get(),
            'hobbycategories' => $hobbycategory->get(),
            'applications' => $a,
        ]);
    }
    public function apply(Request $request, User $user, Application $application, JapanLocation $japanlocation, HobbyCategory $hobbycategory)
    {
        $input["sender_id"]=Auth::id();
        $input["receiver_id"]=$request["selectedUser"];
        $input["permission_flag"]=0;
        $application->fill($input)->save();
        return Inertia::render('ForeignSearchIndex',[
            'users' => $request["allUsers"],
            'japanlocations' => $japanlocation->get(),
            'hobbycategories' => $hobbycategory->get(),
            'applications' => $application->where('sender_id',Auth::id())->get(),
        ]);
    }
}