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
            <span>Unit Report</span>
        </h1>

        <div class="d-flex">
            <a href="{{ route('dashboard.unit-reports.create') }}" class="btn btn-secondary btn-icon-split mr-2">
                <span class="icon text-white-50">
                    <i class="fas fa-file-import fa-sm text-white-50"></i>
                </span>
                <span class="text">Import Timesheet - <span class="font-italic">CSV</span></span>
            </a>

            <a href="{{ route('dashboard.unit-reports.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus fa-sm text-white-50"></i>
                </span>
                <span class="text">Input Timesheet</span>
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
            <h6 class="m-0 font-weight-bold text-primary">Daftar Unit Report</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Kode Unit</th>
                            <th>HM Awal</th>
                            <th>HM Akhir</th>
                            <th>Total HM</th>
                            <th>BD</th>
                            <th>SB</th>
                            <th>MA-PA</th>
                            <th>Aktivitas</th>
                            <th>##</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Kode Unit</th>
                            <th>HM Awal</th>
                            <th>HM Akhir</th>
                            <th>Total HM</th>
                            <th>BD</th>
                            <th>SB</th>
                            <th>MA-PA</th>
                            <th>Aktivitas</th>
                            <th>##</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @forelse ($unitDailyReports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->datereport_date }}</td>
                            <td>{{ $report->unit->code }}</td>
                            <td>{{ $report->initial_hm }}</td>
                            <td>{{ $report->final_hm }}</td>
                            <td>{{ $report->total_hm }}</td>
                            <td>{{ $report->bd }}</td>
                            <td>{{ $report->sb }}</td>
                            <td>{{ $report->ma_pa }}</td>
                            <td>{{ $report->activity }}</td>
                            <td>
                                <!-- Tombol edit -->
                                <a href="{{ route('dashboard.unit-reports.edit', $report->id) }}" 
                                class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Tombol delete -->
                                <form action="{{ route('dashboard.unit-reports.destroy', $report->id) }}" 
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
                            <td colspan="9" class="text-center">Belum ada mitra ditambahkan</td>
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
