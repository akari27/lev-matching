<?php

namespace App\Http\Controllers;

use App\Models\HobbyCategory;
use App\Models\JapanRegion;
use App\Models\JapanLocation;
use App\Models\Country;
use App\Models\ForeignVisitor;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

use Illuminate\Http\Request;

class ForeignMypageController extends Controller
{
    public function show(Request $request,HobbyCategory $hobby_category,JapanRegion $japan_region, JapanLocation $japan_location, Country $country): Response
    {
        // dd(Japanese::where('user_id',Auth::id())->first());
        return Inertia::render('ForeignMypage', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'hobby_categories' => $hobby_category->get(),
            'japan_regions' => $japan_region->get(),
            'japan_locations' => $japan_location->get(),
            'countries' => $country->get(),
            'foreign' => ForeignVisitor::where('user_id',Auth::id())->first(),
        ]);
    }
}
