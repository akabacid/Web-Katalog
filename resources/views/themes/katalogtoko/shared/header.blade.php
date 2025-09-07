<nav class="navbar navbar-expand-lg bg-light fixed-top py-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Sarana<span> Jaya</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="input-group mx-auto mt-5 mt-lg-0" method="GET" action="{{ route('products.index') }}">
                <input type="text" class="form-control" name="q" placeholder="Mau cari apa?" aria-label="Mau cari apa?" aria-describedby="button-addon2">
                <button class="btn btn-outline-warning" type="submit" id="button-addon2"><i class="bx bx-search"></i></button>
            </form>
            <ul class="navbar-nav ms-auto mt-3 mt-sm-0">
                <li class="nav-item me-5">
                    
                </li>
                @guest
                    <li class="nav-item mt-5 mt-lg-0 text-center">
                        <a class="btn btn-second me-lg-3" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <li class="nav-item mt-5 mt-lg-0 text-center">
                        <a class="btn btn-second" href="{{ url('/admin/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item mt-5 mt-lg-0 text-center ms-0 ms-lg-3">
                        <form method="POST" action="{{ route('logout') }}"class="d-flex justify-content-center">
                            @csrf
                            <button type="submit" class="nav-link btn-first">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>