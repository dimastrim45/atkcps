<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function showITAdmin()
    {
        // auth()->user()->department = 'MGM';

        return view('it_admin.users.profile',[
            'title' => 'profile'
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        // dd($request->all());
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'branch' => $request->branch,
            'department' => $request->department,
            'license' => $request->license,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
