<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = \DB::table('users')->where('email', '!=', \Auth::user()->email)->whereNull('deleted_at')->get();
        return view('pages.user', compact('users'));
    }

    public function edit($id)
    {
        $user = \DB::table('users')->where('id', base64_decode($id))->first();

        return view('pages.user-edit', compact('user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|' . Rule::unique('users', 'email')->where(function($query) {return $query->where('deleted_at', null);}),
            'pin' => 'required|digits:5',
        ]);

        
        User::insert($data);
        
        return redirect()->route('presence');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        
        $user = \DB::table('users')->where('id', base64_decode($id));
        
        if($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = $user->password;
        }

        $user->update($data);
        
        return redirect()->route('user.index');
    }
    
    public function destroy($id)
    {
        \DB::table('users')->where('id', base64_decode($id))->update(['deleted_at' => now()]);

        return redirect()->route('user.index');
    }
}
