<?php

namespace App\Http\Controllers\Japanese;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ForeignVisitor;
use App\Models\JapanLocation;
use App\Models\Country;
use App\Models\HobbyCategory;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class SearchController extends Controller
{
    public function index(
        JapanLocation $japanlocation, 
        Country $country,
        HobbyCategory $hobbycategory,
        )
    {
        return Inertia::render('SearchIndex',[
            'countries' => $country->get(),
            'hobbycategories' => $hobbycategory->get(),
        ]);
    }
    
    public function search(
        Request $request,
        User $user, 
        ForeignVisitor $foreignvisitor, 
        JapanLocation $japanlocation, 
        Country $country,
        HobbyCategory $hobbycategory,
        Application $application,
        )
    {
        $result = [];
        $query = $user->with('foreign_visitor')->where('id','!=',Auth::id())->where('is_japanese',0);
        
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
        
        if ($request->filled('selectedStayLocation')) {
            $query->whereHas('foreign_visitor', function ($q) use ($request) {
                $q->where('stay_location_id', $request->selectedStayLocation);
        });
        }
    
        $result = $query->get();
        
        $result->each(function ($r) use($user, $hobbycategory, $japanlocation, $country)
            {
                $hobbyId = $r->hobby_category_id;
                $registerLocationId = $r->foreign_visitor->register_location_id;
                $stayLocationId = $r->foreign_visitor->stay_location_id;
                
                $hobbyName = $hobbycategory->where('id', $hobbyId)->first()->name;
                $registerLocationName = $country->where('id', $registerLocationId)->first()->name;
                $stayLocationName = $japanlocation->where('id', $stayLocationId)->first()->name;
                
                $r->hobby = $hobbyName;
                $r->register_location = $registerLocationName;
                $r->stay_location = $stayLocationName;
            });
            
        $a=$application->where('sender_id',Auth::id())->get();
    
        return Inertia::render('SearchIndex',[
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
        return Redirect::route('search.index');
    }
}

