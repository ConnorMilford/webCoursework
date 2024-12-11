@extends('layouts.app')

@section('title', $post->user->userName .("'s post"))

@section('MainContent')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold">Post Details</h3>

                    <!-- Post -->
                    <div class="my-4 p-4 border-b">
                        <p><strong>{{ $post->user->userName }}</strong> (Posted on: {{ $post->created_at->format('F j, Y') }})</p>
                        <p>{{ $post->postText }}</p>

                        @if (Auth::user()->id === $post->user_account_id)
                                    
                                <!-- Edit Button -->
                                <div class="post-actions flex space-x-2 mt-2">
                                    <button class="edit-post-button bg-transparent text-white px-2 py-1 rounded text-xs" data-id="{{ $post->id }}">Edit</button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-transparent text-white px-2 py-1 rounded text-xs">Delete</button>
                                    </form>

                                    <!-- Hidden Edit Form -->
                                    <div class="edit-form-container hidden mt-4" data-id="{{$post->id}}">
                                        <form class="edit-post-form" data-id="{{ $post->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <textarea name="postText" class="w-full border rounded p-3 text-black">{{ $post->postText }}</textarea>
                                            <button type="button" class="save-post bg-green-500 text-black px-4 py-2 rounded mt-2">Save</button>
                                            <button type="button" class="cancel-post bg-gray-500 text-black px-4 py-2 rounded mt-2">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                    </div>

                    

                    <!-- Comments -->
                    <div class="mt-4">
                        <h4 class="text-lg font-semibold">Comments:</h4>
                        
                        @forelse ($post->comments as $comment)
                            <div class="reply-card my-4 p-6 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 shadow-md">
                                <div class="flex items-center space-x-4">
                                
                                    <div>
                                        <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ $comment->user->userName }}</p>
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

                         <!-- ADD COMMENT BUTTON -->
                                
                         <button class="show-comment-form bg-blue-500 text-white px-4 py-2 rounded mt-6">Add Comment</button>

                        <!-- Hidden Comment Form -->
                        <div class="comment-form-container hidden mt-4 text-black">
                            <form id="comment-form">
                                @csrf
                                <textarea name="comment" placeholder="Write a comment..." class="w-full border rounded p-3"></textarea>
                                <button type="button" class="submit-comment bg-green-500 text-white px-4 py-2 rounded mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).on('click', '.show-comment-form', function() {
        let commentFormContainer = $(this).next('.comment-form-container');
        commentFormContainer.toggleClass('hidden'); // Tailwind's hidden class toggles visibility
    });

    $(document).on('click', '.submit-comment', function() {
        let postId = {{ $post->id }}; // Post ID
        let commentText = $(this).closest('form').find('textarea[name="comment"]').val(); // Get the comment text
        let token = '{{ csrf_token() }}'; // CSRF Token

        if (commentText.trim() === '') {
            alert('Please enter a comment.');
            return;
        }

        // Make the AJAX request to add the comment
        $.ajax({
            url: '/posts/' + postId + '/comments',
            type: 'POST',
            data: {
                _token: token,
                comment: commentText
            },
            success: function(response) {
                if (response.success) {
                    alert('Comment added successfully!');
                    location.reload(); // Reload the page to show the new comment
                } else {
                    alert('Failed to add the comment.');
                }
            },
            error: function(xhr) {
                alert('An error occurred while adding the comment.');
                console.error(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.edit-post-button', function () {
        const postId = $(this).closest('.edit-form-container').data('id');
        const postDiv = $(this).closest('.my-4'); 

        postDiv.find('.edit-form-container').toggleClass('hidden');
        postDiv.find('.post-text').toggleClass('hidden'); 

        postDiv.find('.edit-post-button').hide();
        postDiv.find('.delete-post-button').hide();
    });
    
    $(document).on('click', '.save-post', function () {
        const postId = $(this).closest('.edit-form-container').data('id');
        const postText = $(this).closest('form').find('textarea[name="postText"]').val();
        const token = $('meta[name="csrf-token"]').attr('content'); 


    
        if (!postText.trim()) {
            alert('Post text cannot be empty!');
            return;
        }

        
        $.ajax({
            url: `/posts/${postId}`, 
            type: 'PATCH',
            data: {
                _token: token, 
                postText: postText 
            },
            success: function (response) {
                const postDiv = $(`.edit-form-container[data-id="${postId}"]`).closest('.my-4');
                postDiv.find('.post-text').text(response.postText).removeClass('hidden');
                postDiv.find('.edit-form-container').addClass('hidden');

                // Show the action buttons back
                postDiv.find('.post-actions').show();
                location.reload(); 

            },
            error: function (xhr) {
                alert('Failed to update the post.');
                console.error(xhr.responseText);
            }
        });
    });
</script>
@endpush
