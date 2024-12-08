@extends('layouts.navigation')

@section('name', 'Accounts Index')

@section('userContent')

    <p>All current registered user accounts:</p>
    <p>todo: use paginate here</p>
    <ul>

    @foreach ($userAccounts as $userAccount)
        <li><a href="{{route('accounts.show',['id' => $userAccount->id])}}">{{$userAccount->userName}}</a></li>
    @endforeach

    </ul>
@endsection
