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
                <th>{{ __('Lokasi') }}</th>
                <th>{{ __('Gambar') }}</th>
                <th class="text-center">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bahans as $bahan)
                <tr>
                    <td>{{ $bahans->firstItem() + $loop->index }}</td>
                    <td>{{ $bahan->name ?? '-' }}</td>
                    <td>{{ $bahan->category->name ?? '-' }}</td>
                    <td>{{ $bahan->location ?? '-' }}</td>
                    <td>
                        @if ($bahan->img == null)
                            <img src="{{ asset('assets/img/default.png') }}" alt="{{ $bahan->name }}"
                                width="100">
                        @else
                            <a href="#" data-bs-toggle="modal" data-bs-target=".myModal{{ $bahan->id }}">
                                <img class="img img-fluid rounded" src="{{ asset('storage/' . $bahan->img) }}"
                                    alt="{{ $bahan->img }}" width="100" loading="lazy">
                            </a>

                            <!-- Modal -->
                            <div class="modal fade myModal{{ $bahan->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">{{ $bahan->name }}</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="maximize"><i
                                                                class="fas fa-expand"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <img class="img img-fluid col-12"
                                                        src="{{ asset('storage/' . $bahan->img) }}"
                                                        alt="{{ $bahan->img }}">
                                                    <!-- Tombol Download -->
                                                    <a href="{{ asset('storage/' . $bahan->img) }}"
                                                        download="{{ $bahan->img }}"
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
                <th>{{ __('Lokasi') }}</th>
                <th>{{ __('Gambar') }}</th>
                <th class="text-center">{{ __('Action') }}</th>
            </tr>
        </tfoot>
    </table>
    {{ $bahans->appends(['perPage' => $perPage, 'search' => $search])->links() }}

</x-admin-table>
