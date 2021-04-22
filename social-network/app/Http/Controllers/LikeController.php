<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like(Request $request,$msg_id){        
        $user=$request->user();
        $msg = Message::findOrFail($msg_id);

        if ($user->is_like($msg_id)){
            $msg->like_count -= 1;  
            $msg->users()->detach($user->id);            
        }else{
            $msg->like_count += 1;  
            $msg->users()->attach(User::where('id', $user->id)->first());        
        }        
        $msg->save();  
        return redirect('/home');
    }
}
