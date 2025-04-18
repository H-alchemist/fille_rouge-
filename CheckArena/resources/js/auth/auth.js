export function initAuth() {
  console.log('Auth script loaded!'); 


const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const toRegister = document.getElementById('to-register');
const toLogin = document.getElementById('to-login');

toRegister.addEventListener('click', function () {
   console.log('none');
   loginForm.classList.remove('hidden');
   registerForm.classList.add('hidden');
});
toLogin.addEventListener('click',  function () {
  registerForm.classList.remove('hidden');
  loginForm.classList.add('hidden');
});
}
