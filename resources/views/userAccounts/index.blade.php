@extends('layouts.app')

@section('titleUserName', 'test')

@section('userContent')

    <p>All current registered user accounts:</p>

    <ul>

    @foreach ($userAccounts as $userAccount)
        <li><a href="{{route('accounts.show',['id' => $userAccount->id])}}">{{$userAccount->userName}}</a></li>
    @endforeach

    </ul>
@endsection
