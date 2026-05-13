@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
            <a href="{{ route('dashboard.unit-reports.index') }}" class="text-decoration-none">Unit Reports</a> /
            <span>Input Unit Report</span>
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

            <form action="{{ route('dashboard.unit-reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="report_date" class="form-label font-weight-bold">Tanggal Report</label>
                        <input type="date" name="report_date" id="report_date" class="form-control{{ $errors->has('report_date') ? ' is-invalid' : '' }}" value="{{ old('report_date') }}" required>
                        @error('report_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="unit_id" class="form-label font-weight-bold">Unit</label>
                        <select name="unit_id" id="unit_id" class="form-control{{ $errors->has('unit_id') ? ' is-invalid' : '' }}" required>
                            <option value="">Pilih Unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->registration_number }}
                                </option>
                            @endforeach
                        </select>
                        @error('unit_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="hm_start" class="form-label font-weight-bold">HM Awal</label>
                        <input type="number" name="hm_start" id="hm_start" class="form-control{{ $errors->has('hm_start') ? ' is-invalid' : '' }}" value="{{ old('hm_start') }}" required>
                        @error('hm_start')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="hm_end" class="form-label font-weight-bold">HM Akhir</label>
                        <input type="number" name="hm_end" id="hm_end" class="form-control{{ $errors->has('hm_end') ? ' is-invalid' : '' }}" value="{{ old('hm_end') }}" required>
                        @error('hm_end')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="breakdown_time" class="form-label font-weight-bold">Breakdown</label>
                        <input type="number" name="breakdown_time" id="breakdown_time" class="form-control{{ $errors->has('breakdown_time') ? ' is-invalid' : '' }}" value="{{ old('breakdown_time') }}" required>
                        @error('breakdown_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="activity_id" class="form-label font-weight-bold">Aktivitas Unit</label>
                        <select name="activity_id" id="activity_id" class="form-control{{ $errors->has('activity_id') ? ' is-invalid' : '' }}" required>
                            <option value="">Pilih Aktivitas</option>
                            @foreach ($activities as $activity)
                                <option value="{{ $activity->id }}" {{ old('activity_id') == $activity->id ? 'selected' : '' }}>
                                    {{ $activity->code }} - {{ $activity->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('activity_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="remarks" class="form-label font-weight-bold">Remark</label>
                        <textarea name="remarks" id="remarks" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" rows="3" placeholder="Masukkan remark" required>{{ old('remarks') }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('dashboard.unit-reports.index') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Batal</span>
                    </a>
                    <button type="submit" class="btn btn-primary btn-icon-split" >
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Simpan Laporan</span>
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
