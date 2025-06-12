<x-admin-table>

    <!-- Title -->
    <x-slot name="title">
        Riwayat
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
                <th>{{ __('Nama Alat/Ruang') }}</th>
                <th>{{ __('Jenis') }}</th>
                <th>{{ __('Tanggal Peminjaman') }}</th>
                <th>{{ __('Tanggal Pengembalian') }}</th>
                <th>{{ __('Status Peminjaman') }}</th>
                <th>{{ __('Status Pengembalian') }}</th>
                <th>{{ __('Keterangan') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporans as $laporan)
                <tr>
                    <td>{{ $laporans->firstItem() + $loop->index }}</td>
                    <td>{{ $laporan->alat->name ?? ($laporan->bahan->name ?? ($laporan->ruangan->name ?? '-')) }}</td>
                    <td>
                        {{ $laporan->alat->category->name ?? ($laporan->bahan->category->name ?? ($laporan->ruangan->category->name ?? '-')) }}
                    </td>
                    <td>{{ $laporan->tgl_peminjaman ?? '-' }}</td>
                    <td>
                        @if ($laporan->status_peminjaman == 'Diterima')
                            {{ $laporan->tgl_pengembalian }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($laporan->status_peminjaman == 'Diterima')
                            <span class="badge badge-success">Diterima</span>
                        @elseif ($laporan->status_peminjaman == 'Menunggu')
                            <span class="badge badge-warning">Menunggu</span>
                        @elseif ($laporan->status_peminjaman == 'Ditolak')
                            <span class="badge badge-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @if ($laporan->status_peminjaman == 'Diterima')
                            @if ($laporan->status_pengembalian == 'Belum Dikembalikan')
                                <span class="badge badge-warning">Belum dikembalikan</span>
                            @elseif ($laporan->status_pengembalian == 'Sudah Dikembalikan')
                                <span class="badge badge-success">Sudah dikembalikan</span>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($laporan->status_peminjaman == 'Diterima' || $laporan->status_peminjaman == 'Ditolak')
                            {{ $laporan->catatan ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>{{ __('No') }}</th>
                <th>{{ __('Nama Alat/Ruang') }}</th>
                <th>{{ __('Jenis') }}</th>
                <th>{{ __('Tanggal Peminjaman') }}</th>
                <th>{{ __('Tanggal Pengembalian') }}</th>
                <th>{{ __('Status Peminjaman') }}</th>
                <th>{{ __('Status Pengembalian') }}</th>
                <th>{{ __('Keterangan') }}</th>
            </tr>
        </tfoot>
    </table>
    {{ $laporans->appends(['perPage' => $perPage, 'search' => $search])->links() }}

</x-admin-table>
