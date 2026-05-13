@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a> /
            <a class="text-decoration-none" href="{{ route('dashboard.periods.index') }}">Periode</a> /
            <span>Buat Periode</span>
        </h1>
    </div>

    <!-- Form Create Period -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Periode Baru</h6>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('dashboard.periods.store') }}" method="POST">
                @csrf

                <div class="row">
                    
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label font-weight-bold">Nama Periode</label>
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

                    <div class="col-md-6 mb-3">
                        <label for="month" class="form-label font-weight-bold">Bulan</label>
                        <select
                            name="month"
                            id="month"
                            class="form-control @error('month') is-invalid @enderror"
                            required
                        >
                            <option value="">Pilih bulan</option>
                            <option value="1" {{ old('month') == '1' ? 'selected' : '' }}>Januari</option>
                            <option value="2" {{ old('month') == '2' ? 'selected' : '' }}>Februari</option>
                            <option value="3" {{ old('month') == '3' ? 'selected' : '' }}>Maret</option>
                            <option value="4" {{ old('month') == '4' ? 'selected' : '' }}>April</option>
                            <option value="5" {{ old('month') == '5' ? 'selected' : '' }}>Mei</option>
                            <option value="6" {{ old('month') == '6' ? 'selected' : '' }}>Juni</option>
                            <option value="7" {{ old('month') == '7' ? 'selected' : '' }}>Juli</option>
                            <option value="8" {{ old('month') == '8' ? 'selected' : '' }}>Agustus</option>
                            <option value="9" {{ old('month') == '9' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ old('month') == '10' ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ old('month') == '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ old('month') == '12' ? 'selected' : '' }}>Desember</option>
                        </select>
                        @error('month')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="year" class="form-label font-weight-bold">Tahun</label>

                        <select
                            name="year"
                            id="year"
                            class="form-control @error('year') is-invalid @enderror"
                            required
                        >
                            <option value="">Pilih Tahun</option>

                            @for ($year = date('Y'); $year <= date('Y') + 5; $year++)
                                <option value={{ $year }}
                                    {{ (int) old('year') === $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>

                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="is_active" class="form-label font-weight-bold">
                            Status
                        </label>

                        <select
                            name="is_active"
                            id="is_active"
                            class="form-control @error('is_active') is-invalid @enderror"
                            required
                        >
                            <option value=1 {{ old('is_active', 1) == 1 ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value=0 {{ old('is_active') == 0 ? 'selected' : '' }}>
                                Tidak Aktif
                            </option>
                        </select>

                        @error('is_active')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label font-weight-bold">Deskripsi</label>
                    <textarea
                        name="description"
                        id="description"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Masukkan deskripsi kategori"
                        rows="3"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('dashboard.periods.index') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Batal</span>
                    </a>
                    <button type="submit" class="btn btn-primary btn-icon-split" >
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Simpan Periode</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
