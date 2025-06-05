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
                <th>{{ __('Nama') }}</th>
                <th>{{ __('Kategori') }}</th>
                <th>{{ __('Lokasi') }}</th>
                <th>{{ __('Gambar') }}</th>
                <th class="text-center">{{ __('Aksi') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alats as $alat)
                <tr>
                    <td>{{ $alats->firstItem() + $loop->index }}</td>
                    <td>{{ $alat->name ?? '-' }}</td>
                    <td>{{ $alat->category->name ?? '-' }}</td>
                    <td>{{ $alat->location ?? '-' }}</td>
                    <td>
                        @if ($alat->img == null)
                            <img src="{{ asset('assets/img/default.png') }}" alt="{{ $alat->name }}" width="100">
                        @else
                            <a href="#" data-bs-toggle="modal" data-bs-target=".myModal{{ $alat->id }}">
                                <img class="img img-fluid rounded" src="{{ asset('storage/' . $alat->img) }}"
                                    alt="{{ $alat->img }}" width="100" loading="lazy">
                            </a>

                            <!-- Modal -->
                            <div class="modal fade myModal{{ $alat->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">{{ $alat->name }}</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="maximize"><i
                                                                class="fas fa-expand"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <img class="img img-fluid col-12"
                                                        src="{{ asset('storage/' . $alat->img) }}"
                                                        alt="{{ $alat->img }}">
                                                    <!-- Tombol Download -->
                                                    <a href="{{ asset('storage/' . $alat->img) }}"
                                                        download="{{ $alat->img }}"
                                                        class="btn btn-success mt-2 col-12">Download
                                                        Gambar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
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
                <th>{{ __('Nama') }}</th>
                <th>{{ __('Kategori') }}</th>
                <th>{{ __('Lokasi') }}</th>
                <th>{{ __('Gambar') }}</th>
                <th class="text-center">{{ __('Aksi') }}</th>
            </tr>
        </tfoot>
    </table>
    {{ $alats->appends(['perPage' => $perPage, 'search' => $search])->links() }}

</x-admin-table>
