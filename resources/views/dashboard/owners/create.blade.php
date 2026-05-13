@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a> /
            <a class="text-decoration-none" href="{{ route('dashboard.owners.index') }}">Data Owner</a> /
            <span>Buat Data Owner</span>
        </h1>
    </div>

    <!-- Form Create Owner -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Owner Baru</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="{{ route('dashboard.owners.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label font-weight-bold">Nama Owner</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Masukkan nama kategori"
                                value="{{ old('name') }}"
                                required
                            />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="short_name" class="form-label font-weight-bold">Nama Singkat</label>
                            <input
                                type="text"
                                name="short_name"
                                id="short_name"
                                class="form-control @error('short_name') is-invalid @enderror"
                                placeholder="Masukkan nama singkat"
                                value="{{ old('short_name') }}"
                                required
                            />
                            @error('short_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <a href="{{ route('dashboard.owners.index') }}" class="btn btn-secondary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                                <span class="text">Batal</span>
                            </a>
                            <button type="submit" class="btn btn-primary btn-icon-split" >
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Simpan Data Owner</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
