@extends('master')
@section('content')
<div class="fade-in">
    <div class="content-card">
        
        {{-- Header Halaman --}}
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-edit me-2"></i>Edit Jabatan: {{ $position->nama_jabatan }}
            </h1>
            <a href="{{ url('/positions') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>

        {{-- Form Edit Jabatan --}}
        <form action="{{ url('/positions/' . $position->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Error Validation Display (diambil dari contoh Anda) --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0" style="list-style: none; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li style="margin-bottom: 5px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="nama_jabatan" class="form-label">Nama Jabatan:</label>
                <input type="text" id="nama_jabatan" name="nama_jabatan" 
                       value="{{ old('nama_jabatan', $position->nama_jabatan) }}" 
                       class="form-control" required>
            </div>

            <div class="form-group">
                <label for="gaji_pokok" class="form-label">Gaji Pokok:</label>
                <input type="text" id="gaji_pokok" name="gaji_pokok" 
                       value="{{ old('gaji_pokok', $position->gaji_pokok) }}" 
                       class="form-control" required>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update Data
                </button>
                <a href="{{ url('/positions') }}" class="btn btn-secondary" style="margin-left: 10px;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection