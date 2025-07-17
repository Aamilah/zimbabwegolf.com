<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Zimbabwe Golf Association</title>
    {{-- Favicon icon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">

    <!-- Font Awesome Icon Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Main Style Link -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<nav x-data="{ open:false }" class="navbar">
  <!-- Logo -->
  <div class="logo">
    <img src="{{ asset('images/logo/zga_logo_nobg.png') }}" alt="ZGA Logo" class="logo-img" style="height: 60px;" />
  </div>

  <!-- Hamburger Button (mobile) -->
  <button @click="open = !open" class="md:hidden text-black text-2xl focus:outline-none">
    <i class="fas fa-bars" x-show="!open" x-cloak></i>
    <i class="fas fa-xmark" x-show="open" x-cloak></i>
  </button>



  <!-- Nav Links -->
<div
  class="nav-links hidden md:flex flex-col md:flex-row gap-4 absolute top-full left-0 w-full justify-center items-center p-1 md:static md:w-auto md:p-0 md:shadow-none md:rounded-none shadow-md"
  :class="{ 'flex bg-[color:var(--green)]': open, 'hidden': !open }">
  <a href="{{ route('home') }}" class="nav-link-btn {{ Route::is('home') ? 'active' : '' }}">Home</a>
  <a href="{{ route('about') }}" class="nav-link-btn {{ Route::is('about') ? 'active' : '' }}">About</a>
  <a href="{{ url(path: '/tournaments') }}" class="nav-link-btn {{ Route::is('tournaments') ? 'active' : '' }}">Tournaments</a>
  <a href="{{ route('players') }}" class="nav-link-btn {{ Route::is('players') ? 'active' : '' }}">Players</a>
  <a href="{{ route('blog') }}" class="nav-link-btn {{ Route::is('blog') ? 'active' : '' }}">Blog</a>
</div>


  <!-- Contact Button -->
  <div class="contact-nav-link hidden md:block">
    <a href="{{ route('contact') }}" class=" contact-btn {{ Route::is('contact') ? 'active' : '' }}">Contact Us</a>
  </div>
</nav>


    <main class="container">
        {{ $slot }}
    </main>

    <footer>
      <div class="flag-container">
        <div class="footer-overlay-text">
          <div class="grid grid-flow-col grid-rows-2 gap-4">
            <div class="col-span-3">
              <h2>Stay Updated By<br><span>Following Our Socials</span></h2>
            </div>
            <div class="col-span-3">
              <div class="social-input-group">
                <div class="social-icons">
                  <i class="fab fa-facebook-f"></i>
                  <i class="fab fa-instagram"></i>
                </div>
                <input type="email" placeholder="you@example.com" />
                <button type="submit" class="footer-btn">Submit</button>
              </div>
            </div>
            <div class="row-span-2">
              <div class="resources">
                <h5>Resources</h5>
                <ul>
                  <li><a href="{{ route('home') }}"><i class="fas fa-arrow-up-right-from-square"></i> Home </a></li>
                  <li><a href="{{ route('players') }}"><i class="fas fa-arrow-up-right-from-square"></i> Players</a></li>
                  <li><a href="{{ route('tournaments') }}"><i class="fas fa-arrow-up-right-from-square"></i> Tournament Calendar</a></li>
                  <li><a href="{{ route('about') }}"><i class="fas fa-arrow-up-right-from-square"></i> About Us</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-bottom-bar">
            <p>&copy; 2025. All Rights Reserved</p>
            <p>
              Designed by <span class="text-red-500 font-semibold">Samaita Media</span>
            </p>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>