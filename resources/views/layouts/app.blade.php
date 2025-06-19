<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Portal Informasi Karawang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f2f1, #bbdefb);
            color: #1b4332;
            min-height: 100vh;
            margin: 0;
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
        /* Header styles */
        header {
            background: #ffffffcc;
            backdrop-filter: saturate(180%) blur(20px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-bottom: 1px solid #81c784;
            padding: 1.5rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header a.logo {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2e7d32;
            letter-spacing: -0.02em;
            text-decoration: none;
        }
        header a.logo:hover {
            color: #1b5e20;
        }
        header .auth-links a.login-btn {
            background-color: #2e7d32;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(46,125,50,0.4);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
        }
        header .auth-links a.login-btn:hover {
            background-color: #1b5e20;
            box-shadow: 0 6px 12px rgba(27,94,32,0.6);
        }
        header .auth-links .profile-img {
            width: 48px;
            height: 48px;
            border-radius: 9999px;
            object-fit: cover;
            border: 3px solid #2e7d32;
            box-shadow: 0 2px 8px rgba(46,125,50,0.5);
        }
        header .auth-links .user-name {
            color: #2e7d32;
            font-weight: 600;
            margin-left: 0.75rem;
            font-size: 1.125rem;
        }
        header .auth-links form.logout-form button {
            background: transparent;
            border: 2px solid #e53935;
            color: #e53935;
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        header .auth-links form.logout-form button:hover {
            background-color: #e53935;
            color: white;
        }
        /* Main section */
        section.intro {
            max-width: 72rem;
            margin: 4rem auto 3rem;
            padding: 0 1.5rem;
            text-align: center;
        }
        section.intro h1 {
            font-family: 'Georgia', serif;
            font-size: 3.75rem;
            font-weight: 700;
            color: #1b4332;
            margin-bottom: 1.5rem;
            border-bottom: 4px solid #2e7d32;
            padding-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }
        section.intro p {
            font-size: 1.25rem;
            color: #2f4f4f;
            max-width: 48rem;
            margin: 0 auto;
            line-height: 1.6;
            font-family: 'Poppins', sans-serif;
        }
        /* Search form */
        section.search-form {
            background: white;
            max-width: 28rem;
            margin: 2rem auto 3rem;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(46,125,50,0.15);
        }
        section.search-form form input[type="text"] {
            width: 100%;
            padding: 1rem 1.5rem;
            font-size: 1.125rem;
            border-radius: 9999px;
            border: 2px solid #a5d6a7;
            background-color: #e8f5e9;
            color: #1b4332;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        section.search-form form input[type="text"]::placeholder {
            color: #81c784;
        }
        section.search-form form input[type="text"]:focus {
            outline: none;
            border-color: #2e7d32;
            box-shadow: 0 0 8px #2e7d32aa;
            background-color: #d0f0c0;
        }
        /* Main content */
        main.container {
            max-width: 72rem;
            margin: 0 auto;
            padding: 0 1.5rem 3rem;
            flex-grow: 1;
        }
        /* Footer */
        footer {
            background-color: #dcedc8;
            text-align: center;
            padding: 1.5rem 1rem;
            font-weight: 600;
            color: #33691e;
            border-top: 1px solid #aed581;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <header>
        <div>
            <a href="{{ url('/') }}" class="logo">Portal Informasi Karawang</a>
        </div>
        <div class="auth-links">
            @guest
                <a href="{{ route('login') }}" class="login-btn">Login</a>
            @else
                <a href="{{ route('admin.dashboard') }}" class="text-green-700 font-semibold hover:text-green-900 mr-6">
                    Dashboard Admin
                </a>
                <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" alt="Profile" class="profile-img" />
                <span class="user-name">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="logout-form inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endguest
        </div>
    </header>

    <section class="intro" data-aos="fade-up">
        <h1>Portal Informasi Karawang</h1>
        <p>Temukan berbagai informasi penting, menarik, dan terkini seputar Karawang melalui portal ini.</p>
    </section>

    <section class="search-form" data-aos="fade-up" data-aos-delay="100">
        <form method="GET" action="{{ route('home') }}">
            <input 
                type="text" 
                name="search" 
                placeholder="Cari informasi..." 
                value="{{ request('search') }}" 
                aria-label="Cari informasi"
            />
        </form>
    </section>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Portal Informasi Karawang. All rights reserved.
    </footer>

    <script>
        AOS.init({
            duration: 900,
            easing: 'ease-in-out',
            once: true,
        });
    </script>
</body>
</html>
