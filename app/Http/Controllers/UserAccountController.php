<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function index() 
    {
        $userAccounts = UserAccount::paginate(15);

        return view('userAccounts.index', compact('userAccounts'));
    }

    public function show($id) 
    {
        $user = UserAccount::find($id);

        if (!$user) {
            // If user account doesn't exist, return a 404 response
            abort(404, 'User Account not found');
        }

        return view('accounts.show', compact('user'));
    }



    

}
