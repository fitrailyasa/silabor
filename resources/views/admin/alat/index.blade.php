<x-admin-table>

    <!-- Title -->
    <x-slot name="title">
        Alat
    </x-slot>

    <!-- Button Form Create -->
    <x-slot name="formCreate">
        @can('create-alat')
            @include('admin.alat.create')
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
            @foreach ($alats as $alat)
                <tr>
                    <td>{{ $alats->firstItem() + $loop->index }}</td>
                    <td>{{ $alat->name ?? '-' }}</td>
                    <td class="manage-row text-center">
                            <!-- Edit and Delete Button -->
                            @can('edit-alat')
                                @include('admin.alat.edit')
                            @endcan
                            @can('delete-alat')
                                @include('admin.alat.delete')
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
    {{ $alats->appends(['perPage' => $perPage, 'search' => $search])->links() }}

</x-admin-table>
