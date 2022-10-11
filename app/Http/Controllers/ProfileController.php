<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('mainpage.profile.edit');
    }

    public function update(Request $request)
    {
        $rules = [

            'name'=> 'required|max:255',
            'password' => 'required|min:5|max:255'
        ];

        if($request->username != auth()->user()->username)
        {
            $rules['username'] = ['required', 'min:5', 'max:255', 'unique:users'];
        }

        if($request->email != auth()->user()->email)
        {
            $rules['email'] = 'required|email|unique:users';
        }

        $validatedData = $request->validate($rules);
        $validatedData['id'] = auth()->user()->id;
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::where('id',auth()->user()->id)->update($validatedData);

        return back()->with('success','Your profile has been edited!');
    }
}
