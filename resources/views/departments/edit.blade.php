@extends('master')
@section('title', 'Edit Departemen')
@section('content')
<div class="fade-in">
    <div class="content-card">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-edit me-2"></i>Edit Departemen
            </h1>
            <a href="{{ route('departments.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>

        <div class="form-container">
            <form action="{{ route('departments.update', $department->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_departemen" class="form-label">Nama Departemen</label>
                    <input type="text" 
                           class="form-control @error('nama_departemen') is-invalid @enderror" 
                           id="nama_departemen" 
                           name="nama_departemen" 
                           value="{{ old('nama_departemen', $department->nama_departemen) }}"
                           placeholder="Masukkan nama departemen"
                           required>
                    @error('nama_departemen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Update Departemen
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