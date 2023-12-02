<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function createFollow(User $user){
        //You can not follow yourself
        if($user->id == auth()->user()->id){
            return back()->with('error', 'You can\'t follow yourself');
        }
        //You can not follow someone you are already following
        $existCheck = Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->count();
        if($existCheck){
            return back()->with('error', 'You are already following this user');
        }
        $newFollow = new Follow;
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followeduser = $user->id;
        $newFollow->save();
        return back()->with('success', 'Followed successfully');
    }

    public function removeFollow(User $user){
        Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->delete();
        return back()->with('success', 'You unfollowed user successfully');
    }
}
