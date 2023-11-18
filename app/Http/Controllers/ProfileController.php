<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\HobbyCategory;
use App\Models\JapanRegion;
use App\Models\JapanLocation;
use App\Models\Japanese;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request,HobbyCategory $hobby_category,JapanRegion $japan_region, JapanLocation $japan_location): Response
    {
        // dd($japan_location->get());
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'hobby_categories' => $hobby_category->get(),
            'japan_regions' => $japan_region->get(),
            'japan_locations' => $japan_location->get(),
        ]);
    }
    

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, Japanese $japanese): RedirectResponse
    {
        // dd($request->all());
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();
        $input["user_id"]=Auth::id();
        $input["register_location_id"]=$request["register_location_id"];
        $input["often_go_location_id"]=$request["often_go_location_id"];
        // dd($input);
        $japanese->fill($input)->save();
        return Redirect::route('profile.edit');
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