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



    

}
