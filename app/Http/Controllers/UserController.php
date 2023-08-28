<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('it_admin.users.index', compact('users'), [
            'title' => 'users'
        ]);
    }
}
