import './bootstrap';


import { initAuth } from './auth/auth.js';

// Optionally call it here if you want to ensure it runs
document.addEventListener('DOMContentLoaded', () => {
  initAuth();
});