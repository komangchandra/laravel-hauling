@extends('dashboard.layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a> /
            <a class="text-decoration-none" href="{{ route('dashboard.manpowers.index') }}">Man Power</a> /
            <span>Detail</span>
        </h1>

        <div>
            <a href="{{ route('dashboard.manpowers.index') }}" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>

            <button onclick="window.print()" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Print</span>
            </button>
        </div>
    </div>

    <!-- Card Detail -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Man Power</h6>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-3 text-center">
                    @if ($manpower->photo_path)
                        <img src="{{ asset('storage/' . $manpower->photo_path) }}" 
                            class="img-thumbnail" 
                            style="max-height: 200px;"
                            alt="Foto Manpower">
                    @else
                        <img src="https://via.placeholder.com/200x200?text=No+Photo" 
                            class="img-thumbnail"
                            alt="No Photo">
                    @endif
                </div>

                <div class="col-md-9 d-flex align-items-center">
                    <div>
                        <h4 class="mb-1">{{ $manpower->name }}</h4>
                        <p class="mb-0 text-muted">{{ $manpower->position }}</p>
                        <small class="text-muted">{{ $manpower->partner->legal_name ?? 'N/A' }}</small>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Kode</label>
                    <p>{{ $manpower->code }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Nama</label>
                    <p>{{ $manpower->name }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Jabatan</label>
                    <p>{{ $manpower->position }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Departemen</label>
                    <p>{{ $manpower->department }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Nomor HP</label>
                    <p>{{ $manpower->contact_number }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Perusahaan</label>
                    <p>{{ $manpower->partner->legal_name ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Valid From</label>
                    <p>
                        {{ $manpower->valid_from 
                            ? \Carbon\Carbon::parse($manpower->valid_from)->format('d-m-Y') 
                            : 'N/A' }}
                    </p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Valid Until</label>
                    <p>
                        {{ $manpower->valid_until 
                            ? \Carbon\Carbon::parse($manpower->valid_until)->format('d-m-Y') 
                            : 'N/A' }}
                    </p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Status</label>
                    <p>
                        @if ($manpower->status == 'aktif')
                            <span class="badge badge-success">Active</span>
                        @elseif ($manpower->status == 'pengajuan')
                            <span class="badge badge-primary">Pengajuan</span>
                        @elseif ($manpower->status == 'tidak_aktif')
                            <span class="badge badge-warning">Tidak Active</span>
                        @elseif ($manpower->status == 'ditolak')
                            <span class="badge badge-danger">Ditolak</span>
                        @else
                            <span class="badge badge-secondary">{{ ucfirst($manpower->status) }}</span>
                        @endif
                    </p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Dokumen</label>
                    <p>
                        @if ($manpower->document_path)
                            <a href="{{ asset('storage/' . $manpower->document_path) }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fas fa-file"></i> Lihat Dokumen
                            </a>
                        @else
                            <span class="text-muted">Tidak ada dokumen</span>
                        @endif
                    </p>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection


@push('css')
<style>
    @media print {
        .btn, .navbar, .sidebar {
            display: none !important;
        }
    }
</style>
@endpush