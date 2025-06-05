<x-admin-table>

    <!-- Title -->
    <x-slot name="title">
        Bahan
    </x-slot>

    <!-- Button Form Create -->
    <x-slot name="formCreate">
        @can('create-bahan')
            @include('admin.bahan.create')
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
                <th>{{ __('Nama') }}</th>
                <th>{{ __('Kategori') }}</th>
                <th>{{ __('Stock') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Lokasi') }}</th>
                <th>{{ __('Tanggal Diterima') }}</th>
                <th class="text-center">{{ __('Aksi') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bahans as $bahan)
                <tr>
                    <td>{{ $bahans->firstItem() + $loop->index }}</td>
                    <td>{{ $bahan->name ?? '-' }}</td>
                    <td>{{ $bahan->category->name ?? '-' }}</td>
                    <td>
                        <p class="p-0 m-0">{{ $bahan->stock ?? '0' }} {{ $bahan->unit ?? '-' }}</p>
                        <p class="text-muted small p-0 m-0">Min Stok: {{ $bahan->min_stock ?? '0' }} {{ $bahan->unit ?? '-' }}</p>
                    </td>
                    <td>
                        {{-- jika stock kurang dari sama dengan min_stock maka tampilkan badge danger, jika tidak maka tampilkan badge success --}}
                        @if ($bahan->stock <= $bahan->min_stock)
                            <span class="badge badge-danger">Stok Rendah</span>
                        @else
                            <span class="badge badge-primary">Stok Cukup</span>
                        @endif
                    </td>
                    <td>{{ $bahan->location ?? '-' }}</td>
                    <td>{{ $bahan->date_received ?? '-' }}</td>
                    <td class="manage-row text-center">
                        <!-- Edit and Delete Button -->
                        @can('edit-bahan')
                            @include('admin.bahan.edit')
                        @endcan
                        @can('delete-bahan')
                            @include('admin.bahan.delete')
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>{{ __('No') }}</th>
                <th>{{ __('Nama') }}</th>
                <th>{{ __('Kategori') }}</th>
                <th>{{ __('Stock') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Lokasi') }}</th>
                <th>{{ __('Tanggal Diterima') }}</th>
                <th class="text-center">{{ __('Aksi') }}</th>
            </tr>
        </tfoot>
    </table>
    {{ $bahans->appends(['perPage' => $perPage, 'search' => $search])->links() }}

</x-admin-table>
