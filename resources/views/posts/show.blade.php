@extends('layouts.app')

@section('title', $post->user->name .("'s post"))

@section('MainContent')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold">Post Details</h3>

                    <!-- Post -->
                    <div class="my-4 p-4 border-b">
                        <p><strong>{{ $post->user->name }}</strong> (Posted on: {{ $post->created_at->format('F j, Y') }})</p>
                        <p>{{ $post->postText }}</p>
                    </div>

                    <!-- Comments -->
                    <div class="mt-4">
                        <h4 class="text-lg font-semibold">Comments:</h4>
                        
                        @forelse ($post->comments as $comment)
                            <div class="reply-card my-4 p-6 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 shadow-md">
                                <div class="flex items-center space-x-4">
                                
                                    <div>
                                        <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ $comment->user->name }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->created_at->format('F j, Y') }}</p>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <p class="text-gray-700 dark:text-gray-300">{{ $comment->commentText }}</p>
                                </div>
                            </div>
                        @empty
                            <p>No postText yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
