@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
            <a href="{{ route('dashboard.units.index') }}" class="text-decoration-none">Unit</a> /
            <span>Edit Unit</span>
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

            <form action="{{ route('dashboard.units.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="unit_category_id" class="form-label font-weight-bold">Kategori Unit</label>
                        <select name="unit_category_id" id="unit_category_id" class="form-control{{ $errors->has('unit_category_id') ? ' is-invalid' : '' }}" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($unitCategories as $category)
                                <option value="{{ $category->id }}" {{ old('unit_category_id', $unit->unit_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('unit_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="unit_type_id" class="form-label font-weight-bold">Tipe Unit</label>
                        <select name="unit_type_id" id="unit_type_id" class="form-control{{ $errors->has('unit_type_id') ? ' is-invalid' : '' }}" required>
                            <option value="">-- Pilih Tipe --</option>
                            @foreach ($unitTypes as $type)
                                <option value="{{ $type->id }}" {{ old('unit_type_id', $unit->unit_type_id) == $type->id ? 'selected' : '' }}>{{ $type->model }}</option>
                            @endforeach
                        </select>
                        @error('unit_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="partner_id" class="form-label font-weight-bold">Vendor</label>
                        <select name="partner_id" id="partner_id" class="form-control{{ $errors->has('partner_id') ? ' is-invalid' : '' }}" required>
                            <option value="">-- Pilih Vendor --</option>
                            @foreach ($partners as $partner)
                                <option value="{{ $partner->id }}" {{ old('partner_id', $unit->partner_id) == $partner->id ? 'selected' : '' }}>{{ $partner->short_name }}</option>
                            @endforeach
                        </select>
                        @error('partner_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="registration_number" class="form-label font-weight-bold">Nomor Lambung</label>
                        <input type="text" name="registration_number" id="registration_number" class="form-control{{ $errors->has('registration_number') ? ' is-invalid' : '' }}" value="{{ old('registration_number', $unit->registration_number) }}" placeholder="Contoh: ABC-123" required>
                        @error('registration_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="commissioning_status" class="form-label font-weight-bold">Status</label>
                        <select name="commissioning_status" id="commissioning_status" class="form-control{{ $errors->has('commissioning_status') ? ' is-invalid' : '' }}" required>
                            <option value="aktif" {{ old('commissioning_status', $unit->commissioning_status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="non-aktif" {{ old('commissioning_status', $unit->commissioning_status) == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                        @error('commissioning_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="file_path" class="form-label font-weight-bold">Berkas Unit</label>
                        <input class="form-control{{ $errors->has('file_path') ? ' is-invalid' : '' }}" type="file" id="file_path" name="file_path" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" onchange="previewImage(event)">
                        @error('file_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="mt-4">
                    <a href="{{ route('dashboard.units.index') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Batal</span>
                    </a>
                    <button type="submit" class="btn btn-primary btn-icon-split" >
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Simpan Unit</span>
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
