<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'App Pegawai')</title>

        @vite(['resources/css/style.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1>@yield('page-title', 'App Pegawai')</h1>
            <nav>
                <ul>
                    <li><a href="{{ url('/employees') }}">Employee</a></li>
                    <li><a href="{{ url('/departments') }}">Department</a></li>
                    <li><a href="{{ url('/attendance') }}">Attendance</a></li>
                    <li><a href="{{ url('/report') }}">Report</a></li>
                    <li><a href="{{ url('/settings') }}">Settings</a></li>
                </ul>
            </nav>
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            <p>&copy; {{ date('Y') }} App Pegawai</p>
        </footer>
    </body>
</html>