@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
            <a href="{{ route('dashboard.manpowers.index') }}" class="text-decoration-none">Man Power</a> /
            <span>Tinjau Man Power</span>
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

            <form action="{{ route('dashboard.manpowers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- <div class="col-md-6 mb-3">
                        <label for="code" class="form-label font-weight-bold">Nomor Registrasi</label>
                        <input type="text" name="code" id="code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" value="{{ old('code') }}" placeholder="Contoh: PT Contoh Sejahtera" required>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label font-weight-bold">Nama</label>
                        <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Contoh: John Doe" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label font-weight-bold">Jabatan</label>
                        <input type="text" name="position" id="position" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" value="{{ old('position') }}" placeholder="Contoh: Manager" required>
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="department" class="form-label font-weight-bold">Departemen</label>
                        <input type="text" name="department" id="department" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" value="{{ old('department') }}" placeholder="Contoh: Marketing" required>
                        @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="contact_number" class="form-label font-weight-bold">Nomor HP</label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" value="{{ old('contact_number') }}" placeholder="Contoh: 081234567890" required>
                        @error('contact_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="partner_id" class="form-label font-weight-bold">Mitra Kerja</label>
                        <select name="partner_id" id="partner_id" class="form-control{{ $errors->has('partner_id') ? ' is-invalid' : '' }}" required>
                            <option value="">-- Pilih Mitra Kerja --</option>
                            @foreach ($partners as $partner)
                                <option value="{{ $partner->id }}" {{ old('partner_id') == $partner->id ? 'selected' : '' }}>{{ $partner->legal_name }}</option>
                            @endforeach
                        </select>
                        @error('partner_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="dokumen_path" class="form-label font-weight-bold">Dokumen</label>
                        <input class="form-control{{ $errors->has('dokumen_path') ? ' is-invalid' : '' }}" type="file" id="dokumen_path" name="dokumen_path" accept=".pdf,.doc,.docx" onchange="previewDocument(event)">
                        @error('dokumen_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <img id="documentPreview" class="img-thumbnail mt-2" style="max-width:200px; display: none;" alt="Preview Document">
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('dashboard.manpowers.index') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Batal</span>
                    </a>
                    <button type="submit" class="btn btn-primary btn-icon-split" >
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Ajukan Manpower</span>
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
