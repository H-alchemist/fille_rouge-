@extends('dash.dashboard')

@section('title', 'CheckArena - Profile')

@section('dashboard-content') 

<div class="mb-6">
  <h1 class="text-2xl text-[#4ca9f5] mb-4">Profile</h1>
</div>

<div class="w-full max-w-4xl mx-auto bg-[#1f1f1f] rounded-lg p-6 shadow-lg">
  <form action="/profile" method="POST" enctype="multipart/form-data">
    @csrf
    

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-800/20 text-green-400 rounded">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-800/20 text-red-400 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Avatar Field -->
    <div class="mb-6 flex flex-col sm:flex-row items-center gap-4">
        <label for="avatar" class="text-sm text-gray-400">Profile Image:</label>
        <div class="w-32 h-32 rounded-full bg-gray-600 overflow-hidden mb-4 sm:mb-0">
            <img 
                src="{{  Auth::user()->profile->avatar
                    ? asset('/storage/'.Auth::user()->profile->avatar) 
                    : asset('images/default-avatar.png') }}" 
                alt="Avatar" 
                class="w-full h-full object-cover"
                id="avatarPreview"
            >
        </div>
        <input 
            type="file" 
            id="avatar" 
            name="avatar" 
            class="px-4 py-2 bg-gray-800 border border-gray-700 rounded text-white text-sm cursor-pointer w-full sm:w-auto"
            onchange="previewAvatar(this)"
        >
    </div>

    <!-- Username Field -->
    <div class="mb-6 flex flex-col sm:flex-row items-center gap-4">
        <label for="username" class="text-sm text-gray-400">Username:</label>
        <input 
            type="text" 
            id="username" 
            name="username" 
            
            class="px-4 py-2 bg-gray-800 border border-gray-700 rounded text-white text-sm w-full sm:w-auto"
        >
        @error('username')
            <span class="text-red-400 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="flex justify-center mt-6">
        <button 
            type="submit" 
            class="bg-blue-500 text-white rounded py-2 px-6 hover:bg-blue-600 transition-all"
        >
            Save Changes
        </button>
    </div>
</form>


</div>

@endsection

@push('scripts')



<script>
  function previewAvatar(input) {
      if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function(e) {
              document.getElementById('avatarPreview').src = e.target.result;
          };
          reader.readAsDataURL(input.files[0]);
      }
  }
  </script>


@endpush