@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
            <a href="{{ route('dashboard.unit-categories.index') }}" class="text-decoration-none">Unit Kategiri</a> /
            <span>Edit Unit Kategori</span>
        </h1>
    </div>

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Edit Unit Kategori</h6>
            
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

            <form action="{{ route('dashboard.unit-categories.update', $unitCategory->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label font-weight-bold">Nama Unit Kategori</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $unitCategory->name) }}" class="form-control" required>
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
                    >{{ old('description', $unitCategory->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <a href="{{ route('dashboard.unit-categories.index') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Batal</span>
                    </a>
                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Update Unit Kategori</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
