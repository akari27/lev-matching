<?php


namespace App\Http\Controllers\Japanese;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(User $user, Application $application)
    {
        $approvedApplications = $application->where(function($query) {
            $query->where('sender_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
        })->where('permission_flag', 1)->get();
        
        $approvedApplications->each(function ($approved) use($user){
            if($approved->sender_id==Auth::id()){
                $userId=$approved->receiver_id;
            }
            else{
                $userId=$approved->sender_id;
            }
            $approved->user_id=$user->with('foreign_visitor')->where('id',$userId)->first()->id;
            $approved->name=$user->with('foreign_visitor')->where('id',$userId)->first()->name;
            $approved->image_url=$user->with('foreign_visitor')->where('id',$userId)->first()->image_url;
        });
        
        return Inertia::render('Chat/FriendsList',[
            'approvedApplications'=>$approvedApplications,
        ]);
    }
    
    public function show(User $user, Chat $chat)
    {
        $user_id = $user->id;
        $messages = $chat->where(function ($query) use ($user_id) {
                        $query->where('sender_id', Auth::id())->where('receiver_id', $user_id)
                    ->orWhere(function ($query) use ($user_id) {
                        $query->where('sender_id', $user_id)->where('receiver_id', Auth::id());
                    });
        })->get();
        return Inertia::render('Chat/Message',[
            'user'=>$user,
            'messages'=>$messages,
        ]);
    }
    
    public function send(Request $request,Chat $chat, User $user)
    {
        $input["sender_id"]=Auth::id();
        $input["receiver_id"]=$request["receiver_id"];
        $input["message"]=$request["sendMessage"];
        $chat->fill($input)->save();
        
        return Redirect::back();
    }
}