<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'pin']);
        $credentials['deleted_at'] = null;

        $user = User::where('email', $request->email)->where('pin', $request->pin)->where('deleted_at', null)->first();

        if (\Auth::loginUsingId($user->id)) {
            if($user->role != 'employee') {
                return redirect()->route('employee.index');
            }
            return redirect()->route('employee.detail', base64_encode($user->id));
        }
        
        return view('login');
    }

    public function logout()
    {
        if(\Auth::check()) {
            \Auth::logout();
        }

        return redirect()->route('login');
    }
}
