

@extends('app')

@section('title', 'Authentication')

@section('content')
<div class="flex justify-center items-center py-10 px-5 flex-1">
  <div class="bg-gray-800 rounded-lg shadow-xl w-full max-w-md p-8 border border-gray-700">
    <div class="text-center mb-6">
      <h2 class="text-3xl font-bold text-blue-400 mb-2">Welcome to CheckArena</h2>
      <p class="text-gray-400">The free, open-source chess platform</p>
    </div>
    
    <div class="flex mb-6 border-b border-gray-700">
      <div class="flex-1 text-center py-3 font-semibold cursor-pointer text-blue-400 border-b-2 border-blue-400" id="login-tab">Log In</div>
      <div class="flex-1 text-center py-3 font-semibold cursor-pointer text-gray-400 hover:text-white transition" id="register-tab">Sign Up</div>
    </div>
    
    <!-- Login Form -->
    <div id="login-form" class="{{ $title == 'userLogin' ? '' : 'hidden' }}">
      <form class="space-y-5" action="/userLogin" method="POST">
        @csrf
        <div>
          <label for="login-email" class="block font-medium mb-1">Email</label>
          <input type="email" id="login-email" name="email" value="" placeholder="your@email.com" 
                 class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded focus:border-blue-400 focus:outline-none transition" required>
        </div>
        
        <div>
          <label for="login-password" class="block font-medium mb-1">Password</label>
          <input type="password" id="login-password" name="password" placeholder="••••••••" 
                 class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded focus:border-blue-400 focus:outline-none transition" required>
        </div>
        
        <div class="flex justify-between items-center text-sm">
          <div class="flex items-center gap-2">
            <input type="checkbox" id="remember-me" name="remember" class="w-4 h-4 cursor-pointer">
            <label for="remember-me">Remember me</label>
          </div>
          <a href="" class="text-blue-400 hover:underline transition">Forgot password?</a>
        </div>
        
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded font-semibold transition">
          Log In
        </button>
      </form>
      
      <div class="flex items-center my-6">
        <div class="flex-1 border-t border-gray-700"></div>
        <span class="px-3 text-gray-400 text-sm">or continue with</span>
        <div class="flex-1 border-t border-gray-700"></div>
      </div>
      
      <div class="flex gap-3">
        <a href="" class="flex-1 flex justify-center items-center gap-2 py-3 bg-gray-700 hover:bg-gray-600 border border-gray-600 rounded transition">
          <span class="font-bold">G</span> Google
        </a>
        <a href="" class="flex-1 flex justify-center items-center gap-2 py-3 bg-gray-700 hover:bg-gray-600 border border-gray-600 rounded transition">
          <span class="font-bold">f</span> Facebook
        </a>
      </div>
      
      <div class="text-center mt-6 text-gray-400 text-sm">
        Don't have an account? <a href="#" id="to-register" class="text-blue-400 hover:underline transition">Sign up</a>
      </div>
    </div>
    
    <!-- Register Form -->
    <div id="register-form" class="{{ $title == 'userRegister' ? '' : 'hidden' }}">
      <form class="space-y-5" action="/userRegister" method="POST">
        @csrf
        <div>
            <label for="register-username" class="block font-medium mb-1">Username</label>
            <input type="text" id="register-username" name="username" value="{{ old('username') }}" placeholder="ChessMaster42"
                   class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded focus:border-blue-400 focus:outline-none transition" required>
            @error('username') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
    
        <div>
            <label for="register-email" class="block font-medium mb-1">Email</label>
            <input type="email" id="register-email" name="email" value="{{ old('email') }}" placeholder="your@email.com"
                   class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded focus:border-blue-400 focus:outline-none transition" required>
            @error('email') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
    
        <div>
            <label for="register-password" class="block font-medium mb-1">Password</label>
            <input type="password" id="register-password" name="password" placeholder="••••••••"
                   class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded focus:border-blue-400 focus:outline-none transition" required>
            @error('password') <p class="text-red-500">{{ $message }}</p> @enderror
            
        </div>
    
        <div class="flex items-center gap-2 text-sm">
            <input type="checkbox" id="agree-terms" name="terms" class="w-4 h-4 cursor-pointer" required>
            <label for="agree-terms">I agree to the <a href="" class="text-blue-400 hover:underline transition">Terms of Service</a> and <a href="" class="text-blue-400 hover:underline transition">Privacy Policy</a></label>
        </div>
    
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded font-semibold transition">
            Create Account
        </button>
    </form>
    
      
      <div class="flex items-center my-6">
        <div class="flex-1 border-t border-gray-700"></div>
        <span class="px-3 text-gray-400 text-sm">or sign up with</span>
        <div class="flex-1 border-t border-gray-700"></div>
      </div>
      
      <div class="flex gap-3">
        <a href="" class="flex-1 flex justify-center items-center gap-2 py-3 bg-gray-700 hover:bg-gray-600 border border-gray-600 rounded transition">
          <span class="font-bold">G</span> Google
        </a>
        
      </div>
      
      <div class="text-center mt-6 text-gray-400 text-sm">
        Already have an account? <a href="#" id="to-login" class="text-blue-400 hover:underline transition">Log in</a>
      </div>
    </div>
  </div>
</div>
@endsection


    
    
