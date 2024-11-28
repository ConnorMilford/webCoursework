@extends('layouts.app')

@section('HeaderTitle','Create account page')

@section('userContent')

<form method="POST" action="{{route('accounts.store')}}">
    @csrf
    <p>name: <input type="text" name="name"
        value="{{old('name')}}"></p>

    <p>userID: <input type="number" name="user_id" min="0"
        value="{{old('user_id')}}"></p>
    <input type="submit" value="submit">

    <a href=" {{route('accounts.index')}}">Cancel</a>
</form>