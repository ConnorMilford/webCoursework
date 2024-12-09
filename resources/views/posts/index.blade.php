@extends('layouts.app')

@section('title', 'Home')

@section('MainContent')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">Posts</h3>

                    @forelse ($posts as $post)
                        <div class="my-4 p-4 border-b">
                            <p><strong>{{ $post->user->name }}</strong> (Posted on: {{ $post->created_at->format('F j, Y') }})</p>
                            <a href="{{ route('posts.show', $post->id) }}">{{$post->postText}}</a>
                        </div>
                    @empty
                        <p>No posts found.</p>
                    @endforelse

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $posts->links() }} <!-- This will display the pagination controls -->
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
