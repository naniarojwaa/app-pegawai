@extends('master')
@section('title', 'Tambah Pegawai Baru')

@section('content')
<div class="container fade-in">
    {{-- .form-container memastikan lebar form 600px dan berada di tengah --}}
    <div class="content-card form-container"> 
        
        <h2 class="page-title mb-4">Form Tambah Pegawai</h2>
        
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Mohon perbaiki kesalahan berikut:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="nama_lengkap" class="form-label">Nama Lengkap:</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="form-control">
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-control">
            </div>
            
            <div class="form-group">
                <label for="nomor_telepon" class="form-label">Nomor Telepon:</label>
                <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required class="form-control">
            </div>
            
            <div class="form-group">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="form-control">
            </div>
            
            <div class="form-group">
                <label for="alamat" class="form-label">Alamat:</label>
                <textarea id="alamat" name="alamat" required class="form-control">{{ old('alamat') }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk:</label>
                <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required class="form-control">
            </div>
            
            <div class="form-group">
                <label for="status" class="form-label">Status:</label>
                <select id="status" name="status" required class="form-control form-select">
                    <option value="">-- Pilih Status --</option>
                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="departemen_id" class="form-label">Department:</label>
                <select id="departemen_id" name="departemen_id" required class="form-control form-select">
                    <option value="">-- Pilih Departemen --</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('departemen_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->nama }} {{-- Menggunakan properti 'nama' --}}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="jabatan_id" class="form-label">Position:</label>
                <select id="jabatan_id" name="jabatan_id" required class="form-control form-select">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" {{ old('jabatan_id') == $position->id ? 'selected' : '' }}>
                            {{ $position->nama }} {{-- Menggunakan properti 'nama' --}}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="btn-group" style="justify-content: flex-end; margin-top: 2rem;">
                <a href="{{ route('employees.index') }}" class="btn btn-outline">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection