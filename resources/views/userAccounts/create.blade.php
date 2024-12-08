@extends('userAccounts.app')

@section('HeaderTitle','Create account page')

@section('userContent')

<form method="POST" action="{{route('accounts.store')}}">
    @csrf
    <p>username: <input type="text" name="name"
        value="{{old('name')}}"></p>
    
    <p>email: <input type="text" name="email"
    value="{{old('email')}}"></p>    

    <p>password: <input type="password" name="password"
        value="{{old('password')}}"></p>
    <input type="submit" value="submit">

    <a href=" {{route('accounts.index')}}">Cancel</a>
</form>