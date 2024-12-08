@extends('userAccounts.app')

@section('HeaderTitle',$userAccount -> userName)

@section('userContent')

    <ul>
        <p>Name: <Strong>{{$userAccount -> userName}}</Strong></p>

        <p><strong>Posts:</strong></p>
        @if ($userAccount->posts->isEmpty())
            <p>No posts found.</p>
        @else
            @foreach ($userAccount->posts as $post)
                <p>{{$post->postText}}</p>
            @endforeach    
        @endif

        @foreach ($userAccount ->posts as $post)
            <p><strong>Comments:</strong></p>
            @foreach ($post->comments as $comment)
                <p>{{$comment->user->userName}} said {{$comment->commentText}}</p>
            @endforeach
        @endforeach   
        

        

        
    </ul>
@endsection
