<?php

namespace App\Http\Controllers\Foreign;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\HobbyCategory;
use App\Models\JapanRegion;
use App\Models\JapanLocation;
use App\Models\Country;
use App\Models\ForeignVisitor;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Cloudinary;
use App\Http\Controllers\Controller;

class ForeignProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request,HobbyCategory $hobby_category,ForeignVisitor $foreign_visitor, JapanRegion $japan_region, JapanLocation $japan_location, Country $country): Response
    {
        return Inertia::render('ForeignProfile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'hobby_categories' => $hobby_category->get(),
            'japan_regions' => $japan_region->get(),
            'japan_locations' => $japan_location->get(),
            'countries' => $country->get(),
            'foreign' => $foreign_visitor->where('user_id',Auth::id())->first(),
        ]);
    }
    

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request,ForeignVisitor $foreign_visitor): RedirectResponse
    {
        // dd($request->all());
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        
        if($request->file('image_url') != null){
            $image_url = Cloudinary::upload($request->file('image_url')->getRealPath())->getSecurePath();
            $request->user()->image_url=$image_url;
        }
        $request->user()->save();
        $input["user_id"]=Auth::id();
        $input["register_location_id"]=$request["register_location_id"];
        $input["stay_location_id"]=$request["stay_location_id"];
        $input["start_of_stay"]=$request["start_of_stay"];
        $input["end_of_stay"]=$request["end_of_stay"];
        $input["reason"]=$request["reason"];
        $foreign=$foreign_visitor->where('user_id',Auth::id())->first();
        $foreign->fill($input)->save();
        return Redirect::route('foreign.profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}