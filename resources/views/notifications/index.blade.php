@extends('layouts.app')

@section('title', 'Notifications')

@section('MainContent')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">Notifications</h3>

                    @forelse ($notifications as $notification)
                        <div class="my-2 p-2 border-b">

                            <div class="flex">
                                <p>
                                    <strong>{{ $notification->data['comment_text'] }}</strong> on your post: 
                                    <strong>{{ $notification->data['post_text'] }}</strong>
                                </p>

                                <!-- Mark as Read Button -->
                                <form action="{{ route('notifications.markRead', $notification->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success float-end">Mark as Read</button>
                                </form>
                            </div>

                            <!-- Link to Post -->
                            <a href="{{ url('/posts/' . $notification->data['post_id']) }}" class="btn btn-primary btn-sm mt-2">View Post</a>

                        </div>
                    @empty
                        <p>No new notifications.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
