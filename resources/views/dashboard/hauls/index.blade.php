@extends('dashboard.layouts.app') @section('content')
<!-- Custom styles for this page -->
@push('css')
<link
    href="{{ asset('/') }}vendor/datatables/dataTables.bootstrap4.min.css"
    rel="stylesheet"
/>
@endpush

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>/
            <span>Data Hauling</span>
        </h1>

        <div class="d-flex mx-3">

            <a href="{{ route('dashboard.hauls.export') }}"
                class="btn btn-success btn-icon-split mx-3">

                <span class="icon text-white-50">
                    <i class="fas fa-file-excel"></i>
                </span>

                <span class="text">
                    Download Excel
                </span>
            </a>

            <a href="{{ route('dashboard.hauls.create') }}"
            class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus fa-sm text-white-50"></i>
                </span>
                <span class="text">Tambah Haul</span>
            </a>
        </div>

    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session("success") }}
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div
            class="card-header py-3 d-flex justify-content-between align-items-center"
        >
            <h6 class="m-0 font-weight-bold text-primary">Daftar Data Hauling</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Periode</th>
                            <th>Relasi</th>
                            <th>Rute</th>
                            <th>Vendor</th>
                            <th>Tonase</th>
                            <th>Ditambahkan oleh</th>
                            <th>Lampiran</th>
                            <th>##</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Periode</th>
                            <th>Relasi</th>
                            <th>Rute</th>
                            <th>Vendor</th>
                            <th>Tonase</th>
                            <th>Ditambahkan oleh</th>
                            <th>Lampiran</th>
                            <th>##</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @forelse ($hauls as $haul)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $haul->period->name }}</td>
                            <td>{{ $haul->owner->short_name }}</td>
                            <td>{{ $haul->track->name }}</td>
                            <td>{{ $haul->partner->short_name }}</td>
                            <td>{{ $haul->tonage }}</td>
                            <td>{{ $haul->user->name }}</td>
                            <td>
                                @if($haul->photo_path)
                                    <a href="{{ asset('storage/' . $haul->photo_path) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-file"></i> Lihat Berkas
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada berkas</span>
                                @endif
                            </td>
                            <td>
                                <!-- Tombol edit -->
                                <!-- <a href="{{ route('dashboard.hauls.edit', $haul->id) }}" 
                                class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a> -->

                                <!-- Tombol delete -->
                                <form action="{{ route('dashboard.hauls.destroy', $haul->id) }}" 
                                    method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Belum ada hauling ditambahkan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- Custom JS -->
@push('js')
<script src="{{
        asset('/')
    }}vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{
        asset('/')
    }}vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $("#dataTable").DataTable();

        // pakai event delegation
        $(document).on("click", ".btn-delete", function (e) {
            e.preventDefault();
            const form = $(this).closest("form");

            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
