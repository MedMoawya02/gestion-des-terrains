<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Reservation')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background-color: #f9f6f1;
            /* fond creamy */
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #fffaf3;
            border-right: 1px solid #eee;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            border-right: 1px solid #eee;
        }

        .sidebar nav {
            flex: 1;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            padding: 20px;
            text-align: center;
            color: #ff7a00;
            /* orange */
            border-bottom: 1px solid #f1e8da;
        }

        .sidebar a {
            color: #333;
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            margin: 5px 10px;
            transition: all 0.2s ease;
        }

        .sidebar a:hover {
            background-color: #fff1dc;
            color: #ff7a00;
        }

        .sidebar a.active {
            background-color: #ffe2bf;
            color: #ff7a00;
            font-weight: 600;
        }

        .content {
            flex: 1;
            padding: 30px;
            background-color: #f9f6f1;
            margin-left: 250px;
        }

        .logout {
            padding: 15px;
            border-top: 1px solid #f1e8da;
        }

        .logout-btn {
            width: 100%;
            background: none;
            border: none;
            padding: 12px;
            border-radius: 8px;
            color: #ff7a00;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background-color: #fdecea;
        }
    </style>

</head>

<body>

    <div class="d-flex">

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <i class="bi bi-1-square-fill"></i><span>H</span>
            </div>

            <!-- Menu -->
            <nav class="mt-3">

                {{-- ================= ADMIN ================= --}}
                @if(auth()->user()->role === 'admin')

                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
                    </a>

                    <a href="{{ route('createTerrain') }}" class="{{ request()->routeIs('createTerrain') ? 'active' : '' }}">
                        <i class="bi bi-map me-2"></i> Terrains
                    </a>

                    <a href="#" class="{{ request()->routeIs('reservations.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check me-2"></i> Réservations
                    </a>

                    <a href="#" class="{{ request()->routeIs('clients.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> Clients
                    </a>

                    {{-- ================= CLIENT ================= --}}
                @else

                    <a href="{{ route('acceuil') }}" class="{{ request()->routeIs('acceuil') ? 'active' : '' }}">
                        <i class="bi bi-house-door me-2"></i> Home
                    </a>

                    <a href="{{ route('propos') }}" class="{{ request()->routeIs('propos') ? 'active' : '' }}">
                        <i class="bi bi-info-circle me-2"></i> À propos
                    </a>

                    <a href="#" class="{{ request()->routeIs('terrains.*') ? 'active' : '' }}">
                        <i class="bi bi-map me-2"></i> Terrains
                    </a>

                    <a href="#" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                        <i class="bi bi-envelope me-2"></i> Contact
                    </a>

                @endif

            </nav>


            <!-- Déconnexion en bas -->
            <div class="logout">
                <form method="POST" action="{{ route('login.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>

    </div>

</body>

</html>