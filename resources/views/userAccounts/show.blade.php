@extends('layouts.app')

@section('HeaderTitle',$userAccount -> userName)

@section('userContent')

    <ul>
        <p>Name: {{$userAccount -> userName}}</p>
        <p>User: {{$userAccount -> user -> name}}</p>

        <p><strong>Posts:</strong></p>
        @if ($userAccount->posts->isEmpty())
            <p>No posts found.</p>
        @else
            @foreach ($userAccount->posts as $post)
                <p>{{$post->postText}}</p>
            @endforeach    
        @endif

        @if ($post ->comments->isEmpty())
            <p>This post has no comments</p>
        @else
            <p><strong>Comments:</strong></p>
            @foreach ($post->comments as $comment)
                <p>{{$comment->user->userName}} said {{$comment->commentText}}</p>
            @endforeach    
        @endif

        

        
    </ul>
@endsection
