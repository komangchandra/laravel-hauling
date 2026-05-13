@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
            <!-- <a href="{{ route('dashboard.hauls.index') }}" class="text-decoration-none">Data Hauling</a> / -->
            <span>Tambah Data Hauling</span>
        </h1>
    </div>

    <!-- Card -->     
    <div class="card shadow mb-4">
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

            <form action="{{ route('dashboard.hauls.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="period_id" class="form-label font-weight-bold">Periode</label>
                        <select name="period_id" id="period_id" class="form-control{{ $errors->has('period_id') ? ' is-invalid' : '' }}" required>
                            <option value="">-- Pilih Periode --</option>
                            @foreach ($periods as $period)
                                <option value="{{ $period->id }}" {{ old('period_id') == $period->id ? 'selected' : '' }}>{{ $period->name }}</option>
                            @endforeach
                        </select>
                        @error('period_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="track_id" class="form-label font-weight-bold">Rute</label>
                        <select name="track_id" id="track_id" class="form-control{{ $errors->has('track_id') ? ' is-invalid' : '' }}" required>
                            <option value="">-- Pilih Rute --</option>
                            @foreach ($tracks as $track)
                                <option value="{{ $track->id }}" {{ old('track_id') == $track->id ? 'selected' : '' }}>{{ $track->name }}</option>
                            @endforeach
                        </select>
                        @error('track_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tonage" class="form-label font-weight-bold">Tonase</label>
                        <input type="number" step="0.01" name="tonage" id="tonage" class="form-control{{ $errors->has('tonage') ? ' is-invalid' : '' }}" value="{{ old('tonage') }}" placeholder="Contoh: 10.5" step="0.01" required>
                        @error('tonage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="photo_path" class="form-label font-weight-bold">Bukti Screenshoot</label>
                        <input class="form-control{{ $errors->has('photo_path') ? ' is-invalid' : '' }}" type="file" id="photo_path" name="photo_path" accept="image/*" onchange="previewImage(event)">
                        @error('photo_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary btn-icon-split" >
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Simpan Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('logoPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
@endpush
