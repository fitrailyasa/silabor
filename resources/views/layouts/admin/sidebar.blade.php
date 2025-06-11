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

                @can('view-user' || 'view-role' || 'view-ruangan' || 'view-alat' || 'view-bahan' || 'view-category')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
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
                @endcan

                @can('view-transaksi')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>
                                Transaksi
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <x-sidebar-link route="admin.transaksi.index" label="Validasi Peminjaman"
                                can="view-transaksi" />
                            <x-sidebar-link route="admin.transaksi.index" label="Validasi Penggunaan"
                                can="view-transaksi" />
                            <x-sidebar-link route="admin.transaksi.index" label="Validasi Pengembalian"
                                can="view-transaksi" />
                        </ul>
                    </li>
                @endcan

                @can('view-laporan')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Laporan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <x-sidebar-link route="admin.laporan.index" label="Laporan Peminjaman" can="view-laporan" />
                            <x-sidebar-link route="admin.laporan.index" label="Laporan Penggunaan" can="view-laporan" />
                            <x-sidebar-link route="admin.laporan.index" label="Laporan Pengembalian" can="view-laporan" />
                            <x-sidebar-link route="admin.laporan.index" label="Laporan Kerusakan" can="view-laporan" />
                        </ul>
                    </li>
                @endcan

                @can('check-client')
                    <x-sidebar-link route="mahasiswa.check.index" icon="search" label="Cek Alat, Bahan, Ruangan" can="check-client" />
                @endcan

                @can('penggunaan-alat-client')
                    <x-sidebar-link route="mahasiswa.penggunaan-alat" icon="tools" label="Penggunaan Alat" can="penggunaan-alat-client" />
                @endcan

                @can('penggunaan-bahan-client')
                    <x-sidebar-link route="mahasiswa.penggunaan-bahan" icon="box" label="Penggunaan Bahan" can="penggunaan-bahan-client" />
                @endcan

                @can('penggunaan-ruangan-client')
                    <x-sidebar-link route="mahasiswa.penggunaan-ruangan" icon="building" label="Penggunaan Ruangan" can="penggunaan-ruangan-client" />
                @endcan

                @can('history-client')
                    <x-sidebar-link route="mahasiswa.history.index" icon="history" label="Riwayat" can="history-client" />
                @endcan

                <li class="nav-item">
                    <form id="logout-form" action="logout" method="POST" hidden>
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
