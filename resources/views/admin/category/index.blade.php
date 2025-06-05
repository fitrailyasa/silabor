<x-admin-table>

    <!-- Title -->
    <x-slot name="title">
        Category
    </x-slot>

    <!-- Button Form Create -->
    <x-slot name="formCreate">
        @can('create-category')
            @include('admin.category.create')
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
                <th>{{ __('Tipe') }}</th>
                <th class="text-center">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $categories->firstItem() + $loop->index }}</td>
                    <td>{{ $category->name ?? '-' }}</td>
                    <td>
                        @if ($category->type == 'alat')
                            <span class="badge badge-primary">Alat</span>
                        @elseif ($category->type == 'bahan')
                            <span class="badge badge-success">Bahan</span>
                        @endif
                    </td>
                    <td class="manage-row text-center">
                            <!-- Edit and Delete Button -->
                            @can('edit-category')
                                @include('admin.category.edit')
                            @endcan
                            @can('delete-category')
                                @include('admin.category.delete')
                            @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>{{ __('No') }}</th>
                <th>{{ __('Nama') }}</th>
                <th>{{ __('Tipe') }}</th>
                <th class="text-center">{{ __('Action') }}</th>
            </tr>
        </tfoot>
    </table>
    {{ $categories->appends(['perPage' => $perPage, 'search' => $search])->links() }}

</x-admin-table>
