<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootcamp demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Bootcamp</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        @if (auth()->user()->role_id === 1)
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('sekolah.*') ? 'active' : '' }}"
                                    aria-current="page" href="/">Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('guru.*') ? 'active' : '' }}"
                                    href="/guru">Guru</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('siswa.*') ? 'active' : '' }}"
                                    href="/siswa">Siswa</a>
                            </li>
                        @elseif (auth()->user()->role_id === 2)
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('pertemuan.*') ? 'active' : '' }}"
                                    href="/pertemuan">Pertemuan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('kehadiran.*') ? 'active' : '' }}"
                                    href="/kehadiran">Kehadiran</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- Button di pojok kanan -->
                <div class="ms-auto">
                    <form action="logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">logout</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
