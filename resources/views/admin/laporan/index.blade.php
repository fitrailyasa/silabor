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
                <th>{{ __('Name') }}</th>
                <th class="text-center">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporans as $laporan)
                <tr>
                    <td>{{ $laporans->firstItem() + $loop->index }}</td>
                    <td>{{ $laporan->name ?? '-' }}</td>
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
                <th>{{ __('Name') }}</th>
                <th class="text-center">{{ __('Action') }}</th>
            </tr>
        </tfoot>
    </table>
    {{ $laporans->appends(['perPage' => $perPage, 'search' => $search])->links() }}

</x-admin-table>
