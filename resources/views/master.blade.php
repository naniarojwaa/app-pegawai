<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    
    <!-- Vite - biar CSS tetap ke-load -->
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    
</head>
<body>
    <!-- Header Sederhana -->
    <header style="background: #0069d9; color: white; padding: 1rem 2rem; margin-bottom: 20px;">
        <h1 style="margin: 0;">App Pegawai</h1>
        <nav>
            <ul style="list-style: none; padding: 0; margin: 10px 0 0 0; display: flex; gap: 20px;">
                <li><a href="{{ url('/employees') }}" style="color: white; text-decoration: none;">Employee</a></li>
                <li><a href="{{ url('/departments') }}" style="color: white; text-decoration: none;">Department</a></li>
                <li><a href="{{ url('/positions') }}" style="color: white; text-decoration: none;">Position</a></li>
                <li><a href="{{ url('/attendance') }}" style="color: white; text-decoration: none;">Attendance</a></li>
                <li><a href="{{ url('/report') }}" style="color: white; text-decoration: none;">Report</a></li>
                <li><a href="{{ url('/settings') }}" style="color: white; text-decoration: none;">Settings</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main style="padding: 0 2rem;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="text-align: center; margin-top: 40px; padding: 20px; color: #666;">
        <p>&copy; 2025 App Pegawai. All rights reserved.</p>
    </footer>
</body>
</html>