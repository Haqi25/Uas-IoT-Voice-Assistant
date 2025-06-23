<!DOCTYPE html>
<html lang="en" class="scroll-smooth" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AI Voice Assistant Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom scrollbar for dashboard */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #1e293b;
    }
    ::-webkit-scrollbar-thumb {
      background-color: #6366f1;
      border-radius: 10px;
    }
    /* Smooth transitions for buttons and hover states */
    .transition-smooth {
      transition: all 0.3s ease;
    }
  </style>
</head>
<body class="bg-gradient-to-tr from-indigo-900 via-purple-900 to-gray-800 min-h-screen text-white font-inter selection:bg-indigo-500 selection:text-white">

  <!-- Header / Navigation -->
  <header class="sticky top-0 bg-indigo-950/90 backdrop-blur-md z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">
      <a href="#" class="text-2xl font-extrabold tracking-tight bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">VoiceAI</a>
      <nav class="hidden md:flex space-x-8 font-semibold text-indigo-300">
        <a href="#" class="hover:text-white transition-smooth" aria-current="page">Home</a>
        <a href="#features" class="hover:text-white transition-smooth">Features</a>
        <a href="#about" class="hover:text-white transition-smooth">About</a>
        <a href="#contact" class="hover:text-white transition-smooth">Contact</a>
      </nav>
      <div class="space-x-4">
        <button id="loginBtn" class="bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 px-4 py-2 rounded-lg text-sm font-semibold transition-smooth">Login</button>
        <button id="registerBtn" class="bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400 px-4 py-2 rounded-lg text-sm font-semibold transition-smooth">Register</button>
      </div>
      <!-- Mobile menu button -->
      <button id="mobileMenuBtn" aria-label="Toggle Navigation Menu" class="md:hidden text-indigo-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-400 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>
    <!-- Mobile navigation -->
    <nav id="mobileNav" class="md:hidden bg-indigo-950/95 backdrop-blur-md hidden divide-y divide-indigo-900">
      <a href="#" class="block px-6 py-3 text-indigo-300 hover:text-white font-semibold">Home</a>
      <a href="#features" class="block px-6 py-3 text-indigo-300 hover:text-white font-semibold">Features</a>
      <a href="#about" class="block px-6 py-3 text-indigo-300 hover:text-white font-semibold">About</a>
      <a href="#contact" class="block px-6 py-3 text-indigo-300 hover:text-white font-semibold">Contact</a>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="text-center pt-20 sm:pt-32 pb-16 max-w-5xl mx-auto px-6">
    <h1 class="text-5xl sm:text-6xl font-extrabold leading-tight tracking-tight bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent drop-shadow-lg">
      Next-Gen AI Voice Assistant Dashboard
    </h1>
    <p class="mt-6 text-lg sm:text-xl max-w-3xl mx-auto text-indigo-200">
      Control your intelligent voice assistant, personalize commands, and monitor your interactions all in one sleek, responsive dashboard.
    </p>
    <div class="mt-10 flex justify-center space-x-6">
      <button id="loginBtnHero" class="bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-2xl font-semibold text-white transition-smooth drop-shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
        Login
      </button>
      <button id="registerBtnHero" class="bg-purple-600 hover:bg-purple-700 px-6 py-3 rounded-2xl font-semibold text-white transition-smooth drop-shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-400">
        Register
      </button>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="max-w-7xl mx-auto px-6 py-12 md:py-24">
    <h2 class="text-center text-4xl font-extrabold text-indigo-300 mb-16">Features</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
      <div class="bg-indigo-900 bg-opacity-50 rounded-2xl p-8 shadow-lg hover:shadow-indigo-700 transition-smooth flex flex-col items-center text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-400 mb-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/>
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.34 6.424c-.344 2.253-2.707 4.06-6 4.598v-7.6z"/>
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 14L5.84 10.578a12.083 12.083 0 00-.34 6.424c.344 2.253 2.707 4.06 6 4.598v-7.6z"/>
        </svg>
        <h3 class="text-xl font-semibold mb-3">Voice Command Customization</h3>
        <p class="text-indigo-300">Create, edit and manage your voice commands with ease to make your assistant truly personalized.</p>
      </div>
      <div class="bg-indigo-900 bg-opacity-50 rounded-2xl p-8 shadow-lg hover:shadow-indigo-700 transition-smooth flex flex-col items-center text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-400 mb-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3v2.25M14.25 3v2.25M6.75 9h10.5M12 11.25v8.25m0 0l-3-3m3 3l3-3"/>
        </svg>
        <h3 class="text-xl font-semibold mb-3">Real-Time Interaction Logs</h3>
        <p class="text-indigo-300">Review your assistant's latest interactions and perfect responses for a smoother experience.</p>
      </div>
      <div class="bg-indigo-900 bg-opacity-50 rounded-2xl p-8 shadow-lg hover:shadow-indigo-700 transition-smooth flex flex-col items-center text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-400 mb-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 14v7m0 0a2.828 2.828 0 01-2-2 3 3 0 015 0 2.828 2.828 0 01-3 2zm0-14v4m0-4c-4 0-7 3-7 7 0 4.418 3.134 7 7 7m0 0c4 0 7-3 7-7 0-4.418-3-7-7-7z"/>
        </svg>
        <h3 class="text-xl font-semibold mb-3">Secure Profile Management</h3>
        <p class="text-indigo-300">Easily manage your user profile with strong security protocols and personalized settings.</p>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="bg-indigo-900 bg-opacity-40 backdrop-blur-xl rounded-3xl max-w-5xl mx-auto px-8 py-14 mb-24">
    <h2 class="text-center text-4xl font-extrabold text-indigo-300 mb-8">About VoiceAI</h2>
    <p class="max-w-3xl mx-auto text-indigo-200 text-lg leading-relaxed text-center">
      VoiceAI empowers users to engage intuitively with their digital environments via natural language.  Our platform is driven by cutting-edge AI technology, providing seamless integration, personalized interactions, and enhanced productivity.
    </p>
  </section>

  <!-- Footer -->
  <footer class="bg-indigo-950/90 backdrop-blur-md text-indigo-400 py-10 border-t border-indigo-700">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0">
      <div class="text-center md:text-left text-sm">&copy; 2024 VoiceAI. All rights reserved.</div>
      <div class="flex space-x-6 text-sm">
        <a href="#privacy" class="hover:text-indigo-100 transition-smooth">Privacy Policy</a>
        <a href="#terms" class="hover:text-indigo-100 transition-smooth">Terms of Service</a>
        <a href="#contact" class="hover:text-indigo-100 transition-smooth">Contact</a>
      </div>
    </div>
  </footer>

  <!-- Login Modal -->
  <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-70 hidden justify-center items-center z-50 p-6">
    <div class="bg-indigo-800 rounded-xl max-w-md w-full p-8 shadow-lg relative">
      <button id="closeLogin" aria-label="Close login modal" class="absolute top-4 right-4 text-indigo-300 hover:text-white focus:outline-none text-2xl font-bold">&times;</button>
      <h3 class="text-2xl font-bold mb-6 text-indigo-200 text-center">Login to VoiceAI</h3>
      <form>
        <label for="loginEmail" class="block mb-1 text-indigo-300 font-semibold">Email address</label>
        <input id="loginEmail" type="email" required autocomplete="email" class="w-full p-3 rounded-lg bg-indigo-900 border border-indigo-700 text-white focus:ring-2 focus:ring-indigo-500 mb-6" />
        <label for="loginPassword" class="block mb-1 text-indigo-300 font-semibold">Password</label>
        <input id="loginPassword" type="password" required autocomplete="current-password" class="w-full p-3 rounded-lg bg-indigo-900 border border-indigo-700 text-white focus:ring-2 focus:ring-indigo-500 mb-6" />
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition-smooth">Login</button>
      </form>
    </div>
  </div>

  <!-- Register Modal -->
  <div id="registerModal" class="fixed inset-0 bg-black bg-opacity-70 hidden justify-center items-center z-50 p-6">
    <div class="bg-purple-900 rounded-xl max-w-md w-full p-8 shadow-lg relative">
      <button id="closeRegister" aria-label="Close register modal" class="absolute top-4 right-4 text-purple-300 hover:text-white focus:outline-none text-2xl font-bold">&times;</button>
      <h3 class="text-2xl font-bold mb-6 text-purple-200 text-center">Register for VoiceAI</h3>
      <form>
        <label for="registerName" class="block mb-1 text-purple-300 font-semibold">Full Name</label>
        <input id="registerName" type="text" required autocomplete="name" class="w-full p-3 rounded-lg bg-purple-900 border border-purple-700 text-white focus:ring-2 focus:ring-purple-500 mb-4" />
        <label for="registerEmail" class="block mb-1 text-purple-300 font-semibold">Email address</label>
        <input id="registerEmail" type="email" required autocomplete="email" class="w-full p-3 rounded-lg bg-purple-900 border border-purple-700 text-white focus:ring-2 focus:ring-purple-500 mb-4" />
        <label for="registerPassword" class="block mb-1 text-purple-300 font-semibold">Password</label>
        <input id="registerPassword" type="password" required autocomplete="new-password" class="w-full p-3 rounded-lg bg-purple-900 border border-purple-700 text-white focus:ring-2 focus:ring-purple-500 mb-6" />
        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-lg transition-smooth">Register</button>
      </form>
    </div>
  </div>

  <script>
    // DOM elements
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const loginBtnHero = document.getElementById('loginBtnHero');
    const registerBtnHero = document.getElementById('registerBtnHero');

    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');

    const closeLogin = document.getElementById('closeLogin');
    const closeRegister = document.getElementById('closeRegister');

    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileNav = document.getElementById('mobileNav');

    // Toggle mobile navigation menu
    mobileMenuBtn.addEventListener('click', () => {
      mobileNav.classList.toggle('hidden');
    });

    // Open login modal
    function openLogin() {
      loginModal.classList.remove('hidden');
      registerModal.classList.add('hidden');
      document.body.style.overflow = 'hidden';
      document.getElementById('loginEmail').focus();
    }
    // Open register modal
    function openRegister() {
      registerModal.classList.remove('hidden');
      loginModal.classList.add('hidden');
      document.body.style.overflow = 'hidden';
      document.getElementById('registerName').focus();
    }
    // Close modals
    function closeModals() {
      loginModal.classList.add('hidden');
      registerModal.classList.add('hidden');
      document.body.style.overflow = '';
    }

    // Event listeners for buttons
    loginBtn.addEventListener('click', openLogin);
    registerBtn.addEventListener('click', openRegister);
    loginBtnHero.addEventListener('click', openLogin);
    registerBtnHero.addEventListener('click', openRegister);

    closeLogin.addEventListener('click', closeModals);
    closeRegister.addEventListener('click', closeModals);

    // Close modals on click outside modal content
    loginModal.addEventListener('click', e => {
      if (e.target === loginModal) closeModals();
    });
    registerModal.addEventListener('click', e => {
      if (e.target === registerModal) closeModals();
    });

    // Close modals on Escape key
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') closeModals();
    });
  </script>
</body>
</html>

