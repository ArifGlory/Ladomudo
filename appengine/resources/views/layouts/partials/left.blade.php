<ul id="js-nav-menu" class="nav-menu">
    <li class="{{ Nav::isRoute('dashboard', 'active') }}">
        <a href="{{ route('dashboard') }}" title="Dashboard" data-filter-tags="dashboard">
                <i class="fal fa-cube text-white"></i>
                <span class="nav-link-text" data-i18n="nav.dashboard">Dashboard</span>
        </a>
    </li>
    @if(Auth::user()->jenis_user == "admin")
        <li class="nav-title text-black-50">Data Master</li>
        <li class="{{ Nav::isRoute('pegawai', 'active') }}">
            <a href="{{ url('/pegawai') }}" title="Pegawai" data-filter-tags="pegawai">
                <i class="fal fa-list text-white"></i>
                <span class="nav-link-text text-white" data-i18n="nav.pegawai">Kategori</span>
            </a>
        </li>
        <li class="{{ Nav::isRoute('pegawai', 'active') }}">
            <a href="{{ url('/pegawai') }}" title="Pegawai" data-filter-tags="pegawai">
                <i class="fal fa-shopping-cart text-white"></i>
                <span class="nav-link-text text-white" data-i18n="nav.pegawai">Produk</span>
            </a>
        </li>
        <li class="{{ Nav::isRoute('jadwal', 'active') }}">
            <a href="{{ url('/jadwal') }}" title="Jadwal Dinas" data-filter-tags="Jadwal Dinas">
                <i class="fal fa-truck text-white"></i>
                <span class="nav-link-text text-white" data-i18n="nav.jadwal">Supplier</span>
            </a>
        </li>
    @endif
    <li class="nav-title text-black-50">Others</li>
    <li class="{{ Nav::isResource('setting', NULL, 'active') }}">
        <a href="{{ route('setting.index') }}" title="Setting" data-filter-tags="setting">
            <i class="fal fa-money-bill text-white"></i>
            <span class="nav-link-text text-white" data-i18n="nav.setting">Transaksi</span>
        </a>
    </li>
    <li class="{{ Nav::isResource('setting', NULL, 'active') }}">
        <a href="{{ route('setting.index') }}" title="Setting" data-filter-tags="setting">
            <i class="fal fa-cog text-white"></i>
            <span class="nav-link-text text-white" data-i18n="nav.setting">Setting</span>
        </a>
    </li>
</ul>
