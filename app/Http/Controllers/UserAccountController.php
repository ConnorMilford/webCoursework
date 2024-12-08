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

    public function create()
    {
        return view('userAccounts.create');
    }

    public function store(Request $request)
    {
      $validData = $request->validate([
        'name' => 'required|max:35',
        'email' => 'required|email|max:60',
        'password' => 'required|min:8|max:60',
      ]);

      $newAccount = new UserAccount;
      $newAccount->userName = $validData['name'];
      $newAccount->email = $validData['email'];
      $newAccount->password = bcrypt( $validData['password']);
      $newAccount->save();

      session()->flash('message', 'Account created :)');
      return redirect()->route('accounts.index');
    }


    

}
