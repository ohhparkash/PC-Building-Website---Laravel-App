<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'AshBuilds') · AshBuilds</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="bg-app text-body">
    <!-- Header / Navigation -->
    <header class="border-bottom border-800">
        <nav class="container py-3 d-flex align-items-center justify-content-between flex-wrap gap-3">
            <a class="fw-bold text-gold text-decoration-none" href="{{ route('home') }}">AshBuilds</a>
            <ul class="d-flex list-unstyled m-0 gap-3 align-items-center flex-wrap" style="margin-right: auto !important; margin-left: 2rem !important;">
                <li><a class="nav-link p-0" href="{{ route('home') }}">Home</a></li>
                <li><a class="nav-link p-0" href="{{ route('components.catalog') }}">Components</a></li>
                <li><a class="nav-link p-0" href="{{ route('prebuilt') }}">Pre-Built PCs</a></li>
                <li><a class="nav-link p-0" href="{{ route('builder') }}">PC Builder</a></li>
                <li><a class="nav-link p-0" href="{{ route('checkout') }}">Checkout</a></li>
                @auth
                    @if(auth()->user()->is_admin)
                        <li><a class="nav-link p-0 text-warning" href="{{ route('admin.components.index') }}">Admin</a></li>
                    @endif
                @endauth
            </ul>
            <div class="d-flex align-items-center gap-3">
                @auth
                    <span class="text-white-50 small">Welcome, <span class="text-warning fw-semibold">{{ auth()->user()->name }}</span></span>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
                    </form>
                @else
                    <a class="nav-link p-0" href="{{ route('login') }}">Login</a>
                    <a class="nav-link p-0" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main>
        <!-- Success/Error Notifications -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert" style="position: relative; z-index: 1000;">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert" style="position: relative; z-index: 1000;">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-top: 2px solid #d4af37;">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h5 style="color: #d4af37; font-weight: bold;">AshBuilds</h5>
                    <p class="text-white-50 small">Your trusted partner for custom PC builds in Pakistan. We bring together the best components to create your dream gaming or workstation PC.</p>
                </div>
                <div class="col-md-6 mb-4">
                    <h6 style="color: #d4af37;">Contact Us</h6>
                    <p class="text-white-50 small mb-1">Email: info@ashbuilds.pk</p>
                    <p class="text-white-50 small mb-1">Phone: +92 300 1234567</p>
                    <p class="text-white-50 small">Location: Karachi, Pakistan</p>
                </div>
            </div>
            <div class="text-center pt-3 border-top" style="border-color: #444 !important;">
                <p class="text-white-50 small mb-0">Build Your Dream PC with Confidence</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

