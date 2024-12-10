@extends('layouts.app')

@section('title', 'Edit Profile')

@section('MainContent')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 black dark:black">
                    <h3 class="text-lg font-semibold">Edit Profile</h3>

                    <!-- Edit Profile Form -->
                    <form id="edit-profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="space-y-6">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium black dark:black">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required
                                    class="w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium black dark:black">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required
                                    class="w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            </div>

                            <!-- Password Field (optional) -->
                            <div>
                                <label for="password" class="block text-sm font-medium black dark:black">New Password</label>
                                <input type="password" name="password" id="password" placeholder="Leave blank to keep the current password"
                                    class="w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            </div>

                            <!-- Confirm Password Field -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium black dark:black">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            </div>

                            <div class="py-12">
       
                            <!--  Profile Picture -->
                            <div class="flex items-center space-x-4">
                                <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/default-profile.png') }}" 
                                     alt="Profile Picture" class="w-16 h-16 rounded-full border">

                                <div>
                                    <label for="profile_picture" class="text-sm font-medium text-gray-700 dark:text-gray-300">Profile Picture</label>
                                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="mt-1">
                                </div>
                            <div class="mt-4">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save Changes</button>
                            </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Optional AJAX handling for form submission
    $(document).on('submit', '#edit-profile-form', function(e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize(); // Serialize the form data for submission
        let token = $('meta[name="csrf-token"]').attr('content');

        // Send an AJAX request to update the profile
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function(response) {
                alert('Profile updated successfully!');
                // Optionally, you can reload the page to reflect the changes
                location.reload();
            },
            error: function(xhr) {
                // Handle errors if any
                alert('An error occurred while updating your profile.');
                console.error(xhr.responseText);
            }
        });
    });
</script>
@endpush
