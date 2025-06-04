<x-admin-table>

    <!-- Title -->
    <x-slot name="title">
        Ruangan
    </x-slot>

    <!-- Button Form Create -->
    <x-slot name="formCreate">
        @can('create-ruangan')
            @include('admin.ruangan.create')
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
            @foreach ($ruangans as $ruangan)
                <tr>
                    <td>{{ $ruangans->firstItem() + $loop->index }}</td>
                    <td>{{ $ruangan->name ?? '-' }}</td>
                    <td class="manage-row text-center">
                            <!-- Edit and Delete Button -->
                            @can('edit-ruangan')
                                @include('admin.ruangan.edit')
                            @endcan
                            @can('delete-ruangan')
                                @include('admin.ruangan.delete')
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
    {{ $ruangans->appends(['perPage' => $perPage, 'search' => $search])->links() }}

</x-admin-table>
