<?php


namespace App\Http\Controllers\Foreign;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use App\Models\Chat;
use App\Models\JapanLocation;
use Illuminate\Support\Facades\Redirect;

// use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;

class ForeignChatController extends Controller
{
    public function index(User $user, Application $application, JapanLocation $japanlocation)
    {
        $approvedApplications = $application->where(function($query) {
            $query->where('sender_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
        })->where('permission_flag', 1)->get();
        
        $approvedApplications->each(function ($approved) use($user,$japanlocation){
            if($approved->sender_id==Auth::id()){
                $userId=$approved->receiver_id;
            }
            else{
                $userId=$approved->sender_id;
            }
            $approved->add_info = $user->with('japanese')->where('id', $userId)->first();
            $register_location = $japanlocation->where('id', $approved->add_info->japanese->register_location_id)->first();
            if($register_location){
                $approved->register_location = $register_location->name;
            }else{
                $approved->register_location = '未登録';
            }
        });
        
        return Inertia::render('ForeignChat/ForeignFriendsList',[
            'approvedApplications'=>$approvedApplications,
        ]);
    }
    
    public function show(User $user, Chat $chat, JapanLocation $japanlocation)
    {
        $register_location = $japanlocation->where('id', $user->register_location_id)->first();
        if($register_location){
            $user->register_location = $register_location->name;
        }else{
            $user->register_location = '未登録';
        }
        
        $user_id = $user->id;
        $messages = $chat->where(function ($query) use ($user_id) {
                        $query->where('sender_id', Auth::id())->where('receiver_id', $user_id)
                    ->orWhere(function ($query) use ($user_id) {
                        $query->where('sender_id', $user_id)->where('receiver_id', Auth::id());
                    });
        })->get();
        
        $messages->each(function ($m)
        {
            $m->send_time = date('m/d H:i', strtotime($m->created_at));
        });
        
        return Inertia::render('ForeignChat/ForeignMessage',[
            'user'=>$user,
            'messages'=>$messages,
        ]);
    }
    
    public function send(StoreMessageRequest $request,Chat $chat, User $user)
    {
        $input["sender_id"]=Auth::id();
        $input["receiver_id"]=$request["receiver_id"];
        $input["message"]=$request["sendMessage"];
        $chat->fill($input)->save();
        
        return Redirect::back();
    }
}