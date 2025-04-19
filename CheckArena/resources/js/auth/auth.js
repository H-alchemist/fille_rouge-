
  const loginTab = document.getElementById('login-tab');
  const registerTab = document.getElementById('register-tab');
  const loginForm = document.getElementById('login-form');
  const registerForm = document.getElementById('register-form');

  const toRegisterLink = document.getElementById('to-register');
  const toLoginLink = document.getElementById('to-login');

  function showLogin() {
    loginForm.classList.remove('hidden');
    registerForm.classList.add('hidden');
    loginTab.classList.add('text-blue-400', 'border-b-2', 'border-blue-400');
    loginTab.classList.remove('text-gray-400');
    registerTab.classList.remove('text-blue-400', 'border-b-2', 'border-blue-400');
    registerTab.classList.add('text-gray-400');
  }

  function showRegister() {
    loginForm.classList.add('hidden');
    registerForm.classList.remove('hidden');
    registerTab.classList.add('text-blue-400', 'border-b-2', 'border-blue-400');
    registerTab.classList.remove('text-gray-400');
    loginTab.classList.remove('text-blue-400', 'border-b-2', 'border-blue-400');
    loginTab.classList.add('text-gray-400');
  }

  loginTab.addEventListener('click', showLogin);
  registerTab.addEventListener('click', showRegister);


