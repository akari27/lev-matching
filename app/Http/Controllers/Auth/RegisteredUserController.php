<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Japanese;
use App\Models\ForeignVisitor;
use App\Models\HobbyCategory;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(HobbyCategory $hobby_category): Response
    {
        return Inertia::render('Auth/Register',[
            'hobby_categories' => $hobby_category->get(),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_japanese' => 'required|integer',
            'gender_flag' => 'required|integer',
            'age' => 'required|integer|max:100',
            'hobby_category_id' => 'required|integer',
        ]);

        // dd($request->all());
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_japanese' => $request->is_japanese,
            'gender_flag' => $request->gender_flag,
            'age' => $request->age,
            'hobby_category_id' => $request->hobby_category_id,
        ]);
        
        if($user->is_japanese==1){
            Japanese::create([
                'user_id' => $user->id,
            ]);
        }else{
            ForeignVisitor::create([
                'user_id' => $user->id,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        if(Auth::user()->is_japanese==0){
            return redirect(RouteServiceProvider::JAPANESE_HOME);
        }else{
            return redirect(RouteServiceProvider::FOREIGN_HOME);
        }
    }
}
