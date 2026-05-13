@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
            <a href="{{ route('dashboard.partners.index') }}" class="text-decoration-none">Partners</a> /
            <span>Edit Mitra</span>
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

            <form action="{{ route('dashboard.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="legal_name" class="form-label font-weight-bold">Nama Mitra Kerja</label>
                        <input type="text" name="legal_name" id="legal_name" class="form-control{{ $errors->has('legal_name') ? ' is-invalid' : '' }}" value="{{ old('legal_name', $partner->legal_name) }}" placeholder="Contoh: PT Contoh Sejahtera" required>
                        @error('legal_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label font-weight-bold">Email</label>
                        <input type="email" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $partner->email) }}" placeholder="email@contoh.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label font-weight-bold">Telepon</label>
                        <input type="text" name="phone" id="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone', $partner->phone) }}" placeholder="0812xxxx" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tax_identity_number" class="form-label font-weight-bold">NPWP</label>
                        <input type="text" name="tax_identity_number" id="tax_identity_number" class="form-control{{ $errors->has('tax_identity_number') ? ' is-invalid' : '' }}" value="{{ old('tax_identity_number', $partner->tax_identity_number) }}" placeholder="00.000.000.0-000.000" required>
                        @error('tax_identity_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label font-weight-bold">Status</label>
                        <select name="status" id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                            <option value="aktif" {{ old('status', $partner->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="non-aktif" {{ old('status', $partner->status) == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="partner_category_id" class="form-label font-weight-bold">Kategori Mitra Kerja</label>
                        <select name="partner_category_id" id="partner_category_id" class="form-control{{ $errors->has('partner_category_id') ? ' is-invalid' : '' }}" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($partnerCategories as $category)
                                <option value="{{ $category->id }}" {{ old('partner_category_id', $partner->partner_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('partner_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="logo_path" class="form-label font-weight-bold">Logo</label>

                        {{-- preview logo lama --}}
                        @if($partner->logo_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$partner->logo_path) }}"
                                    class="img-thumbnail"
                                    style="max-width:200px;"
                                    alt="Logo Mitra">
                            </div>
                        @endif

                        <input class="form-control{{ $errors->has('logo_path') ? ' is-invalid' : '' }}"
                            type="file"
                            id="logo_path"
                            name="logo_path"
                            accept="image/*"
                            onchange="previewImage(event)">

                        @error('logo_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- preview gambar baru --}}
                        <img id="logoPreview"
                            class="img-thumbnail mt-2"
                            style="max-width:200px; display:none;"
                            alt="Preview Logo">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="address" class="form-label font-weight-bold">Alamat</label>
                        <textarea name="address" id="address"
                            class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                            rows="3"
                            placeholder="Jalan, Kota, Provinsi"
                            required>{{ old('address', $partner->address) }}</textarea>
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
                        <span class="text">Update Mitra</span>
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
