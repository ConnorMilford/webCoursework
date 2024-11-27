<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function show(string $id) : View
    {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }
}
