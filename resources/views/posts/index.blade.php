@extends('layouts.app')

@section('title', 'Home')

@section('MainContent')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">Posts</h3>

                    @forelse ($posts as $post)
                        <div class="my-2 p-2 border-b">

                            <div class="flex">
                                <p><strong><a href="{{route('accounts.show', $post->user->id)}}">{{$post->user->userName}}</a></strong> (Posted on: {{ $post->created_at->format('F j, Y') }})</p>
                                <button class="favourite-post-button bg-transparent text-white px-2 py-1 rounded text-xs" data-id="{{ $post->id }}">
                                        {{ in_array($post->id, auth()->user()->saved_posts ?? []) ? 'Unsave' : 'Save' }}
                                    </button>
                            </div>

                            <a href="{{ route('posts.show', $post->id) }}">{{$post->postText}}</a>
                            
                            
                            
                                @if (Auth::user()->id === $post->user_account_id)
                                    
                                <!-- Edit Button -->
                                <div class="post-actions flex space-x-2 mt-2">
                                    <button class="edit-post-button bg-transparent text-white px-2 py-1 rounded text-xs" style="display: inline;" data-id="{{ $post->id }}">Edit</button>

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
                                            <textarea name="postText" class="w-full border rounded p-3 text-black" data-id="{{$post->postText}}">{{ $post->postText }}</textarea>
                                            <button type="button" class="save-post bg-transparent text-white px-4 py-2 rounded mt-2" data-id="{{$post->postText}}">Save</button>
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
                                
                    <button class="show-post-form bg-transparent text-white px-4 py-2 rounded mt-6">Add Post</button>

                    <!-- post form -->
                    <div class="hidden post-form-container mt-4 text-black" data-id="{{$post->postText}}">
                        <form action="{{ route('posts.store') }}" class=" shadow-md rounded-lg" data-id="{{$post->postText}}">
                            @csrf
                            @method('PATCH')
                            <textarea name="text" placeholder="Write a post..." class="w-full border rounded" data-id="{{$post->postText}}"></textarea>
                            <button type="button" class="submit-post bg-transparent  text-white px-4 py-2 rounded mt-2">Submit</button>
                        </form>
                    </div>

                    

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    
    $(document).on('click', '.favourite-post-button', function () {
        const postId = $(this).data('id');
        const isSaved = $(this).text().trim() === 'Unsave';  

        const url = isSaved ? '/posts/unsave' : '/posts/save';
        const button = $(this); 

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',  
                postId: postId,  
            },
            success: function(response) {
                if (response.success) {
                    const newText = isSaved ? 'Save' : 'Unsave';
                    button.text(newText);  
                    alert(response.message);
                } else {
                    alert('Failed to save/unsave the post.');
                }
            },
            error: function(xhr) {
                alert('An error occurred while saving/unsaving the post.');
                console.error(xhr.responseText);
            }
        });
    });
    
    // EDIT POST BUTTON
    $(document).on('click', '.edit-post-button', function () {
        $('.edit-form-container').toggleClass('hidden');
        $('.save-button').toggleClass('hidden');
        $('.edit-button').toggleClass('hidden');
    });
    
    //EDIT POST UPLOAD 
    $(document).on('click', '.save-post', function () {
        const postId = $(this).closest('.edit-form-container').data('id');
        const postText = $(this).closest('form').find('textarea[name="postText"]').val();
        const token = $('meta[name="csrf-token"]').attr('content'); 


    
        if (!postText || postText.trim() === '') {
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
                postDiv.find('.text').text(response.postText).removeClass('hidden');
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
        $('.post-form-container').toggleClass('hidden');
    });

    
    
    // ADD POST (Submit the new post via AJAX)
    $(document).on('click', '.submit-post', function () {

        const postText = $(this).closest('form').find('textarea[name="text"]').val();
        const token = $('meta[name="csrf-token"]').attr('content');

        if (!postText || postText.trim() === '') {
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
            success: function (response) {
                if (response.success) {
                    alert('Post added successfully!');
                    location.reload(); 
                } else {
                    alert('Failed to add the post.');
                }
            },
            error: function (xhr) {
                alert('An error occurred while adding the post.');
                console.error(xhr.responseText); 
            }
        });
    });



</script>
@endpush

