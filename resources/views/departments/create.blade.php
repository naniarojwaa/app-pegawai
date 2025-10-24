@extends('master')
@section('title', 'Tambah Departemen')
@section('content')
<div class="fade-in">
    <div class="content-card">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-plus me-2"></i>Tambah Departemen Baru
            </h1>
            <a href="{{ route('departments.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>

        <div class="form-container">
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_departemen" class="form-label">Nama Departemen</label>
                    <input type="text" 
                           class="form-control @error('nama_departemen') is-invalid @enderror" 
                           id="nama_departemen" 
                           name="nama_departemen" 
                           value="{{ old('nama_departemen') }}"
                           placeholder="Masukkan nama departemen"
                           required>
                    @error('nama_departemen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Simpan Departemen
                    </button>
                    <a href="{{ route('departments.index') }}" class="btn btn-outline">
                        <i class="fas fa-times me-1"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection