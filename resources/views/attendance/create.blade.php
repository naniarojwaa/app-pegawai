@extends('master')
@section('title', 'Tambah Absensi')
@section('content')
<div class="fade-in">
    <div class="content-card">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-plus-circle me-2"></i>Tambah Data Absensi
            </h1>
            <a href="{{ route('attendance.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>

        <form action="{{ route('attendance.store') }}" method="POST" class="form-container">
            @csrf
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label class="form-label">Pegawai:</label>
                <select name="employee_id" class="form-control form-select" required>
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Jam Masuk:</label>
                <input type="time" name="jam_masuk" class="form-control" value="{{ old('jam_masuk') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Jam Keluar:</label>
                <input type="time" name="jam_keluar" class="form-control" value="{{ old('jam_keluar') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Status:</label>
                <select name="status" class="form-control form-select" required>
                    <option value="hadir" {{ old('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="izin" {{ old('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="sakit" {{ old('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="cuti" {{ old('status') == 'cuti' ? 'selected' : '' }}>Cuti</option>
                </select>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection