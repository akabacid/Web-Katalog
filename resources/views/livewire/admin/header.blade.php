<header class="navbar navbar-expand-md d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
        </button>
        <div class="navbar-nav flex-row order-md-last ms-auto">
            <div class="d-none d-md-flex">
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
                    data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <div class=" ps-2">
                        <div>{{ auth()->user()->email }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="min-width: 220px;">
                    <form method="POST" action="{{ route('admin.update.whatsapp') }}" class="px-3 py-2">
                        @csrf
                        <div class="mb-2">
                            <span>Nomor WhatsApp</span>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', auth()->user()->whatsapp_number ? ltrim(auth()->user()->whatsapp_number, '+62') : '') }}" class="form-control" placeholder="81234567890" aria-label="WhatsApp Number">
                            </div>
                        </div>
                        <button type="submit" class="btn w-100 mb-2" style="background-color:#198754; color:#fff;">Save</button>
                    </form>
                    <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                        @csrf
                        <div class="mb-2">
                            <button type="submit" class="btn w-100 mb-2" style="background-color:#ff0000; color:#fff;">Logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>