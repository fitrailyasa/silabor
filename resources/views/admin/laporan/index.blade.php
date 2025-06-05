<x-admin-table>

    <!-- Title -->
    <x-slot name="title">
        Laporan
    </x-slot>

    <!-- Button Form Create -->
    <x-slot name="formCreate">
        @can('create-laporan')
            @include('admin.laporan.create')
        @endcan
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
                    <td>{{ $laporan->user->name ?? '-' }}</td>
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
                        <!-- Edit and Delete Button -->
                        @can('edit-laporan')
                            @include('admin.laporan.edit')
                        @endcan
                        @can('delete-laporan')
                            @include('admin.laporan.delete')
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
