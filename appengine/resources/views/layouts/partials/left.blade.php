<ul id="js-nav-menu" class="nav-menu">
    <li class="{{ Nav::isRoute('dashboard', 'active') }}">
        <a href="{{ route('dashboard') }}" title="Dashboard" data-filter-tags="dashboard">
                <i class="fal fa-cube text-white"></i>
                <span class="nav-link-text text-white" data-i18n="nav.dashboard">Dashboard</span>
        </a>
    </li>
    @if(Auth::user()->jenis_user == "admin")
        <li class="nav-title text-black-50">Data Master</li>
        <li class="{{ Nav::isRoute('kategori', 'active') }}">
            <a href="{{ url('/kategori') }}" title="Kategori" data-filter-tags="kategori">
                <i class="fal fa-list text-white"></i>
                <span class="nav-link-text text-white" data-i18n="nav.kategori">Kategori</span>
            </a>
        </li>
        <li class="{{ Nav::isRoute('produk', 'active') }}">
            <a href="{{ url('/produk') }}" title="Produk" data-filter-tags="produk">
                <i class="fal fa-shopping-cart text-white"></i>
                <span class="nav-link-text text-white" data-i18n="nav.produk">Produk</span>
            </a>
        </li>
        <li class="{{ Nav::isRoute('supplier', 'active') }}">
            <a href="{{ url('/supplier') }}" title="Supplier" data-filter-tags="Jadwal Dinas">
                <i class="fal fa-truck text-white"></i>
                <span class="nav-link-text text-white" data-i18n="nav.supplier">Supplier</span>
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
