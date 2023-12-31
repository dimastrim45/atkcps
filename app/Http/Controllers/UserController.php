<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Plant;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        
        return view('it_admin.users.index', compact('users'), [
            'title' => 'users',
            'user' => $users
        ]);
    }


    public function edit(User $user)
    {
        // dd($user);
        $plants = Plant::all();

        return view('it_admin.users.edit',[
            'title' => 'edit-user',
            'user' => $user,
            'plants' => $plants,
        ]);
        
        //
    }


    // Update the specified resource in storage.
    public function update(Request $request, User $user)
    {
        // dd($request->email);
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'confirmed', 'min:8'],
            'plant_id' => ['required'],
            'department' => ['required'],
            'license' => ['required'],
        ]);

        // Check if the 'password' field in the request is not empty
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            // If 'password' is empty, remove it from the validated data array
            unset($validatedData['password']);
        }
        
        User::where('id', $user->id)->update($validatedData);
        return redirect()->back()->with('success', 'Profile updated.');
    }

    // delete selected user
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User Deleted.');
        // if ($user->permintaan->isEmpty()) {
        //     // If there are no Permintaan associated with the user, you can proceed with deletion.
        //     $user->delete();
        //     return redirect()->back()->with('success', 'User Deleted.');
        // } else {
        //     // If there are associated Permintaan, show an error message or take appropriate action.
        //     return redirect()->back()->with('error', 'User has associated Permintaan and cannot be deleted.');
        // }
    }
}
