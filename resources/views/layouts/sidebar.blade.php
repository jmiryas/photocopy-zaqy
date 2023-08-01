<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">Master Data</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('merks.index') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Merk Kertas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('paper-sizes.index') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Ukuran Kertas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('sale-types.index') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Tipe Penjualan Kertas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('stock-types.index') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Tipe Stok Kertas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('papers.index') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Seluruh Kertas</span>
            </a>
        </li>
    </ul>

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Riwayat Transaksi</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('orders.index') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Pembelian Kertas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('sales.index') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Penjualan Kertas</span>
            </a>
        </li>
    </ul>

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Stok</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('stocks.orders') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Pembelian Kertas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('stocks.sales') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Penjualan Kertas</span>
            </a>
        </li>
    </ul>
</aside>