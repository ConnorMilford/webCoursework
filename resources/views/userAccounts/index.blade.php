@extends('layouts.app')

@section('titleUserName', 'test')

@section('userContent')

    <p>All current registered user accounts:</p>

    <ul>

    @foreach ($userAccounts as $userAccount)
        <li>{{$userAccount->userName}}</li>
    @endforeach

    </ul>
@endsection
