<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Japanese;
use App\Models\ForeignVisitor;
use App\Models\JapanLocation;
use App\Models\Country;
use App\Models\HobbyCategory;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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
        HobbyCategory $hobbycategory
        )
    {
        $result = [];
        $query = User::with('foreign_visitor')->where('id','!=',Auth::id())->where('is_japanese',0);
        
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
    
        return Inertia::render('SearchIndex',[
            'users' => $result,
            'countries' => $country->get(),
            'hobbycategories' => $hobbycategory->get(),
        ]);
    }
}