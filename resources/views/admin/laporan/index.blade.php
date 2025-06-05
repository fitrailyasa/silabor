<x-admin-table>

    <!-- Title -->
    <x-slot name="title">
        Laporan
    </x-slot>

    <!-- Search & Pagination -->
    <x-slot name="search">
        @include('components.search')
    </x-slot>

    <!-- Table -->
    <table id="" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ __('No') }}</th>
                <th>{{ __('Nama Pemesan') }}</th>
                <th>{{ __('Jenis') }}</th>
                <th>{{ __('Nama Ruang/Alat/Bahan') }}</th>
                <th>{{ __('Tanggal Peminjaman') }}</th>
                <th>{{ __('Tanggal Pengembalian') }}</th>
                <th>{{ __('Status Pengembalian') }}</th>
                <th class="text-center">{{ __('Aksi') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporans as $laporan)
                <tr>
                    <td>{{ $laporans->firstItem() + $loop->index }}</td>
                    <td>
                        <a href="https://wa.me/+62{{ $laporan->user->no_hp ?? '-' }}"><span>{{ $laporan->user->name ?? '-' }}</span> <i class="fa fa-whatsapp text-success"></i></a>
                    </td>
                    <td>
                        {{ $laporan->alat->category->name ?? ($laporan->bahan->category->name ?? ($laporan->ruangan->category->name ?? '-')) }}
                    </td>
                    <td>{{ $laporan->alat->name ?? ($laporan->bahan->name ?? ($laporan->ruangan->name ?? '-')) }}</td>
                    <td>{{ $laporan->tgl_peminjaman ?? '-' }}</td>
                    <td>{{ $laporan->tgl_pengembalian ?? '-' }}</td>
                    <td>
                        @if ($laporan->status_pengembalian == 'Belum Dikembalikan')
                            <span class="badge badge-warning">Belum dikembalikan</span>
                        @elseif ($laporan->status_pengembalian == 'Sudah Dikembalikan')
                            <span class="badge badge-success">Sudah dikembalikan</span>
                        @endif
                    </td>
                    <td class="manage-row text-center">
                        @can('view-laporan')
                            @include('admin.laporan.detail')
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>{{ __('No') }}</th>
                <th>{{ __('Nama Pemesan') }}</th>
                <th>{{ __('Jenis') }}</th>
                <th>{{ __('Nama Ruang/Alat/Bahan') }}</th>
                <th>{{ __('Tanggal Peminjaman') }}</th>
                <th>{{ __('Tanggal Pengembalian') }}</th>
                <th>{{ __('Status Pengembalian') }}</th>
                <th class="text-center">{{ __('Aksi') }}</th>
            </tr>
        </tfoot>
    </table>
    {{ $laporans->appends(['perPage' => $perPage, 'search' => $search])->links() }}

</x-admin-table>
