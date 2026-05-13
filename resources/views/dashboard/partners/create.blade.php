@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
            <a href="{{ route('dashboard.partners.index') }}" class="text-decoration-none">Mitra Kerja</a> /
            <span>Tambah Mitra</span>
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

            <form action="{{ route('dashboard.partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="legal_name" class="form-label font-weight-bold">Nama Mitra Kerja</label>
                        <input type="text" name="legal_name" id="legal_name" class="form-control{{ $errors->has('legal_name') ? ' is-invalid' : '' }}" value="{{ old('legal_name') }}" placeholder="Contoh: PT Contoh Sejahtera Mining" required>
                        @error('legal_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="short_name" class="form-label font-weight-bold">Nama Singkat</label>
                        <input type="text" name="short_name" id="short_name" class="form-control{{ $errors->has('short_name') ? ' is-invalid' : '' }}" value="{{ old('short_name') }}" placeholder="Contoh: CSM" required>
                        @error('short_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label font-weight-bold">Email</label>
                        <input type="email" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label font-weight-bold">Telepon</label>
                        <input type="text" name="phone" id="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="0812xxxx" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tax_identity_number" class="form-label font-weight-bold">NPWP</label>
                        <input type="text" name="tax_identity_number" id="tax_identity_number" class="form-control{{ $errors->has('tax_identity_number') ? ' is-invalid' : '' }}" value="{{ old('tax_identity_number') }}" placeholder="00.000.000.0-000.000" required>
                        @error('tax_identity_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label font-weight-bold">Status</label>
                        <select name="status" id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="non-active" {{ old('status') == 'non-active' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="owner_id" class="form-label font-weight-bold">Kategori Mitra Kerja</label>
                        <select name="owner_id" id="owner_id" class="form-control{{ $errors->has('owner_id') ? ' is-invalid' : '' }}" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($owners as $owner)
                                <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
                            @endforeach
                        </select>
                        @error('owner_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="address" class="form-label font-weight-bold">Alamat</label>
                        <textarea name="address" id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" rows="3" placeholder="Jalan, Kota, Provinsi" required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('dashboard.partners.index') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Batal</span>
                    </a>
                    <button type="submit" class="btn btn-primary btn-icon-split" >
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Simpan Mitra</span>
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
