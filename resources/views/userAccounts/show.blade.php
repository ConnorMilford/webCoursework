@extends('layouts.app')

@section('HeaderTitle', $userAccount -> userName)

@section('userContent')

    <ul>
        <li>Name: {{$userAccount -> userName}}</li>
        <li>User: {{$userAccount -> user -> name}}</li>

        <p><strong>Posts:</strong></p>
        @if ($userAccount->posts->isEmpty())
            <p>No posts found.</p>
        @else
            @foreach ($userAccount->posts as $post)
                <li>{{$post->postText}}</li>
            @endforeach    
        @endif

        @if ($post ->comments->isEmpty())
            <p>This post has no comments</p>
        @else
            <p><strong>Comments:</strong></p>
            @foreach ($post->comments as $comment)
                <li>{{$comment->user->name}}: {{$comment->commentText}}</li>
            @endforeach    
        @endif

        

        
    </ul>
@endsection
