<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Zimbabwe Golf Association | Admin</title>
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

    <!-- Alpine.js for sidebar toggle -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-[color:var(--green)]" x-data="{ sidebarOpen: false }">

    <x-loading-overlay />

    <!-- Mobile top bar for sidebar toggle -->
    <div class="md:hidden flex items-center justify-between p-4 bg-white shadow">
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 focus:outline-none">
            <i class="fas fa-bars fa-lg"></i>
        </button>
        <span class="font-semibold text-sm">Zimbabwe Golf Association</span>
    </div>

    <!-- Sidebar -->
    <aside
        class="fixed top-0 left-0 h-screen w-64 flex flex-col z-40 bg-[color:var(--green)] transition-transform transform md:translate-x-0"
        :class="{ '-translate-x-full': !sidebarOpen }">

        <div class="h-16 flex items-center justify-start px-4 bg-white rounded-2xl m-4">
            <img src="{{ asset('images/logo/zga_logo.jpg') }}" alt="ZGA Logo" class="h-12" />
            <span class="font-semibold text-sm ml-2">Zimbabwe Golf Association</span>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('admin.player-dashboard') }}"
                class="admin-nav-link {{ Route::is('admin.player-dashboard') ? 'active' : '' }}">
                <i class="fas fa-home w-5 mr-3"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.player-tournaments.index') }}"
                class="admin-nav-link {{ Route::is('admin.player-tournaments.index') ? 'active' : '' }}"
                @click="sidebarOpen = false">
                <i class="fas fa-calendar w-5 mr-3"></i>
                Tournaments
            </a>
            <a href="{{ route('admin.my-tournaments.index') }}"
                class="admin-nav-link {{ Route::is('admin.my-tournaments.index') ? 'active' : '' }}"
                @click="sidebarOpen = false">
                <i class="fas fa-bullseye w-5 mr-3"></i>
                My Tournaments
            </a>

            <a href="{{ route('admin.leaderboard.index') }}"
                class="admin-nav-link {{ Route::is('admin.leaderboard.index') ? 'active' : '' }}"
                @click="sidebarOpen = false">
                <i class="fas fa-ranking-star w-5 mr-3"></i>
                Leaderboard
            </a>
        </nav>

        <div class="px-4 py-6">
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="admin-nav-link logout w-full">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="admin-nav-link logout w-full">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
            @endauth
        </div>
    </aside>

    <!-- Page Content -->
    <main class="md:pl-[270px] p-10 overflow-y-auto transition-all">
        <div class="bg-white shadow-lg p-3 rounded-2xl overflow-y-auto">
            <header class="h-14 flex items-center justify-between px-4">
                <div class="text-lg font-semibold text-gray-700">
                    {{ $title ?? 'Dashboard' }}
                </div>
                <div class="flex items-center space-x-4">
                    @include('layouts.navigation')
                </div>
            </header>

            {{ $slot }}
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</body>
</html>
