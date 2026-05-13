@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
            <a href="{{ route('dashboard.tracks.index') }}" class="text-decoration-none">Rute Hauling</a> /
            <span>Edit Rute</span>
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

            <form action="{{ route('dashboard.tracks.update', $track->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="code" class="form-label font-weight-bold">Kode Rute</label>
                        <input type="text" name="code" id="code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" value="{{ old('code', $track->code) }}" placeholder="Contoh: H1" required>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label font-weight-bold">Nama Rute</label>
                        <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $track->name) }}" placeholder="Contoh: Rute 1" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="distance" class="form-label font-weight-bold">Jarak (km)</label>
                        <input type="number" step="0.01" name="distance" id="distance" class="form-control{{ $errors->has('distance') ? ' is-invalid' : '' }}" value="{{ old('distance', $track->distance) }}" placeholder="Contoh: 59.3" required>
                        @error('distance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label font-weight-bold">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Contoh: Rute 1" required>{{ old('description', $track->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="mt-4">
                    <a href="{{ route('dashboard.tracks.index') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Batal</span>
                    </a>
                    <button type="submit" class="btn btn-primary btn-icon-split" >
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Update Tipe Unit</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
