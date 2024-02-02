<?php

namespace App\Http\Controllers\Japanese;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Japanese;
use App\Models\HobbyCategory;
use App\Models\JapanLocation;
use App\Models\Application;
use App\Models\Chat;
use App\Http\Requests\ProfileUpdateRequest;
use Cloudinary;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request,Japanese $japanese, HobbyCategory $hobby_category, JapanLocation $japan_location): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'hobbyCategories' => $hobby_category->get(),
            'japanLocations' => $japan_location->get(),
            'japanese' => $japanese->where('user_id',Auth::id())->first(),
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
        
        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        // dd($request->all());
        if($request->file('image_url') != null){
            $image_url = Cloudinary::upload($request->file('image_url')->getRealPath())->getSecurePath();
            $request->user()->image_url=$image_url;
        }
        $request->user()->save();
        $input["user_id"]=Auth::id();
        $input["register_location_id"]=$request["register_location_id"];
        $input["often_go_location_id"]=$request["often_go_location_id"];
        // dd($input);
        $japanese=$japanese->where('user_id',Auth::id())->first();
        $japanese->fill($input)->save();
        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, Application $application,Chat $chat): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();
        
        $matching = $application->where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id());
        $chat = $chat->where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id());

        Auth::logout();
        
        $chat->delete();
        $matching->delete();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}