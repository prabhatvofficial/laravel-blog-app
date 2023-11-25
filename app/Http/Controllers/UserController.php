<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showCorrectHomepage(){
        if(auth()->check()){
            return view('homepage-feed');
        }else{
            return view('homepage');
        }
    }

    public function logout(){
        auth()->logout();
        return redirect('/')->with('success', 'Logged out successfully');

    }

    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required',
        ]);
        if(auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])){
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Logged in successfully');
        }else{
            return redirect('/')->with('error', 'Invalid login');
        }
    }

    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' => 'required',
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed'],
        ]);
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/')->with('success', 'Thank you for registering!');
    }
}
