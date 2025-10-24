@extends('master')
@section('title', 'Edit Pegawai')
@section('content')
<div class="fade-in employee-edit-view">
    <div class="content-card">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-edit me-2"></i>Edit Data Pegawai
            </h1>
            {{-- Asumsi routing kembali ke index pegawai --}}
            <a href="{{ url('/employees') }}" class="btn btn-outline"> 
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>

        {{-- FORM CONTAINER BARU --}}
        <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="form-container">
            @csrf
            @method('PUT')
            
            {{-- Jika ada error validasi, tampilkan di sini --}}
            @if($errors->any())
                <div class="alert alert-danger grid-full-width">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Kolom 1: Nama Lengkap --}}
            <div class="form-group">
                <label class="form-label" for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" 
                       value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" required>
            </div>

            {{-- Kolom 2: Email --}}
            <div class="form-group">
                <label class="form-label" for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="{{ old('email', $employee->email) }}" required>
            </div>

            {{-- Kolom 3: Nomor Telepon --}}
            <div class="form-group">
                <label class="form-label" for="nomor_telepon">Nomor Telepon:</label>
                <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control" 
                       value="{{ old('nomor_telepon', $employee->nomor_telepon) }}">
            </div>

            {{-- Kolom 4: Tanggal Lahir --}}
            <div class="form-group">
                <label class="form-label" for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" 
                       value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}">
            </div>

            {{-- Kolom 5: Alamat (Lebar Penuh) --}}
            <div class="form-group grid-full-width"> 
                <label class="form-label" for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" class="form-control" 
                       value="{{ old('alamat', $employee->alamat) }}">
            </div>

            {{-- Kolom 6: Tanggal Masuk --}}
            <div class="form-group">
                <label class="form-label" for="tanggal_masuk">Tanggal Masuk:</label>
                <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" 
                       value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}" required>
            </div>

            {{-- Kolom 7: Status --}}
            <div class="form-group">
                <label class="form-label" for="status">Status:</label>
                <select name="status" id="status" class="form-control form-select" required>
                    <option value="aktif" {{ old('status', $employee->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $employee->status) == 'nonaktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            
            {{-- Kolom 8: Departemen (Relasi) --}}
            <div class="form-group">
                <label class="form-label" for="departemen_id">Departemen:</label>
                <select name="departemen_id" id="departemen_id" class="form-control form-select">
                    <option value="">-- Pilih Departemen --</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('departemen_id', $employee->departemen_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->nama_departemen }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            {{-- Kolom 9: Jabatan (Relasi) --}}
            <div class="form-group">
                <label class="form-label" for="jabatan_id">Jabatan:</label>
                <select name="jabatan_id" id="jabatan_id" class="form-control form-select">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" {{ old('jabatan_id', $employee->jabatan_id) == $position->id ? 'selected' : '' }}>
                            {{ $position->nama_jabatan }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- Tombol Update --}}
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update Data
                </button>
            </div>
        </form>
        {{-- END FORM CONTAINER --}}
    </div>
</div>
@endsection
