<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function index() 
    {
        $userAccounts = UserAccount::all();

        return view('userAccounts.index', ['userAccounts' => $userAccounts]);
    }

    public function show($id)
    {
        $userAccount = UserAccount::findOrFail($id);

        return view('userAccounts.show', ['userAccount' => $userAccount]);

    }

}
