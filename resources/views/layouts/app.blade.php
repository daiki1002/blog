<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <h1 class="h5 mb-0">Blog</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('post.create') }}" class="nav-link text-dark"><i class="fa-solid fa-square-plus text-dark"></i> Post</a>
                    </li>
                    <li class="nav-item dropdown ms-3">
                        <button class="btn shadow-none nav-link text-dark" id="account-dropdown" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-caret-down"></i> {{ Auth::user()->name }}
                        </button>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                            <a href="{{ route('password.edit') }}" class="dropdown-item text-decoration-none text-dark">
                                <i class="fa-solid fa-user-gear"></i> Password
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="dropdown-item m-0">
                                @csrf

                                <button class="btn shadow-none text-dark p-0"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div>
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</body>
</html>
