@extends('master')
@section('title', 'Edit Absensi')
@section('content')
<div class="fade-in">
    <div class="content-card">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-edit me-2"></i>Edit Data Absensi
            </h1>
            <a href="{{ route('attendance.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>

        <form action="{{ route('attendance.update', $attendance->id) }}" method="POST" class="form-container">
            @csrf
            @method('PUT')
            
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
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id', $attendance->employee_id) == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $attendance->tanggal) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Jam Masuk:</label>
                <input type="time" name="jam_masuk" class="form-control" value="{{ old('jam_masuk', $attendance->jam_masuk) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Jam Keluar:</label>
                <input type="time" name="jam_keluar" class="form-control" value="{{ old('jam_keluar', $attendance->jam_keluar) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Status:</label>
                <select name="status" class="form-control form-select" required>
                    <option value="hadir" {{ old('status', $attendance->status) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="izin" {{ old('status', $attendance->status) == 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="sakit" {{ old('status', $attendance->status) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="cuti" {{ old('status', $attendance->status) == 'cuti' ? 'selected' : '' }}>Cuti</option>
                </select>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection