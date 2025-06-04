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
                <x-sidebar-link route="{{ route('admin.dashboard') }}" icon="tachometer-alt" label="Dashboard" />
                <x-sidebar-link route="{{ route('admin.user.index') }}" icon="users" label="User" can="view-user" />
                <x-sidebar-link route="{{ route('admin.role.index') }}" icon="key" label="Role" can="view-role" />
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link text-white">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <x-sidebar-link route="#" icon="" label="Validasi Peminjaman" can="view-user" />
                        <x-sidebar-link route="#" icon="" label="Validasi Penggunaan" can="view-user" />
                        <x-sidebar-link route="#" icon="" label="Validasi Pengembalian" can="view-user" />
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link text-white">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <x-sidebar-link route="#" icon="" label="Laporan Peminjaman" can="view-user" />
                        <x-sidebar-link route="#" icon="" label="Laporan Penggunaan" can="view-user" />
                        <x-sidebar-link route="#" icon="" label="Laporan Pengembalian" can="view-user" />
                        <x-sidebar-link route="#" icon="" label="Laporan Kerusakan" can="view-user" />
                    </ul>
                </li>

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
