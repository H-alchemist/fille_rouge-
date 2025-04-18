@extends('layouts.app')

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
    <div id="login-form">
      <form class="space-y-5" action="{{ route('login') }}" method="POST">
        @csrf
        <div>
          <label for="login-email" class="block font-medium mb-1">Email</label>
          <input type="email" id="login-email" name="email" placeholder="your@email.com" 
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
          <a href="{{ route('password.request') }}" class="text-blue-400 hover:underline transition">Forgot password?</a>
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
        <a href="{{ route('social.login', 'google') }}" class="flex-1 flex justify-center items-center gap-2 py-3 bg-gray-700 hover:bg-gray-600 border border-gray-600 rounded transition">
          <span class="font-bold">G</span> Google
        </a>
        <a href="{{ route('social.login', 'facebook') }}" class="flex-1 flex justify-center items-center gap-2 py-3 bg-gray-700 hover:bg-gray-600 border border-gray-600 rounded transition">
          <span class="font-bold">f</span> Facebook
        </a>
      </div>
      
      <div class="text-center mt-6 text-gray-400 text-sm">
        Don't have an account? <a href="#" id="to-register" class="text-blue-400 hover:underline transition">Sign up</a>
      </div>
    </div>
    
    <!-- Register Form -->
    <div id="register-form" class="hidden">
      <form class="space-y-5" action="{{ route('register') }}" method="POST">
        @csrf
        <div>
          <label for="register-username" class="block font-medium mb-1">Username</label>
          <input type="text" id="register-username" name="username" placeholder="ChessMaster42" 
                 class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded focus:border-blue-400 focus:outline-none transition" required>
        </div>
        
        <div>
          <label for="register-email" class="block font-medium mb-1">Email</label>
          <input type="email" id="register-email" name="email" placeholder="your@email.com" 
                 class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded focus:border-blue-400 focus:outline-none transition" required>
        </div>
        
        <div>
          <label for="register-password" class="block font-medium mb-1">Password</label>
          <input type="password" id="register-password" name="password" placeholder="••••••••" 
                 class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded focus:border-blue-400 focus:outline-none transition" required>
          <p class="text-red-500 text-sm mt-1">Password must be at least 8 characters</p>
        </div>
        
        <div>
          <label for="register-confirm" class="block font-medium mb-1">Confirm Password</label>
          <input type="password" id="register-confirm" name="password_confirmation" placeholder="••••••••" 
                 class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded focus:border-blue-400 focus:outline-none transition" required>
        </div>
        
        <div class="flex items-center gap-2 text-sm">
          <input type="checkbox" id="agree-terms" name="terms" class="w-4 h-4 cursor-pointer" required>
          <label for="agree-terms">I agree to the <a href="{{ route('terms') }}" class="text-blue-400 hover:underline transition">Terms of Service</a> and <a href="{{ route('privacy') }}" class="text-blue-400 hover:underline transition">Privacy Policy</a></label>
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
        <a href="{{ route('social.login', 'google') }}" class="flex-1 flex justify-center items-center gap-2 py-3 bg-gray-700 hover:bg-gray-600 border border-gray-600 rounded transition">
          <span class="font-bold">G</span> Google
        </a>
        <a href="{{ route('social.login', 'facebook') }}" class="flex-1 flex justify-center items-center gap-2 py-3 bg-gray-700 hover:bg-gray-600 border border-gray-600 rounded transition">
          <span class="font-bold">f</span> Facebook
        </a>
      </div>
      
      <div class="text-center mt-6 text-gray-400 text-sm">
        Already have an account? <a href="#" id="to-login" class="text-blue-400 hover:underline transition">Log in</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const loginTab = document.getElementById('login-tab');
    const registerTab = document.getElementById('register-tab');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const toRegister = document.getElementById('to-register');
    const toLogin = document.getElementById('to-login');
    
    function switchToLogin() {
      loginTab.classList.add('text-blue-400', 'border-b-2', 'border-blue-400');
      loginTab.classList.remove('text-gray-400');
      registerTab.classList.add('text-gray-400');
      registerTab.classList.remove('text-blue-400', 'border-b-2', 'border-blue-400');
      loginForm.classList.remove('hidden');
      registerForm.classList.add('hidden');
    }
    
    function switchToRegister() {
      registerTab.classList.add('text-blue-400', 'border-b-2', 'border-blue-400');
      registerTab.classList.remove('text-gray-400');
      loginTab.classList.add('text-gray-400');
      loginTab.classList.remove('text-blue-400', 'border-b-2', 'border-blue-400');
      registerForm.classList.remove('hidden');
      loginForm.classList.add('hidden');
    }
    
    loginTab.addEventListener('click', switchToLogin);
    registerTab.addEventListener('click', switchToRegister);
    toRegister.addEventListener('click', function(e) {
      e.preventDefault();
      switchToRegister();
    });
    toLogin.addEventListener('click', function(e) {
      e.preventDefault();
      switchToLogin();
    });
    
    const registerFormElement = document.querySelector('#register-form form');
    if (registerFormElement) {
      registerFormElement.addEventListener('submit', function(e) {
        const password = document.getElementById('register-password');
        const confirm = document.getElementById('register-confirm');
        
        if (password.value.length < 8) {
          password.classList.add('border-red-500');
          password.classList.remove('border-gray-700', 'focus:border-blue-400');
          e.preventDefault();
        } else {
          password.classList.remove('border-red-500');
          password.classList.add('border-gray-700', 'focus:border-blue-400');
        }
        
        if (password.value !== confirm.value) {
          confirm.classList.add('border-red-500');
          confirm.classList.remove('border-gray-700', 'focus:border-blue-400');
          alert('Passwords do not match');
          e.preventDefault();
        } else {
          confirm.classList.remove('border-red-500');
          confirm.classList.add('border-gray-700', 'focus:border-blue-400');
        }
      });
    }
  });
</script>
@endsection