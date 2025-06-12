<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link border-bottom text-center">
        <span class="brand-text font-weight-bold text-white">{{ strtoupper(config('app.name')) }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <x-sidebar-link route="admin.dashboard" icon="tachometer-alt" label="Dashboard" />

                @php
                    $dataMasterRoutes = [
                        'admin.user.index',
                        'admin.role.index',
                        'admin.ruangan.index',
                        'admin.alat.index',
                        'admin.bahan.index',
                        'admin.category.index',
                    ];

                    $dataTransaksiRoutes = [
                        'admin.transaksi.peminjaman',
                        'admin.transaksi.penggunaan',
                        'admin.transaksi.pengembalian',
                    ];

                    $dataLaporanRoutes = ['admin.laporan.index'];

                    $isDataMasterActive = in_array(Route::currentRouteName(), $dataMasterRoutes);
                    $isDataTransaksiActive = in_array(Route::currentRouteName(), $dataTransaksiRoutes);
                    $isDataLaporanActive = in_array(Route::currentRouteName(), $dataLaporanRoutes);
                @endphp

                @if (Auth::user()->can('view-user') ||
                        Auth::user()->can('view-role') ||
                        Auth::user()->can('view-alat') ||
                        Auth::user()->can('view-bahan') ||
                        Auth::user()->can('view-ruangan') ||
                        Auth::user()->can('view-category'))
                    <li class="nav-item has-treeview {{ $isDataMasterActive ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link text-white {{ $isDataMasterActive ? 'active' : '' }}">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <x-sidebar-link route="admin.user.index" label="Data User" can="view-user" />
                            <x-sidebar-link route="admin.role.index" label="Data Role" can="view-role" />
                            <x-sidebar-link route="admin.ruangan.index" label="Data Ruangan" can="view-ruangan" />
                            <x-sidebar-link route="admin.alat.index" label="Data Alat" can="view-alat" />
                            <x-sidebar-link route="admin.bahan.index" label="Data Bahan" can="view-bahan" />
                            <x-sidebar-link route="admin.category.index" label="Data Kategori" can="view-category" />
                        </ul>
                    </li>
                @endif

                @can('view-transaksi')
                    <li class="nav-item has-treeview {{ $isDataTransaksiActive ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link text-white {{ $isDataTransaksiActive ? 'active' : '' }}">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>
                                Transaksi
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <x-sidebar-link route="admin.transaksi.peminjaman" label="Validasi Peminjaman"
                                can="peminjaman-transaksi" />
                            <x-sidebar-link route="admin.transaksi.penggunaan" label="Validasi Penggunaan"
                                can="penggunaan-transaksi" />
                            <x-sidebar-link route="admin.transaksi.pengembalian" label="Validasi Pengembalian"
                                can="pengembalian-transaksi" />
                        </ul>
                    </li>
                @endcan

                @can('view-laporan')
                    <li class="nav-item has-treeview {{ $isDataLaporanActive ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link text-white {{ $isDataLaporanActive ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Laporan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <x-sidebar-link route="admin.laporan.peminjaman" label="Laporan Peminjaman" can="laporan-peminjaman" />
                            <x-sidebar-link route="admin.laporan.penggunaan" label="Laporan Penggunaan" can="laporan-penggunaan" />
                            <x-sidebar-link route="admin.laporan.pengembalian" label="Laporan Pengembalian" can="laporan-peminjaman" />
                        </ul>
                    </li>
                @endcan

                @can('check-client')
                    <x-sidebar-link route="mahasiswa.check.index" icon="search" label="Cek Alat dan Ruangan"
                        can="check-client" />
                @endcan

                @can('pengajuan-peminjaman-client')
                    <x-sidebar-link route="mahasiswa.pengajuan-peminjaman.index" icon="user-friends"
                        label="Pengajuan Peminjaman" can="pengajuan-peminjaman-client" />
                @endcan

                @can('penggunaan-alat-client')
                    <x-sidebar-link route="mahasiswa.penggunaan-alat" icon="tools" label="Penggunaan Alat"
                        can="penggunaan-alat-client" />
                @endcan

                @can('penggunaan-ruangan-client')
                    <x-sidebar-link route="mahasiswa.penggunaan-ruangan" icon="building" label="Penggunaan Ruangan"
                        can="penggunaan-ruangan-client" />
                @endcan

                @can('history-client')
                    <x-sidebar-link route="mahasiswa.history.index" icon="history" label="Riwayat" can="history-client" />
                @endcan

                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                        @csrf
                    </form>
                    <a href="#" class="nav-link text-white"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
