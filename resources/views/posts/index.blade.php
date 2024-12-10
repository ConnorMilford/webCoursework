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
                            <p><strong>{{ $post->user->userName }}</strong> (Posted on: {{ $post->created_at->format('F j, Y') }})</p>
                            <a href="{{ route('posts.show', $post->id) }}">{{$post->postText}}</a>
                            <!-- Edit Button -->
                            @if (Auth::id() == $post->user_id) 
                                <button class="edit-post-button bg-yellow-500 text-white px-4 py-2 rounded mt-2">Edit Post</button>
                            @endif
                        </div>
                    @empty
                        <p>No posts found.</p>
                    @endforelse

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $posts->links() }} 
                    </div>

                    <!-- ADD post BUTTON -->
                                
                    <button class="show-post-form bg-blue-500 text-white px-4 py-2 rounded mt-6">Add Post</button>

                    <!-- Hidden post Form -->
                    <div class="post-form-container hidden mt-4 text-black">
                        <form id="post-form">
                            @csrf
                            <textarea name="post" placeholder="Write a post..." class="w-full border rounded p-3"></textarea>
                            <button type="button" class="submit-post bg-green-500 text-white px-4 py-2 rounded mt-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    $(document).on('click', '.show-post-form', function() {
        let postFormContainer = $(this).next('.post-form-container');
        postFormContainer.toggleClass('hidden'); // Tailwind's hidden class toggles visibility
    });

    $(document).on('click', '.submit-post', function() {
        let postId = {{ $post->id }}; // Post ID
        let postText = $(this).closest('form').find('textarea[name="post"]').val(); // Get the post text
        let token = '{{ csrf_token() }}'; // CSRF Token

        if (postText.trim() === '') {
            alert('Please enter a post.');
            return;
        }

        // Make the AJAX request to add the post
        $.ajax({
            url: '/posts/',
            type: 'POST',
            data: {
                _token: token,
                postText: postText
            },
            success: function(response) {
                if (response.success) {
                    alert('post added successfully!');
                    location.reload(); // Reload the page to show the new post
                } else {
                    alert('Failed to add the post.');
                }
            },
            error: function(xhr) {
                alert('An error occurred while adding the post.');
                console.error(xhr.responseText);
            }
        });
    });
</script>
@endpush