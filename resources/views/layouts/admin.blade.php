<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0fdf4;
            color: #1b4332;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }
        a {
            transition: color 0.3s ease;
        }
        a:hover {
            color: #0d9488;
        }
        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #c8e6c9;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #0d9488;
            border-radius: 10px;
            border: 2px solid #c8e6c9;
        }
        header.navbar {
            background: #e6f4ea;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-bottom: 1px solid #81c784;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }
        header.navbar .title {
            font-weight: 700;
            font-size: 1.5rem;
            color: #2e7d32;
        }
        header.navbar .profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        header.navbar .profile .name {
            font-weight: 600;
            color: #2e7d32;
        }
        header.navbar .profile form button {
            background: transparent;
            border: 2px solid #e53935;
            color: #e53935;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        header.navbar .profile form button:hover {
            background-color: #e53935;
            color: white;
        }
        .container {
            display: flex;
            flex: 1;
            overflow: hidden;
        }
        nav.sidebar {
            width: 250px;
            background: #e6f4ea;
            display: flex;
            flex-direction: column;
            padding: 1rem;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            overflow-y: auto;
            flex-shrink: 0;
        }
        nav.sidebar .title {
            font-weight: 700;
            font-size: 1.5rem;
            color: #2e7d32;
            margin-bottom: 1rem;
        }
        nav.sidebar a {
            display: block;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            color: #2e7d32;
            font-weight: 600;
            border-radius: 0.375rem;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        nav.sidebar a:hover,
        nav.sidebar a.active {
            background-color: #2e7d32;
            color: white;
        }
        nav.sidebar .profile {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid #a5d6a7;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav.sidebar .profile .name {
            font-weight: 600;
            color: #2e7d32;
        }
        nav.sidebar .profile form button {
            background: transparent;
            border: 2px solid #e53935;
            color: #e53935;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        nav.sidebar .profile form button:hover {
            background-color: #e53935;
            color: white;
        }
        main.content {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
            background: white;
            border-left: 1px solid #a5d6a7;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="title">Dashboard Admin Portal Karawang</div>
        <div class="profile">
            <div class="name">{{ Auth::user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>
    <div class="container">
        @include('admin.partials.sidebar')
        <main class="content">
            @if(session('success'))
                <div class="mb-8 p-5 bg-green-100 text-green-900 rounded-lg shadow-md text-center font-semibold text-lg">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
