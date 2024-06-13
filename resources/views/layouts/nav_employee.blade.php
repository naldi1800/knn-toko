<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TOKO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @php
                    $rute = request()->route()->uri();
                    $rute = explode("/", $rute);
                @endphp
                <x-main.nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-main.nav-link>
                <x-main.nav-link :href="route('items')" :active="(request()->routeIs('items') || in_array('item', $rute))">
                    {{ __('Barang') }}
                </x-main.nav-link>
                <x-main.nav-link :href="route('employees')" :active="(request()->routeIs('employees') || in_array('employees', $rute))">
                    {{ __('Pegawai') }}
                </x-main.nav-link>
            </ul>
            <form method="POST" class="d-flex" action="{{ route('logout') }}">
                @csrf
                @metode('post')
                <button class="btn btn-outline-secondary" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</nav>