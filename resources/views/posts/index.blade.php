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
                        
                    @empty
                        <p>No posts found.</p>
                    @endforelse

                    
                    <div class="mt-4">
                        {{ $posts->links() }} 
                    </div>

                    <!-- ADD post BUTTON -->
                                
                    <button class="show-post-form bg-blue-500 text-black px-4 py-2 rounded mt-6">Add Post</button>

                    <!-- post form -->
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
    // EDIT POST SAVE BUTTON
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
        

    $(document).on('click', '.show-post-form', function() {
        let postFormContainer = $(this).next('.post-form-container');
        postFormContainer.toggleClass('hidden'); 
    });

    
    //ADD POST SUBMIT BUTTON
    $(document).on('click', '.submit-post', function() {
        let postId = {{ $post->id }}; 
        let postText = $(this).closest('form').find('textarea[name="post"]').val(); 
        let token = '{{ csrf_token() }}'; 

        if (postText.trim() === '') {
            alert('Please enter a post.');
            return;
        }

       
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
                    location.reload(); 
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